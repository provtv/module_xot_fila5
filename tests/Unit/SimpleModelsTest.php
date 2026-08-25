<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Modules\Xot\Database\Factories\ModuleFactory;
use Modules\Xot\Models\Module;
use Modules\Xot\Tests\TestCase;
use PHPUnit\Framework\Assert;

uses(TestCase::class);

it('can create a test module', function () {
    $module = ModuleFactory::new()->createOne([
        'name' => 'TestModule',
        'enabled' => true,
    ]);

    Assert::assertInstanceOf(Module::class, $module);
    Assert::assertSame('TestModule', $module->name);
    Assert::assertTrue((bool) $module->enabled);
});

it('non esegue migration dai test: i dati sono sacri', function (): void {
    // Nessun `migrate`, `migrate:fresh`, `migrate:refresh`, `db:wipe` o RefreshDatabase
    // dentro la suite. Le migration si lanciano fuori dai test, in avanti, a mano.
    // Qui verifichiamo solo che lo schema atteso ci sia già.
    Assert::assertTrue(Schema::hasTable((new Module)->getTable()));
});
