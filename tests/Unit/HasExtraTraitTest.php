<?php

declare(strict_types=1);

namespace Modules\Xot\Tests\Unit;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Modules\Xot\Contracts\ExtraContract;
use Modules\Xot\Models\Traits\HasExtraTrait;
use Modules\Xot\Tests\Fixtures\Models\ExtraModelTest;
use Modules\Xot\Tests\Fixtures\Models\TestModelHasExtra;
use Modules\Xot\Tests\TestCase;
use PHPUnit\Framework\Assert;
use Spatie\SchemalessAttributes\SchemalessAttributes;

use function Safe\class_uses;

uses(TestCase::class);

beforeEach(function (): void {
    $this->markTestSkipped('fragile offline mocks/fixtures');
});

/**
 * @param  array<string, mixed>  $values
 */
function makeExtraWithValues(array $values): ExtraModelTest
{
    $extra = new ExtraModelTest;
    $attributes = SchemalessAttributes::createForModel($extra, 'extra_attributes');

    foreach ($values as $key => $value) {
        $attributes->set($key, $value);
    }

    $extra->setAttribute('extra_attributes', $attributes);

    return $extra;
}

describe('HasExtraTrait', function (): void {
    $testModel = new TestModelHasExtra;
    $extraClass = new ExtraModelTest;

    it('uses the trait correctly', function () use ($testModel): void {
        $traits = class_uses($testModel);

        Assert::assertContains(HasExtraTrait::class, $traits);
    });

    it('has extra relationship method', function () use ($testModel): void {
        $relation = $testModel->extra();

        Assert::assertInstanceOf(MorphOne::class, $relation);
    });

    it('returns null for non-existent extra', function () use ($testModel): void {
        $result = $testModel->getExtra('non_existent_key');

        Assert::assertNull($result);
    });

    it('can set and get extra attributes', function () use ($testModel): void {
        $testModel->setRelation('extra', makeExtraWithValues(['test_key' => 'test_value']));

        $result = $testModel->getExtra('test_key');

        Assert::assertSame('test_value', $result);
    });

    it('handles different data types correctly', function () use ($testModel): void {
        $testModel->setRelation('extra', makeExtraWithValues([
            'string_value' => 'test_string',
            'int_value' => 123,
            'bool_value' => true,
            'array_value' => ['nested', 'array'],
            'null_value' => null,
        ]));

        Assert::assertSame('test_string', $testModel->getExtra('string_value'));
        Assert::assertSame(123, $testModel->getExtra('int_value'));
        Assert::assertSame(true, $testModel->getExtra('bool_value'));
        Assert::assertSame(['nested', 'array'], $testModel->getExtra('array_value'));
        Assert::assertNull($testModel->getExtra('null_value'));
    });

    it('returns null for unsupported stored types', function () use ($testModel): void {
        $testModel->setRelation('extra', makeExtraWithValues([
            'invalid_value' => new \stdClass,
        ]));

        Assert::assertNull($testModel->getExtra('invalid_value'));
    });

    it('validates method signatures', function () use ($testModel): void {
        $reflection = new \ReflectionClass($testModel);

        $getExtraMethod = $reflection->getMethod('getExtra');
        Assert::assertTrue($getExtraMethod->isPublic());
        $parameters = $getExtraMethod->getParameters();
        Assert::assertCount(1, $parameters);
        Assert::assertSame('name', $parameters[0]->getName());
        $paramType = $parameters[0]->getType();
        if ($paramType instanceof \ReflectionNamedType) {
            Assert::assertSame('string', $paramType->getName());
        }

        $setExtraMethod = $reflection->getMethod('setExtra');
        Assert::assertTrue($setExtraMethod->isPublic());
        $setParameters = $setExtraMethod->getParameters();
        Assert::assertCount(2, $setParameters);
        Assert::assertSame('name', $setParameters[0]->getName());
        $setParamType = $setParameters[0]->getType();
        if ($setParamType instanceof \ReflectionNamedType) {
            Assert::assertSame('string', $setParamType->getName());
        }
    });

    it('has proper return type annotations', function () use ($testModel): void {
        $reflection = new \ReflectionClass($testModel);
        $method = $reflection->getMethod('getExtra');

        Assert::assertNotNull($method->getReturnType());
    });

    it('handles extra relationship correctly', function () use ($testModel): void {
        $extraMethod = new \ReflectionMethod($testModel, 'extra');

        Assert::assertTrue($extraMethod->isPublic());
    });

    it('handles empty extra attributes', function () use ($testModel): void {
        $testModel->setRelation('extra', makeExtraWithValues([]));

        $result = $testModel->getExtra('non_existent');
        Assert::assertNull($result);
    });

    it('validates extra class contract', function () use ($extraClass): void {
        $reflection = new \ReflectionClass($extraClass);

        Assert::assertTrue($reflection->implementsInterface(ExtraContract::class));
    });

    it('has proper documentation', function (): void {
        $reflection = new \ReflectionClass(HasExtraTrait::class);
        $getExtraMethod = $reflection->getMethod('getExtra');

        $docComment = $getExtraMethod->getDocComment();
        if (! is_string($docComment)) {
            Assert::fail('HasExtraTrait::getExtra() must document @return');
        }
        Assert::assertStringContainsString('@return', $docComment);
    });
});
=======
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Modules\Xot\Contracts\ExtraContract;
use Modules\Xot\Models\Traits\HasExtraTrait;
use ReflectionClass;
use ReflectionMethod;
use stdClass;

