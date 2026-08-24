<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Artisan;
use Modules\Xot\Database\Factories\ModuleFactory;
use Modules\Xot\Models\Module;
use Modules\Xot\Tests\TestCase;
use PHPUnit\Framework\Assert;

uses(TestCase::class)->group('xot-db');

it('can create a test module', function () {
    $module = ModuleFactory::new()->makeOne([
        'name' => 'TestModule',
        'enabled' => true,
    ]);

    Assert::assertInstanceOf(Module::class, $module);
    Assert::assertSame('TestModule', $module->name);
    Assert::assertTrue((bool) $module->enabled);
});

it('registers the migration command', function (): void {
    Assert::assertArrayHasKey('migrate', Artisan::all());
});
