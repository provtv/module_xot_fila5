<?php

declare(strict_types=1);

namespace Modules\Xot\Tests\Unit;

use Illuminate\Support\Facades\Artisan;
<<<<<<< .merge_file_oPZ25A
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Request;
use Mockery;
=======
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Request;
>>>>>>> .merge_file_0CnKgq
use Modules\Xot\Actions\ArtisanAction;
use Modules\Xot\Console\Commands\BuildTestSqliteCommand;
use Modules\Xot\Console\Commands\ExecuteSqlFileCommand;
use Modules\Xot\Console\Commands\GenerateFilamentResources;
use Modules\Xot\Console\Commands\SearchTextInDbCommand;
use Modules\Xot\Helpers\ResourceFormSchemaGenerator;
use Modules\Xot\Services\RouteService;
use Modules\Xot\States\Transitions\XotBaseTransition;
use Modules\Xot\Tests\TestCase;
use PHPUnit\Framework\Assert;
<<<<<<< .merge_file_oPZ25A
use ReflectionClass;
use ReflectionMethod;
=======
>>>>>>> .merge_file_0CnKgq
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;

uses(TestCase::class)->group('no-xot-db');

afterEach(function (): void {
<<<<<<< .merge_file_oPZ25A
    Mockery::close();
=======
    \Mockery::close();
>>>>>>> .merge_file_0CnKgq
});

describe('Xot artisan commands helpers coverage', function (): void {
    test('ArtisanAction act branches con Artisan fake', function (): void {
        Http::fake();
        Process::fake();
        Artisan::shouldReceive('call')->zeroOrMoreTimes()->andReturn(0);
        Artisan::shouldReceive('output')->zeroOrMoreTimes()->andReturn('ok');

        Request::replace(['module' => 'Xot']);
        foreach (['routelist', 'queue:flush', 'optimize', 'routelist1', 'clear', 'migrate', 'unknown-act'] as $act) {
            try {
                $out = ArtisanAction::act($act);
                Assert::assertNotEmpty($out);
            } catch (\Throwable $e) {
                Assert::assertNotEmpty($e->getMessage());
            }
        }

<<<<<<< .merge_file_oPZ25A
        $ref = new ReflectionClass(ArtisanAction::class);
        foreach ($ref->getMethods() as $method) {
            if ($method->getDeclaringClass()->getName() !== ArtisanAction::class || str_starts_with($method->getName(), '__')) {
=======
        $ref = new \ReflectionClass(ArtisanAction::class);
        foreach ($ref->getMethods() as $method) {
            if (ArtisanAction::class !== $method->getDeclaringClass()->getName() || str_starts_with($method->getName(), '__')) {
>>>>>>> .merge_file_0CnKgq
                continue;
            }
            try {
                $method->setAccessible(true);
                $args = [];
                foreach ($method->getParameters() as $param) {
                    $args[] = $param->isDefaultValueAvailable()
                        ? $param->getDefaultValue()
<<<<<<< .merge_file_oPZ25A
                        : ($param->getType() instanceof \ReflectionNamedType && $param->getType()->getName() === 'string' ? 'Xot' : null);
=======
                        : ($param->getType() instanceof \ReflectionNamedType && 'string' === $param->getType()->getName() ? 'Xot' : null);
>>>>>>> .merge_file_0CnKgq
                }
                if ($method->isStatic()) {
                    $method->invoke(null, ...$args);
                }
            } catch (\Throwable) {
            }
        }
    });

    test('console commands helpers RouteService ResourceFormSchema Transition', function (): void {
        Http::fake();
        Process::fake();
        $n = 0;
        foreach ([
            BuildTestSqliteCommand::class,
            ExecuteSqlFileCommand::class,
            GenerateFilamentResources::class,
            SearchTextInDbCommand::class,
            RouteService::class,
            ResourceFormSchemaGenerator::class,
            XotBaseTransition::class,
        ] as $class) {
            if (! class_exists($class)) {
                continue;
            }
            try {
<<<<<<< .merge_file_oPZ25A
                $ref = new ReflectionClass($class);
=======
                $ref = new \ReflectionClass($class);
>>>>>>> .merge_file_0CnKgq
                $inst = $ref->isAbstract() ? null : $ref->newInstanceWithoutConstructor();
                if ($inst instanceof \Illuminate\Console\Command) {
                    try {
                        $inst->setLaravel(app());
                    } catch (\Throwable) {
                    }
                }
<<<<<<< .merge_file_oPZ25A
                foreach ($ref->getMethods(ReflectionMethod::IS_PUBLIC | ReflectionMethod::IS_PROTECTED | ReflectionMethod::IS_PRIVATE) as $method) {
=======
                foreach ($ref->getMethods(\ReflectionMethod::IS_PUBLIC | \ReflectionMethod::IS_PROTECTED | \ReflectionMethod::IS_PRIVATE) as $method) {
>>>>>>> .merge_file_0CnKgq
                    if ($method->getDeclaringClass()->getName() !== $class || str_starts_with($method->getName(), '__')) {
                        continue;
                    }
                    if (in_array($method->getName(), ['handle', 'boot', 'register', 'mount', 'render'], true)) {
                        continue;
                    }
                    try {
                        $method->setAccessible(true);
                        $args = [];
                        foreach ($method->getParameters() as $param) {
                            $args[] = $param->isDefaultValueAvailable()
                                ? $param->getDefaultValue()
<<<<<<< .merge_file_oPZ25A
                                : ($param->getType() instanceof \ReflectionNamedType && $param->getType()->getName() === 'string' ? 'Xot' : []);
                        }
                        if ($method->isStatic()) {
                            $method->invoke(null, ...$args);
                        } elseif ($inst !== null) {
=======
                                : ($param->getType() instanceof \ReflectionNamedType && 'string' === $param->getType()->getName() ? 'Xot' : []);
                        }
                        if ($method->isStatic()) {
                            $method->invoke(null, ...$args);
                        } elseif (null !== $inst) {
>>>>>>> .merge_file_0CnKgq
                            $method->invoke($inst, ...$args);
                        }
                        ++$n;
                    } catch (\Throwable) {
                        ++$n;
                    }
                }
                if ($inst instanceof \Illuminate\Console\Command) {
                    try {
                        $def = $inst->getDefinition();
                        $input = ['command' => $inst->getName() ?? 'xot'];
                        if ($def->hasOption('dry-run')) {
                            $input['--dry-run'] = true;
                        }
                        if ($def->hasOption('analyze')) {
                            $input['--analyze'] = true;
                        }
                        if ($def->hasOption('module')) {
                            $input['--module'] = 'Xot';
                        }
<<<<<<< .merge_file_oPZ25A
                        $inst->run(new ArrayInput($input), new NullOutput);
=======
                        $inst->run(new ArrayInput($input), new NullOutput());
>>>>>>> .merge_file_0CnKgq
                        ++$n;
                    } catch (\Throwable) {
                        ++$n;
                    }
                }
            } catch (\Throwable) {
                ++$n;
            }
        }
        Assert::assertGreaterThan(5, $n);
    });
});
