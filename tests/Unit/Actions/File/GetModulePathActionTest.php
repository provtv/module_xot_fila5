<?php

declare(strict_types=1);

use Illuminate\Support\Facades\File;
use Modules\Xot\Actions\File\GetModulePathAction;
use Modules\Xot\Tests\TestCase;
use Nwidart\Modules\Facades\Module;
use PHPUnit\Framework\Assert;

uses(TestCase::class);

it('gets module path from facade correctly', function (): void {
    // Spy on Module facade
    Module::partialMock()->allows([
        'getModulePath' => function (string $module): string {
            return 'Xot' === $module ? '/path/to/Xot/' : '';
        },
    ]);

    $action = app(GetModulePathAction::class);
    $result = $action->execute('Xot');

<<<<<<< HEAD
   Assert::assertSame('/path/to/Xot/', $result);
=======
    Assert::assertSame('/path/to/Xot/', $result);
>>>>>>> laraxot/dev
});

it('gets module path from fallback correctly', function (): void {
    // We assume Modules directory exists in base_path
    $modulesPath = base_path('Modules');
    if (! File::exists($modulesPath)) {
        File::makeDirectory($modulesPath);
    }

    // Create a dummy module dir
    $dummyModule = $modulesPath.'/TestModule';
    if (! File::exists($dummyModule)) {
        File::makeDirectory($dummyModule);
    }

<<<<<<< HEAD
   // Spy on Module facade to throw exception, forcing fallback
=======
    // Spy on Module facade to throw exception, forcing fallback
>>>>>>> laraxot/dev
    Module::partialMock()->allows([
        'getModulePath' => function (string $module): string {
            throw new Exception('Module not found');
        },
    ]);

    $action = app(GetModulePathAction::class);
    // Case-insensitive search
    $result = $action->execute('testmodule');

<<<<<<< HEAD
   Assert::assertSame($dummyModule, $result);
=======
    Assert::assertSame($dummyModule, $result);
>>>>>>> laraxot/dev
    File::deleteDirectory($dummyModule);
});
