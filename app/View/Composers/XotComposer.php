<?php

declare(strict_types=1);

namespace Modules\Xot\View\Composers;

<<<<<<< HEAD
use Illuminate\Contracts\Auth\Authenticatable;
=======
use Exception;
use Jenssegers\Agent\Agent;
use Modules\Xot\Actions\File\AssetAction;
>>>>>>> laraxot/master
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;
<<<<<<< HEAD
use Jenssegers\Agent\Agent;
use Modules\Xot\Actions\File\AssetAction;
=======
>>>>>>> laraxot/master
use Modules\Xot\Actions\File\AssetPathAction;
use Modules\Xot\Datas\MetatagData;
use Modules\Xot\Datas\XotData;
use Nwidart\Modules\Facades\Module;
use Nwidart\Modules\Laravel\Module as LaravelModule;
use Webmozart\Assert\Assert;

/**
 * Class XotComposer.
 */
class XotComposer
{
    /**
     * Undocumented function.
     *
<<<<<<< HEAD
     * @param  array<mixed|void>  $arguments
=======
     * @param array<mixed|void> $arguments
>>>>>>> laraxot/master
     */
    public function __call(string $name, array $arguments): mixed
    {
        $modules = Module::getOrdered();

<<<<<<< HEAD
        $module = Arr::first($modules, static function (mixed $module) use ($name): bool {
            // Ensure the module is an instance of LaravelModule
            if (! $module instanceof LaravelModule) {
=======
        $module = Arr::first($modules, static function ($module) use ($name): bool {
            // Ensure the module is an instance of LaravelModule
            if (!($module instanceof LaravelModule)) {
>>>>>>> laraxot/master
                return false;
            }

            Assert::string($moduleName = $module->getName());
<<<<<<< HEAD
            $class = '\Modules\\'.$moduleName.'\View\Composers\ThemeComposer';
=======
            $class = '\Modules\\' . $moduleName . '\View\Composers\ThemeComposer';
>>>>>>> laraxot/master

            return method_exists($class, $name);
        });

<<<<<<< HEAD
        if (! \is_object($module)) {
            throw new \Exception('Create a View\Composers\ThemeComposer.php inside a module with ['.$name.'] method');
        }

        Assert::isInstanceOf($module, LaravelModule::class, '['.__LINE__.']['.class_basename($this).']');
        $class = '\Modules\\'.$module->getName().'\View\Composers\ThemeComposer';
=======
        if (!\is_object($module)) {
            throw new Exception('Create a View\Composers\ThemeComposer.php inside a module with [' .
                $name .
                '] method');
        }

        Assert::isInstanceOf($module, LaravelModule::class, '[' . __LINE__ . '][' . class_basename($this) . ']');
        $class = '\Modules\\' . $module->getName() . '\View\Composers\ThemeComposer';
>>>>>>> laraxot/master

        $app = app($class);
        $callback = [$app, $name];
        Assert::isCallable($callback);

        return call_user_func_array($callback, $arguments);
    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $lang = app()->getLocale();
        $view->with('lang', $lang);
        $view->with('_theme', $this);

        if (class_exists('\Jenssegers\Agent\Agent')) {
<<<<<<< HEAD
            $agent = new Agent;
=======
            $agent = new Agent();
>>>>>>> laraxot/master
            $view->with('isMobile', $agent->isMobile());
            $view->with('isTablet', $agent->isTablet());
            $view->with('isDesktop', $agent->isDesktop());
        }

        if (Auth::check()) {
            $profile = XotData::make()->getProfileModel();
            $view->with('profile', $profile);
<<<<<<< HEAD
            /** @var Authenticatable|null $user */
            $user = Auth::user();
            $view->with('user', $user);
=======
            $view->with('user', auth()->user());
>>>>>>> laraxot/master
        }
    }

    public function asset(string $str): string
    {
        return asset(app(AssetAction::class)->execute($str));
    }

    public function path(string $str): string
    {
        return app(AssetPathAction::class)->execute($str);
    }

    public function metatag(string $str): string|bool|null
    {
        $metatag = MetatagData::make();
<<<<<<< HEAD
        $fun = 'get'.Str::studly($str);
        if (method_exists($metatag, $fun)) {
            $value = $metatag->{$fun}();

            return is_string($value) || is_bool($value) ? $value : null;
        }

        $value = $metatag->{$str} ?? null;

        return is_string($value) || is_bool($value) ? $value : null;
=======
        $fun = 'get' . Str::studly($str);
        if (method_exists($metatag, $fun)) {
            // @phpstan-ignore return.type
            return $metatag->{$fun}();
        }

        // @phpstan-ignore return.type
        return $metatag->{$str};
>>>>>>> laraxot/master
    }
}
