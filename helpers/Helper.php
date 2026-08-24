<?php

declare(strict_types=1);

use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Modules\Xot\Actions\Cast\SafeStringCastAction;
use Modules\Xot\Actions\Factory\GetFactoryAction;
use Modules\Xot\Actions\File\FixPathAction;
use Modules\Xot\Actions\Route\GetRouteParametersAction;

use function Safe\define;
use function Safe\preg_match;

use Webmozart\Assert\Assert;

if (! function_exists('isRunningTestBench')) {
    function isRunningTestBench(): bool
    {
        $path = app(FixPathAction::class)->execute('\vendor\orchestra\testbench-core\laravel');
        $base = app(FixPathAction::class)->execute(base_path());

        return Str::endsWith($base, $path);
    }
}

if (! function_exists('dddx')) {
    function dddx(mixed $params): void
    {
        $tmp = debug_backtrace();
        $startValue = defined('LARAVEL_START') ? LARAVEL_START : null;
        $start = is_numeric($startValue) ? (float) $startValue : microtime(true);
        if (! defined('LARAVEL_START')) {
            define('LARAVEL_START', $start);
        }
        $file = app(FixPathAction::class)->execute($tmp[0]['file'] ?? 'file-unknown');

        $data = [
            '_' => $params,
            'line' => $tmp[0]['line'] ?? 'line-unknows',
            'file' => $file,
            'time' => microtime(true) - $start,
            'memory_taken' => round(memory_get_peak_usage() / (1024 * 1024), 2).' MB',
        ];

        if (File::exists($data['file'])) {
            $storagePath = app(FixPathAction::class)->execute(storage_path('framework/views'));
            if (Str::startsWith($data['file'], $storagePath)) {
                $content = File::get($data['file']);
                $betweenResult = Str::between($content, '/**PATH ', ' ENDPATH**/');
                $data['view_file'] = app(FixPathAction::class)->execute($betweenResult);
            }
        }

        dd($data);
    }
}

if (! function_exists('in_admin')) {
    /** @param array<string, mixed> $params */
    function in_admin(array $params = []): bool
    {
        return inAdmin($params);
    }
}

if (! function_exists('inAdmin')) {
    /** @param array<string, mixed> $params */
    function inAdmin(array $params = []): bool
    {
        if (isset($params['in_admin'])) {
            return (bool) $params['in_admin'];
        }

        if ('admin' === Request::segment(2)) {
            return true;
        }

        /** @var iterable<int|string, string>|null $segments */
        $segments = Request::segments();

        if (! is_array($segments) || 0 === count($segments)) {
            return false;
        }

        return 'livewire' === $segments[0] && true === session('in_admin');
    }
}

if (! function_exists('params2ContainerItem')) {
    /**
     * @param array<string, mixed>|null $params
     *
     * @return array{0: array<string, mixed>, 1: array<string, mixed>}
     */
    function params2ContainerItem(?array $params = null): array
    {
        if (null === $params) {
            $params = [];
            $route_current = Route::current();
            if ($route_current instanceof Illuminate\Routing\Route) {
                $params = $route_current->parameters();
            }
        }

        $container = [];
        $item = [];
        foreach ($params as $k => $v) {
            $pattern = '/(container|item)(\d+)/';
            if (1 !== preg_match($pattern, $k, $matches)) {
                continue;
            }
            $sk = $matches[1] ?? '';
            $sv = $matches[2] ?? '';
            if ('' !== $sk && '' !== $sv) {
                ${$sk}[$sv] = $v;
            }
        }

        return [$container, $item];
    }
}

if (! function_exists('xotModel')) {
    function xotModel(string $name): Model
    {
        $model_class = config('morph_map.'.$name);
        if (! is_string($model_class)) {
            throw new Exception('['.__LINE__.']');
        }

        Assert::isInstanceOf($res = app($model_class), Model::class);

        return $res;
    }
}

if (! function_exists('authId')) {
    function authId(): ?string
    {
        try {
            $id = Filament::auth()->id() ?? auth()->guard()->id();

            return null === $id ? null : strval($id);
        } catch (Throwable) {
            return null;
        }
    }
}

if (! function_exists('trans_string')) {
    /** @param array<string, mixed> $replace */
    function trans_string(string $key, array $replace = [], ?string $locale = null): string
    {
        $safeReplace = [];
        foreach ($replace as $k => $v) {
            if (! is_string($k)) {
                continue;
            }

            $safeReplace[$k] = (is_scalar($v) || null === $v) ? $v : SafeStringCastAction::cast($v);
        }

        $result = __($key, $safeReplace, $locale);

        return is_string($result) ? $result : $key;
    }
}

if (! function_exists('isJson')) {
    function isJson(string $string): bool
    {
        return json_validate($string);
    }
}

if (! function_exists('getRouteParameters')) {
    /** @return array<string, mixed> */
    function getRouteParameters(): array
    {
        return app(GetRouteParametersAction::class)->execute();
    }
}

if (! function_exists('xotSeedModelOnce')) {
    require_once dirname(__DIR__).'/app/Helpers/xot.seed.helper.php';
}

if (! function_exists('xotSeedModelOnce')) {
    /**
     * Fallback se il file app/Helpers non ha registrato la function.
     *
     * @param class-string<Model> $modelClass
     */
    function xotSeedModelOnce(string $modelClass): void
    {
        (new GetFactoryAction())
            ->execute($modelClass)
            ->createOne();
    }
}