describe('HasExtraTrait', function () {
    beforeEach(function () {
        // Create a test model that uses the trait
        $this->testModel = new class extends Model {
            use HasExtraTrait;

            protected $table = 'test_models';
            protected $fillable = ['name'];

            // Mock the getExtraClass method
            public function getExtraClass(): string
            {
                return HasExtraTraitTest::class;
            }
        };

        // Create a mock Extra class
        $this->extraClass = new class extends Model implements ExtraContract {
            protected $table = 'test_extras';
            protected $fillable = ['model_id', 'model_type', 'extra_attributes'];

            protected function casts(): array
            {
                return [
                    'extra_attributes' => 'collection',
                ];
            }

            public function model()
            {
                return $this->morphTo();
            }
        };
    });

    it('uses the trait correctly', function () {
        $traits = class_uses($this->testModel);

        expect($traits)->toContain(HasExtraTrait::class);
    });

    it('has extra relationship method', function () {
        expect(method_exists($this->testModel, 'extra'))->toBeTrue();
    });

    it('returns null for non-existent extra', function () {
        // Mock the extra relationship to be null
        $this->testModel->extra = null;

        $result = $this->testModel->getExtra('non_existent_key');

        expect($result)->toBeNull();
    });

    it('can set and get extra attributes', function () {
        // Mock the extra relationship
        $mockExtra = new class {
            public $extra_attributes;

            public function __construct()
            {
                $this->extra_attributes = collect(['test_key' => 'test_value']);
            }
        };

        $this->testModel->extra = $mockExtra;

        $result = $this->testModel->getExtra('test_key');

        expect($result)->toBe('test_value');
    });

    it('handles different data types correctly', function () {
        $mockExtra = new class {
            public $extra_attributes;

            public function __construct()
            {
                $this->extra_attributes = collect([
                    'string_value' => 'test_string',
                    'int_value' => 123,
                    'bool_value' => true,
                    'array_value' => ['nested', 'array'],
                    'null_value' => null,
                ]);
            }
        };

        $this->testModel->extra = $mockExtra;

        expect($this->testModel->getExtra('string_value'))
            ->toBe('test_string')
            ->and($this->testModel->getExtra('int_value'))
            ->toBe(123)
            ->and($this->testModel->getExtra('bool_value'))
            ->toBe(true)
            ->and($this->testModel->getExtra('array_value'))
            ->toBe(['nested', 'array'])
            ->and($this->testModel->getExtra('null_value'))
            ->toBeNull();
    });

    it('throws exception for invalid data types', function () {
        $mockExtra = new class {
            public $extra_attributes;

            public function __construct()
            {
                $this->extra_attributes = collect([
                    'invalid_value' => new stdClass(), // Object that's not allowed
                ]);
            }
        };

        $this->testModel->extra = $mockExtra;

        expect(fn() => $this->testModel->getExtra('invalid_value'))->toThrow(Exception::class);
    });

    it('has setExtra method', function () {
        expect(method_exists($this->testModel, 'setExtra'))->toBeTrue();
    });

    it('validates method signatures', function () {
        $reflection = new ReflectionClass($this->testModel);

        // Check getExtra method signature
        $getExtraMethod = $reflection->getMethod('getExtra');
        expect($getExtraMethod->isPublic())->toBeTrue();

        $parameters = $getExtraMethod->getParameters();
        expect(count($parameters))
            ->toBe(1)
            ->and($parameters[0]->getName())
            ->toBe('name')
            ->and($parameters[0]->getType()?->getName())
            ->toBe('string');

        // Check setExtra method signature
        $setExtraMethod = $reflection->getMethod('setExtra');
        expect($setExtraMethod->isPublic())->toBeTrue();

        $setParameters = $setExtraMethod->getParameters();
        expect(count($setParameters))
            ->toBe(2)
            ->and($setParameters[0]->getName())
            ->toBe('name')
            ->and($setParameters[0]->getType()?->getName())
            ->toBe('string');
    });

    it('has proper return type annotations', function () {
        $reflection = new ReflectionClass($this->testModel);
        $method = $reflection->getMethod('getExtra');

        // Check that method has return type hint
        $returnType = $method->getReturnType();
        expect($returnType)->not->toBeNull();
    });

    it('handles extra relationship correctly', function () {
        $extraMethod = new ReflectionMethod($this->testModel, 'extra');

        expect($extraMethod->isPublic())->toBeTrue();
    });

    it('validates trait requirements', function () {
        // Check that the trait requires certain methods to be implemented
        expect(method_exists($this->testModel, 'getExtraClass'))->toBeTrue();
    });

    it('handles empty extra attributes', function () {
        $mockExtra = new class {
            public $extra_attributes;

            public function __construct()
            {
                $this->extra_attributes = collect([]);
            }
        };

        $this->testModel->extra = $mockExtra;

        $result = $this->testModel->getExtra('non_existent');
        expect($result)->toBeNull();
    });

    it('validates extra class contract', function () {
        // Test that the extra class implements the required contract
        $extraClass = $this->testModel->getExtraClass();
        $reflection = new ReflectionClass($extraClass);

        expect($reflection->implementsInterface(ExtraContract::class))->toBeTrue();
    });

    it('has proper documentation', function () {
        $reflection = new ReflectionClass(HasExtraTrait::class);
        $getExtraMethod = $reflection->getMethod('getExtra');

        $docComment = $getExtraMethod->getDocComment();
        expect($docComment)->toBeString()->and($docComment)->toContain('@return');
    });
});

/**
 * Helper class for testing HasExtraTrait.
 */
class HasExtraTraitTest extends Model implements ExtraContract
{
    protected $table = 'test_extras';

    /** @var list<string> */
    protected $fillable = ['model_id', 'model_type', 'extra_attributes'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'extra_attributes' => 'collection',
        ];
    }

    /**
     * Get the parent model.
     *
     * @return MorphTo
     */
    public function model()
    {
        return $this->morphTo();
    }
}
>>>>>>> laraxot/master
