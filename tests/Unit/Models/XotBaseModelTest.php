<?php

declare(strict_types=1);

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Model;
use Modules\Xot\Models\XotBaseModel;
use Modules\Xot\Tests\TestCase;
use Modules\Xot\Traits\Updater;
use PHPUnit\Framework\Assert;

uses(TestCase::class)->group('no-xot-db');
<<<<<<< .merge_file_i4D3SC
=======
use Tests\TestCase;
use Illuminate\Database\Eloquent\Model;
use Modules\Xot\Models\XotBaseModel;
use Modules\Xot\Traits\Updater;

uses(TestCase::class);
>>>>>>> laraxot/master
=======
>>>>>>> .merge_file_VMCa1e

test('xot base model extends eloquent model', function (): void {
    $reflection = new ReflectionClass(XotBaseModel::class);

<<<<<<< HEAD
    Assert::assertTrue($reflection->isSubclassOf(Model::class));
=======
    expect($reflection->isSubclassOf(Model::class))->toBeTrue();
>>>>>>> laraxot/master
});

test('xot base model is abstract', function (): void {
    $reflection = new ReflectionClass(XotBaseModel::class);

<<<<<<< HEAD
    Assert::assertTrue($reflection->isAbstract());
=======
    expect($reflection->isAbstract())->toBeTrue();
>>>>>>> laraxot/master
});

test('xot base model uses updater trait', function (): void {
    $reflection = new ReflectionClass(XotBaseModel::class);
    $traits = $reflection->getTraitNames();

<<<<<<< HEAD
    Assert::assertContains(Updater::class, $traits);
});

test('xot base model has correct snake attributes setting', function (): void {
    Assert::assertTrue(XotBaseModel::$snakeAttributes);
=======
    expect($traits)->toContain(Updater::class);
});

test('xot base model has correct snake attributes setting', function (): void {
    expect(XotBaseModel::$snakeAttributes)->toBeTrue();
>>>>>>> laraxot/master
});

test('xot base model has correct per page setting', function (): void {
    $reflection = new ReflectionClass(XotBaseModel::class);
    $perPageProperty = $reflection->getProperty('perPage');
<<<<<<< HEAD
    $default = $perPageProperty->getDefaultValue();
    Assert::assertSame(30, $default);
});

test('xot base model has correct namespace', function (): void {
    Assert::assertStringContainsString('Modules\Xot\Models', XotBaseModel::class);
=======
    // For protected instance property on abstract class, assert the default value
    $default = $perPageProperty->getDefaultValue();
    expect($default)->toBe(30);
});

test('xot base model has correct namespace', function (): void {
    expect(XotBaseModel::class)->toContain('Modules\Xot\Models');
});

test('xot base model has correct strict types declaration', function (): void {
    $reflection = new ReflectionClass(XotBaseModel::class);
    $filename = $reflection->getFileName();

    if ($filename) {
        $content = file_get_contents($filename);
        expect($content)->toContain('declare(strict_types=1);');
    }
});

test('xot base model has correct use statements', function (): void {
    $reflection = new ReflectionClass(XotBaseModel::class);
    $filename = $reflection->getFileName();

    if ($filename) {
        $content = file_get_contents($filename);
        expect($content)->toContain('use Illuminate\Database\Eloquent\Model;');
        expect($content)->toContain('use Modules\Xot\Traits\Updater;');
    }
>>>>>>> laraxot/master
});

test('xot base model has correct property types', function (): void {
    $reflection = new ReflectionClass(XotBaseModel::class);

    $snakeAttributesProperty = $reflection->getProperty('snakeAttributes');
    $perPageProperty = $reflection->getProperty('perPage');

    $snakeType = $snakeAttributesProperty->getType();
    $perPageType = $perPageProperty->getType();

<<<<<<< .merge_file_i4D3SC
<<<<<<< HEAD
=======
>>>>>>> .merge_file_VMCa1e
    if ($snakeType !== null) {
        Assert::assertInstanceOf(ReflectionNamedType::class, $snakeType);
        Assert::assertSame('bool', $snakeType->getName());
    } else {
        Assert::assertTrue(XotBaseModel::$snakeAttributes);
    }

    if ($perPageType !== null) {
        Assert::assertInstanceOf(ReflectionNamedType::class, $perPageType);
        Assert::assertSame('int', $perPageType->getName());
    } else {
        Assert::assertSame(30, $perPageProperty->getDefaultValue());
=======
    // Some properties may not have explicit type declarations; in that case just ensure defaults are as expected
    if ($snakeType !== null) {
        expect($snakeType->getName())->toBe('bool');
    } else {
        expect(XotBaseModel::$snakeAttributes)->toBeTrue();
    }

    if ($perPageType !== null) {
        expect($perPageType->getName())->toBe('int');
    } else {
        expect($perPageProperty->getDefaultValue())->toBe(30);
>>>>>>> laraxot/master
    }
});

test('xot base model has correct property visibility', function (): void {
    $reflection = new ReflectionClass(XotBaseModel::class);

    $snakeAttributesProperty = $reflection->getProperty('snakeAttributes');
    $perPageProperty = $reflection->getProperty('perPage');

<<<<<<< HEAD
    Assert::assertTrue($snakeAttributesProperty->isPublic());
    Assert::assertTrue($perPageProperty->isProtected());
=======
    expect($snakeAttributesProperty->isPublic())->toBeTrue();
    expect($perPageProperty->isProtected())->toBeTrue();
>>>>>>> laraxot/master
});
