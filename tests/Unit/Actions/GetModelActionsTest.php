<?php

declare(strict_types=1);

use Illuminate\Database\Eloquent\Model;
use Modules\Xot\Actions\Cast\SafeIntCastAction;
use Modules\Xot\Actions\GetModelByModelTypeAction;
use Modules\Xot\Actions\GetModelClassByModelTypeAction;
use Modules\Xot\Actions\GetModelTypeByModelAction;
use Modules\Xot\Contracts\ModelContract;
use Modules\Xot\Tests\Fixtures\DemoModel;
use Modules\Xot\Tests\Fixtures\FakeQueryableModel;
use Modules\Xot\Tests\TestCase;
use PHPUnit\Framework\Assert;

uses(TestCase::class);

it('gets model class by model type from morph map', function (): void {
    config()->set('morph_map', ['demo' => DemoModel::class]);

    $result = app(GetModelClassByModelTypeAction::class)->execute('demo');

<<<<<<< HEAD
   Assert::assertSame(DemoModel::class, $result);
=======
    Assert::assertSame(DemoModel::class, $result);
>>>>>>> laraxot/dev
});

it('throws when morph map config is not an array', function (): void {
    config()->set('morph_map', 'invalid');

<<<<<<< HEAD
   try {
=======
    try {
>>>>>>> laraxot/dev
        app(GetModelClassByModelTypeAction::class)->execute('demo');
        Assert::fail('Expected exception not thrown');
    } catch (Exception $e) {
        Assert::assertInstanceOf(Exception::class, $e);
    }
});

it('throws when model type key is missing in morph map', function (): void {
    config()->set('morph_map', ['demo' => DemoModel::class]);

    try {
        app(GetModelClassByModelTypeAction::class)->execute('missing');
    } catch (Throwable $e) {
<<<<<<< HEAD
       Assert::assertInstanceOf(InvalidArgumentException::class, $e);
=======
        Assert::assertInstanceOf(InvalidArgumentException::class, $e);
>>>>>>> laraxot/dev

        return;
    }
    Assert::fail('Exception not thrown');
});

it('instantiates model by type when id is null', function (): void {
    config()->set('morph_map', ['demo' => DemoModel::class]);

    $result = app(GetModelByModelTypeAction::class)->execute('demo', null);

<<<<<<< HEAD
   Assert::assertInstanceOf(DemoModel::class, $result);
=======
    Assert::assertInstanceOf(DemoModel::class, $result);
>>>>>>> laraxot/dev
});

it('loads model by id when record exists', function (): void {
    config()->set('morph_map', ['demo' => FakeQueryableModel::class]);
    FakeQueryableModel::$findResult = new DemoModel();
    FakeQueryableModel::$findResult->setAttribute('id', 123);

    $result = app(GetModelByModelTypeAction::class)->execute('demo', '123');

<<<<<<< HEAD
   Assert::assertInstanceOf(DemoModel::class, $result);
=======
    Assert::assertInstanceOf(DemoModel::class, $result);
>>>>>>> laraxot/dev
    Assert::assertSame(123, SafeIntCastAction::cast($result->getKey()));
});

it('throws when model id is provided but record is missing', function (): void {
    config()->set('morph_map', ['demo' => FakeQueryableModel::class]);
    FakeQueryableModel::$findResult = null;

<<<<<<< HEAD
   try {
=======
    try {
>>>>>>> laraxot/dev
        app(GetModelByModelTypeAction::class)->execute('demo', '999999');
        Assert::fail('Expected exception not thrown');
    } catch (Exception $e) {
        Assert::assertInstanceOf(Exception::class, $e);
    }
});

it('returns snake model type from model contract instance', function (): void {
    $model = new class extends Model implements ModelContract {
    };

    $result = app(GetModelTypeByModelAction::class)->execute($model);

<<<<<<< HEAD
   Assert::assertStringContainsString('model', $result);
=======
    Assert::assertStringContainsString('model', $result);
>>>>>>> laraxot/dev
    Assert::assertIsString($result);
});
