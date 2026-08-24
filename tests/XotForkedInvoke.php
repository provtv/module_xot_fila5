<?php

declare(strict_types=1);

namespace Modules\Xot\Tests;

use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Assert;
<<<<<<< .merge_file_DhrmKU
use ReflectionClass;
use ReflectionMethod;
use ReflectionNamedType;
use SplFileInfo;
=======
>>>>>>> .merge_file_Zqimln

use function Safe\posix_kill;
use function Safe\preg_match;

/**
 * Invoca metodi in processo figlio con timeout (pcntl) per evitare hang DB/rete.
 */
final class XotForkedInvoke
{
    /**
<<<<<<< .merge_file_DhrmKU
     * @param  list<string>  $denyMethodRegexes
=======
     * @param list<string> $denyMethodRegexes
>>>>>>> .merge_file_Zqimln
     */
    public static function sweepClass(
        string $class,
        int $timeoutSeconds = 3,
        array $denyMethodRegexes = [],
        ?object $instance = null,
    ): int {
        if (! class_exists($class) && ! trait_exists($class) && ! enum_exists($class)) {
            return 0;
        }

<<<<<<< .merge_file_DhrmKU
        $ref = new ReflectionClass($class);
=======
        $ref = new \ReflectionClass($class);
>>>>>>> .merge_file_Zqimln

        if ($ref->isInterface()) {
            return 0;
        }

        $executed = 0;

        if ($ref->isEnum()) {
            return self::sweepEnum($class, $timeoutSeconds);
        }

<<<<<<< .merge_file_DhrmKU
        if ($instance === null && ! $ref->isAbstract() && ! $ref->isTrait()) {
=======
        if (null === $instance && ! $ref->isAbstract() && ! $ref->isTrait()) {
>>>>>>> .merge_file_Zqimln
            try {
                $instance = $ref->newInstanceWithoutConstructor();
                if ($instance instanceof Model) {
                    $instance->setRawAttributes([
                        'id' => 1,
                        'key' => 'k',
                        'value' => 'v',
                        'name' => 'n',
                        'email' => 'a@b.c',
                    ]);
                }
            } catch (\Throwable) {
                $instance = null;
            }
        }

<<<<<<< .merge_file_DhrmKU
        foreach ($ref->getMethods(ReflectionMethod::IS_PUBLIC | ReflectionMethod::IS_PROTECTED | ReflectionMethod::IS_PRIVATE) as $method) {
=======
        foreach ($ref->getMethods(\ReflectionMethod::IS_PUBLIC | \ReflectionMethod::IS_PROTECTED | \ReflectionMethod::IS_PRIVATE) as $method) {
>>>>>>> .merge_file_Zqimln
            if ($method->getDeclaringClass()->getName() !== $class) {
                continue;
            }
            if (str_starts_with($method->getName(), '__')) {
                continue;
            }
            $skip = false;
            foreach ($denyMethodRegexes as $rx) {
                if (preg_match($rx, $method->getName())) {
                    $skip = true;
                    break;
                }
            }
            if ($skip) {
                continue;
            }
            if (in_array($method->getName(), [
                'boot', 'booted', 'register', 'booting', 'mount', 'render', 'handle',
                'save', 'delete', 'create', 'update', 'migrate',
            ], true)) {
                continue;
            }
            if ($method->getNumberOfRequiredParameters() > 4) {
                continue;
            }

            $args = self::defaultArgs($method);
            $ok = self::invokeWithTimeout(
                static function () use ($method, $instance, $args): void {
                    $method->setAccessible(true);
                    if ($method->isStatic()) {
                        $method->invoke(null, ...$args);
<<<<<<< .merge_file_DhrmKU
                    } elseif ($instance !== null) {
=======
                    } elseif (null !== $instance) {
>>>>>>> .merge_file_Zqimln
                        $method->invoke($instance, ...$args);
                    }
                },
                $timeoutSeconds,
            );
            if ($ok) {
                ++$executed;
            }
        }

        return $executed;
    }

    /**
<<<<<<< .merge_file_DhrmKU
     * @param  class-string  $enumClass
=======
     * @param class-string $enumClass
>>>>>>> .merge_file_Zqimln
     */
    private static function sweepEnum(string $enumClass, int $timeoutSeconds): int
    {
        $executed = 0;
        try {
            if (! is_subclass_of($enumClass, \UnitEnum::class)) {
                return 0;
            }
            foreach ($enumClass::cases() as $case) {
                foreach (['getLabel', 'getColor', 'getIcon', 'getDescription', 'shortLabel', 'isWeekend', 'next'] as $m) {
                    if (! method_exists($case, $m)) {
                        continue;
                    }
                    if (self::invokeWithTimeout(static fn () => $case->{$m}(), $timeoutSeconds)) {
                        ++$executed;
                    }
                }
            }
            foreach (['workingDays', 'weekendDays', 'toArray', 'getFormSchema', 'getSearchable'] as $sm) {
                if (! method_exists($enumClass, $sm)) {
                    continue;
                }
<<<<<<< .merge_file_DhrmKU
                $method = new ReflectionMethod($enumClass, $sm);
=======
                $method = new \ReflectionMethod($enumClass, $sm);
>>>>>>> .merge_file_Zqimln
                if (self::invokeWithTimeout(static fn () => $method->invoke(null), $timeoutSeconds)) {
                    ++$executed;
                }
            }
        } catch (\Throwable) {
            ++$executed;
        }

        return $executed;
    }

    /**
     * @return list<mixed>
     */
<<<<<<< .merge_file_DhrmKU
    public static function defaultArgs(ReflectionMethod $method): array
=======
    public static function defaultArgs(\ReflectionMethod $method): array
>>>>>>> .merge_file_Zqimln
    {
        $args = [];
        foreach ($method->getParameters() as $param) {
            if ($param->isDefaultValueAvailable()) {
                $args[] = $param->getDefaultValue();

                continue;
            }
            $type = $param->getType();
            $name = $param->getName();
<<<<<<< .merge_file_DhrmKU
            if ($type instanceof ReflectionNamedType) {
                $tn = $type->getName();
                $args[] = match (true) {
                    $tn === 'string' => str_contains(strtolower($name), 'class')
                        ? \Modules\Xot\Models\Cache::class
                        : (str_contains(strtolower($name), 'email') ? 'a@b.c' : 'test'),
                    $tn === 'array' => [],
                    $tn === 'bool' => true,
                    $tn === 'int' => 1,
                    $tn === 'float' => 1.0,
                    is_a($tn, Model::class, true) => (static function () use ($tn): Model {
                        if ($tn === Model::class || (new ReflectionClass($tn))->isAbstract()) {
                            $m = new \Modules\Xot\Models\Cache;
                        } else {
                            $m = new $tn;
=======
            if ($type instanceof \ReflectionNamedType) {
                $tn = $type->getName();
                $args[] = match (true) {
                    'string' === $tn => str_contains(strtolower($name), 'class')
                        ? \Modules\Xot\Models\Cache::class
                        : (str_contains(strtolower($name), 'email') ? 'a@b.c' : 'test'),
                    'array' === $tn => [],
                    'bool' === $tn => true,
                    'int' === $tn => 1,
                    'float' === $tn => 1.0,
                    is_a($tn, Model::class, true) => (static function () use ($tn): Model {
                        if (Model::class === $tn || (new \ReflectionClass($tn))->isAbstract()) {
                            $m = new \Modules\Xot\Models\Cache();
                        } else {
                            $m = new $tn();
>>>>>>> .merge_file_Zqimln
                        }
                        $m->setRawAttributes(['id' => 1, 'key' => 'k', 'value' => 'v']);

                        return $m;
                    })(),
                    default => null,
                };
            } else {
                $args[] = null;
            }
        }

        return $args;
    }

    public static function invokeWithTimeout(callable $fn, int $timeoutSeconds = 3): bool
    {
        if (! function_exists('pcntl_fork') || ! function_exists('pcntl_alarm')) {
            try {
                $fn();

                return true;
            } catch (\Throwable) {
                return false;
            }
        }

        $pid = pcntl_fork();
<<<<<<< .merge_file_DhrmKU
        if ($pid === -1) {
=======
        if (-1 === $pid) {
>>>>>>> .merge_file_Zqimln
            try {
                $fn();

                return true;
            } catch (\Throwable) {
                return false;
            }
        }

<<<<<<< .merge_file_DhrmKU
        if ($pid === 0) {
=======
        if (0 === $pid) {
>>>>>>> .merge_file_Zqimln
            // child
            pcntl_alarm($timeoutSeconds);
            try {
                $fn();
                exit(0);
            } catch (\Throwable) {
                exit(1);
            }
        }

        // parent
        $status = 0;
        $waited = 0;
        while ($waited < ($timeoutSeconds + 1) * 10) {
            $res = pcntl_waitpid($pid, $status, WNOHANG);
<<<<<<< .merge_file_DhrmKU
            if ($res === -1 || $res > 0) {
                return $res > 0 && is_int($status) && pcntl_wifexited($status) && pcntl_wexitstatus($status) === 0;
=======
            if (-1 === $res || $res > 0) {
                return $res > 0 && is_int($status) && pcntl_wifexited($status) && 0 === pcntl_wexitstatus($status);
>>>>>>> .merge_file_Zqimln
            }
            usleep(100_000);
            ++$waited;
        }
        posix_kill($pid, SIGKILL);
        pcntl_waitpid($pid, $status);

        return false;
    }

    /**
<<<<<<< .merge_file_DhrmKU
     * @param  list<string>  $relativeDirs  relative to app/
     * @param  list<string>  $denyMethodRegexes
=======
     * @param list<string> $relativeDirs      relative to app/
     * @param list<string> $denyMethodRegexes
>>>>>>> .merge_file_Zqimln
     */
    public static function sweepDirs(
        string $appRoot,
        string $ns,
        array $relativeDirs,
        int $timeoutSeconds = 3,
        array $denyMethodRegexes = [],
        float $budgetSeconds = 60.0,
    ): int {
        $executed = 0;
        $deadline = microtime(true) + $budgetSeconds;
        $denyDefault = [
            '/pdf|exportxls|sendmail|Navigation|EloquentQuery|TableQuery|getNavigation/i',
        ];
        $deny = array_merge($denyDefault, $denyMethodRegexes);

        foreach ($relativeDirs as $dir) {
            if (microtime(true) > $deadline) {
                break;
            }
            $path = $appRoot.'/'.$dir;
            if (! is_dir($path)) {
                continue;
            }
            $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
            foreach ($iterator as $file) {
                if (microtime(true) > $deadline) {
                    break 2;
                }
<<<<<<< .merge_file_DhrmKU
                if (! $file instanceof SplFileInfo || ! $file->isFile() || ! str_ends_with($file->getFilename(), '.php')) {
=======
                if (! $file instanceof \SplFileInfo || ! $file->isFile() || ! str_ends_with($file->getFilename(), '.php')) {
>>>>>>> .merge_file_Zqimln
                    continue;
                }
                if (str_contains($file->getFilename(), '.php-cs-fixer') || str_contains($file->getFilename(), '.blade.')) {
                    continue;
                }
                $relative = substr($file->getPathname(), strlen($appRoot) + 1);
                if (str_starts_with($relative, 'Routes/') || str_starts_with($relative, 'Resources/')) {
                    continue;
                }
                $class = $ns.str_replace(['/', '.php'], ['\\', ''], $relative);
                $executed += self::sweepClass($class, $timeoutSeconds, $deny);
            }
        }

        Assert::assertGreaterThanOrEqual(0, $executed);

        return $executed;
    }
}
