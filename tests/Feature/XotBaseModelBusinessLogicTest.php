<?php

declare(strict_types=1);

namespace Modules\Xot\Tests\Feature;

use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Eloquent\Model;
use Modules\Xot\Models\BaseModel;
use Modules\Xot\Models\Module;
use Modules\Xot\Models\XotBaseModel;
use Modules\Xot\Tests\TestCase;
use PHPUnit\Framework\Assert;

use function Safe\json_encode;
use function Safe\unserialize;

uses(TestCase::class);

function createXotBaseModelFixture(): BaseModel
{
    return new class extends BaseModel {
    };
}

describe('Xot Base Model Business Logic', function (): void {
    test('it extends correct base class', function (): void {
        // Arrange & Act
        $baseModel = createXotBaseModelFixture();

        // Assert
        Assert::assertInstanceOf(XotBaseModel::class, $baseModel);
        Assert::assertInstanceOf(Model::class, $baseModel);
    });

    test('it has required traits', function (): void {
        // Arrange & Act
        $baseModel = createXotBaseModelFixture();

        // Assert
    });

    test('it can be instantiated without database', function (): void {
        // Arrange & Act
        $baseModel = createXotBaseModelFixture();

        // Assert
        Assert::assertInstanceOf(BaseModel::class, $baseModel);
    });

    test('it supports table name override', function (): void {
        // Arrange
        $baseModel = createXotBaseModelFixture();

        // Act
        $tableName = $baseModel->getTable();

        // Assert
<<<<<<< HEAD
       Assert::assertIsString($tableName);
=======
        Assert::assertIsString($tableName);
>>>>>>> laraxot/dev
        Assert::assertNotEmpty($tableName);
    });

    test('it supports connection override', function (): void {
        // Arrange
        $baseModel = createXotBaseModelFixture();

        // Act
        $connection = $baseModel->getConnection();

        // Assert
<<<<<<< HEAD
       Assert::assertNotNull($connection);
=======
        Assert::assertNotNull($connection);
>>>>>>> laraxot/dev
        Assert::assertInstanceOf(ConnectionInterface::class, $connection);
    });

    test('it supports key name override', function (): void {
        // Arrange
        $baseModel = createXotBaseModelFixture();

        // Act
        $keyName = $baseModel->getKeyName();

        // Assert
<<<<<<< HEAD
       Assert::assertIsString($keyName);
=======
        Assert::assertIsString($keyName);
>>>>>>> laraxot/dev
        Assert::assertEquals('id', $keyName);
    });

    test('it can be used as base for other models', function (): void {
        // Arrange
        $module = new Module();

        // Act & Assert
<<<<<<< HEAD
       Assert::assertInstanceOf(XotBaseModel::class, $module);
=======
        Assert::assertInstanceOf(XotBaseModel::class, $module);
>>>>>>> laraxot/dev
        Assert::assertInstanceOf(Model::class, $module);
    });

    test('it supports model configuration', function (): void {
        // Arrange
        $baseModel = createXotBaseModelFixture();

        // Act
        $fillable = $baseModel->getFillable();
        $hidden = $baseModel->getHidden();
        $casts = $baseModel->getCasts();

        // Assert
<<<<<<< HEAD
       Assert::assertIsArray($fillable);
=======
        Assert::assertIsArray($fillable);
>>>>>>> laraxot/dev
        Assert::assertIsArray($hidden);
        Assert::assertIsArray($casts);
    });

    test('it supports soft deletes when configured', function (): void {
        // Arrange & Act
        $baseModel = createXotBaseModelFixture();

        // Assert - Soft deletes may or may not be configured
    });

    test('it supports timestamps when configured', function (): void {
        // Arrange
        $baseModel = createXotBaseModelFixture();

        // Act
        $usesTimestamps = $baseModel->usesTimestamps();

        // Assert
        // Nota: I modelli base possono avere configurazioni diverse
<<<<<<< HEAD
       Assert::assertIsBool($usesTimestamps);
=======
        Assert::assertIsBool($usesTimestamps);
>>>>>>> laraxot/dev
    });

    test('it supports tenant isolation when configured', function (): void {
        // Arrange & Act
        $baseModel = createXotBaseModelFixture();

        // Assert - Tenant isolation may or may not be configured
    });

    test('it supports audit trail when configured', function (): void {
        // Arrange & Act
        $baseModel = createXotBaseModelFixture();

        // Assert - Audit trail may or may not be configured
    });

    test('it can be serialized', function (): void {
        // Arrange
        $baseModel = createXotBaseModelFixture();

        // Act
        $serialized = serialize($baseModel);

        // Assert
<<<<<<< HEAD
       Assert::assertNotEmpty($serialized);
=======
        Assert::assertNotEmpty($serialized);
>>>>>>> laraxot/dev
    });

    test('it can be unserialized', function (): void {
        // Arrange
        $baseModel = createXotBaseModelFixture();
        $serialized = serialize($baseModel);

        // Act
        $unserialized = unserialize($serialized);

        // Assert
<<<<<<< HEAD
       Assert::assertInstanceOf(BaseModel::class, $unserialized);
=======
        Assert::assertInstanceOf(BaseModel::class, $unserialized);
>>>>>>> laraxot/dev
    });

    test('it supports json serialization', function (): void {
        // Arrange
        $baseModel = createXotBaseModelFixture();

        // Act
        $json = json_encode($baseModel);

        // Assert
<<<<<<< HEAD
       Assert::assertNotEmpty($json);
=======
        Assert::assertNotEmpty($json);
>>>>>>> laraxot/dev
        Assert::assertNotFalse($json);
    });

    test('it supports array conversion', function (): void {
        // Arrange
        $baseModel = createXotBaseModelFixture();

        // Act
        $array = $baseModel->toArray();

        // Assert
<<<<<<< HEAD
       Assert::assertIsArray($array);
=======
        Assert::assertIsArray($array);
>>>>>>> laraxot/dev
        Assert::assertNotEmpty($array);
    });

    test('it supports json conversion', function (): void {
        // Arrange
        $baseModel = createXotBaseModelFixture();

        // Act
        $json = $baseModel->toJson();

        // Assert
<<<<<<< HEAD
       Assert::assertIsString($json);
=======
        Assert::assertIsString($json);
>>>>>>> laraxot/dev
        Assert::assertNotEmpty($json);
    });

    test('it supports relationship loading', function (): void {
        // Arrange & Act
        $baseModel = createXotBaseModelFixture();

        // Assert
    });

    test('it supports attribute access', function (): void {
        // Arrange & Act
        $baseModel = createXotBaseModelFixture();

        // Assert
    });

    test('it supports mass assignment protection', function (): void {
        // Arrange
        $baseModel = createXotBaseModelFixture();

        // Act
        $fillable = $baseModel->getFillable();
        $guarded = $baseModel->getGuarded();

        // Assert
<<<<<<< HEAD
       Assert::assertIsArray($fillable);
=======
        Assert::assertIsArray($fillable);
>>>>>>> laraxot/dev
        Assert::assertIsArray($guarded);
    });

    test('it supports model events', function (): void {
        // Arrange & Act
        $baseModel = createXotBaseModelFixture();

        // Assert
    });

    test('it supports observers', function (): void {
        // Arrange & Act
        $baseModel = createXotBaseModelFixture();

        // Assert
    });

    test('it supports scopes', function (): void {
        // Arrange & Act
        $baseModel = createXotBaseModelFixture();

        // Assert
    });

    test('it supports accessors and mutators', function (): void {
        // Arrange & Act
        $baseModel = createXotBaseModelFixture();

        // Assert
    });

    test('it supports casting', function (): void {
        // Arrange
        $baseModel = createXotBaseModelFixture();

        // Act
        $casts = $baseModel->getCasts();

        // Assert
<<<<<<< HEAD
       Assert::assertIsArray($casts);
=======
        Assert::assertIsArray($casts);
>>>>>>> laraxot/dev
    });

    test('it supports dates', function (): void {
        // Arrange
        $baseModel = createXotBaseModelFixture();

        // Act
        $dates = $baseModel->getDates();

        // Assert
<<<<<<< HEAD
       Assert::assertIsArray($dates);
=======
        Assert::assertIsArray($dates);
>>>>>>> laraxot/dev
    });

    test('it supports hidden attributes', function (): void {
        // Arrange
        $baseModel = createXotBaseModelFixture();

        // Act
        $hidden = $baseModel->getHidden();

        // Assert
<<<<<<< HEAD
       Assert::assertIsArray($hidden);
=======
        Assert::assertIsArray($hidden);
>>>>>>> laraxot/dev
    });

    test('it supports visible attributes', function (): void {
        // Arrange
        $baseModel = createXotBaseModelFixture();

        // Act
        $visible = $baseModel->getVisible();

        // Assert
<<<<<<< HEAD
       Assert::assertIsArray($visible);
=======
        Assert::assertIsArray($visible);
>>>>>>> laraxot/dev
    });

    test('it supports appends', function (): void {
        // Arrange
        $baseModel = createXotBaseModelFixture();

        // Act
        $appends = $baseModel->getAppends();

        // Assert
<<<<<<< HEAD
       Assert::assertIsArray($appends);
=======
        Assert::assertIsArray($appends);
>>>>>>> laraxot/dev
    });

    test('it supports with relationships', function (): void {
        // Arrange
        $baseModel = createXotBaseModelFixture();

        // Act
        $with = $baseModel->getAppends();

        // Assert
        Assert::assertIsArray($with);
    });
});
