<?php

declare(strict_types=1);

use Illuminate\Database\Eloquent\Model;
use Modules\Xot\Models\XotBaseModel;
<<<<<<< HEAD
use Modules\Xot\Tests\TestCase;
use PHPUnit\Framework\Assert;

uses(TestCase::class)->group('no-xot-db');

describe('XotBaseModel Business Logic', function (): void {
    test('xot base model extends eloquent model', function (): void {
        $reflection = new ReflectionClass(XotBaseModel::class);

        Assert::assertTrue($reflection->isSubclassOf(Model::class));
    });

    test('xot base model cannot be instantiated directly', function (): void {
        $reflection = new ReflectionClass(XotBaseModel::class);

        Assert::assertFalse($reflection->isInstantiable());
        Assert::assertTrue($reflection->isSubclassOf(Model::class));
    });

    test('xot base model provides foundation for other models', function (): void {
        Assert::assertTrue(class_exists(XotBaseModel::class));
=======

describe('XotBaseModel Business Logic', function () {
    test('xot base model extends eloquent model', function () {
        expect(XotBaseModel::class)->toBeSubclassOf(Model::class);
    });

    test('xot base model can be instantiated', function () {
        $model = new XotBaseModel();

        expect($model)->toBeInstanceOf(XotBaseModel::class);
        expect($model)->toBeInstanceOf(Model::class);
    });

    test('xot base model provides foundation for other models', function () {
        expect(class_exists(XotBaseModel::class))->toBeTrue();
>>>>>>> laraxot/master
    });
});
