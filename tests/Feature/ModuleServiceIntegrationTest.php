<?php

declare(strict_types=1);

<<<<<<< HEAD
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Modules\Xot\Actions\ModuleAction;
use Modules\Xot\Tests\TestCase;
use PHPUnit\Framework\Assert;

uses(TestCase::class);

describe('ModuleAction Integration', function () {
    beforeEach(function () {});

    it('integrates with Nwidart Modules system', function () {
        Assert::assertTrue(class_exists('Nwidart\Modules\Facades\Module'));
        Assert::assertTrue(class_exists('Nwidart\Modules\Module'));
=======
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Modules\Xot\Services\ModuleService;

describe('ModuleService Integration', function () {
    beforeEach(function () {
        $this->service = new ModuleService('Xot');
    });

    it('integrates with Nwidart Modules system', function () {
        expect(class_exists('Nwidart\Modules\Facades\Module'))
            ->toBeTrue()
            ->and(class_exists('Nwidart\Modules\Module'))
            ->toBeTrue();
>>>>>>> laraxot/master
    });

    it('can find existing modules', function () {
        // Test with known existing modules
<<<<<<< HEAD
        $chartService = new ModuleAction('Chart');
        $userService = new ModuleAction('User');
        $xotService = new ModuleAction('Xot');

        Assert::assertInstanceOf(ModuleAction::class, $chartService);

        Assert::assertInstanceOf(ModuleAction::class, $userService);

        Assert::assertInstanceOf(ModuleAction::class, $xotService);

        Assert::assertInstanceOf(ModuleAction::class, $userService);

        Assert::assertInstanceOf(ModuleAction::class, $xotService);
=======
        $chartService = new ModuleService('Chart');
        $userService = new ModuleService('User');
        $xotService = new ModuleService('Xot');

        expect($chartService)
            ->toBeInstanceOf(ModuleService::class)
            ->and($userService)
            ->toBeInstanceOf(ModuleService::class)
            ->and($xotService)
            ->toBeInstanceOf(ModuleService::class);
>>>>>>> laraxot/master
    });

    it('returns models from existing modules', function () {
        // Test with Chart module (we know it exists)
<<<<<<< HEAD
        $chartService = new ModuleAction('Chart');
        /** @var array<int|string, class-string> $models */
        $models = $chartService->getModels();

        // Should contain Chart model
        $hasChartModel = false;
        foreach ($models as $key => $modelClass) {
            if (is_string($modelClass) && str_contains($modelClass, 'Chart\\Models\\Chart')) {
=======
        $chartService = new ModuleService('Chart');
        $models = $chartService->getModels();

        expect($models)->toBeArray();

        // Should contain Chart model
        $hasChartModel = false;
        foreach ($models as $key => $modelClass) {
            if (str_contains($modelClass, 'Chart\\Models\\Chart')) {
>>>>>>> laraxot/master
                $hasChartModel = true;
                break;
            }
        }

<<<<<<< HEAD
        Assert::assertTrue($hasChartModel);
    });

    it('handles User module models correctly', function () {
        $userService = new ModuleAction('User');
        /** @var array<int|string, class-string> $models */
        $models = $userService->getModels();

=======
        expect($hasChartModel)->toBeTrue();
    });

    it('handles User module models correctly', function () {
        $userService = new ModuleService('User');
        $models = $userService->getModels();

        expect($models)->toBeArray();

>>>>>>> laraxot/master
        // Check for common User module models
        $modelClasses = array_values($models);
        $hasUserModels = false;

        foreach ($modelClasses as $modelClass) {
<<<<<<< HEAD
            if (is_string($modelClass) && str_contains($modelClass, 'User\\Models\\')) {
=======
            if (str_contains($modelClass, 'User\\Models\\')) {
>>>>>>> laraxot/master
                $hasUserModels = true;
                break;
            }
        }

<<<<<<< HEAD
        Assert::assertTrue($hasUserModels);
    });

    it('filters abstract models correctly', function () {
        $xotService = new ModuleAction('Xot');
        $models = $xotService->getModels();

        // BaseModel should not be included (it's abstract)
        $modelNames = array_keys($models);
        Assert::assertStringNotContainsString('base_model', implode(',', $modelNames));
    });

    it('returns class strings as values', function () {
        $xotService = new ModuleAction('Xot');
        $models = $xotService->getModels();

        foreach ($models as $key => $modelClass) {
            Assert::assertNotEmpty($key);
            Assert::assertNotEmpty($modelClass);
            Assert::assertTrue(str_contains($modelClass, 'Modules\\'));
=======
        expect($hasUserModels)->toBeTrue();
    });

    it('filters abstract models correctly', function () {
        $models = $this->service->getModels();

        // BaseModel should not be included (it's abstract)
        $modelNames = array_keys($models);
        expect($modelNames)->not->toContain('base_model');
    });

    it('returns class strings as values', function () {
        $models = $this->service->getModels();

        foreach ($models as $key => $modelClass) {
            expect($key)
                ->toBeString()
                ->and($modelClass)
                ->toBeString()
                ->and(str_contains($modelClass, 'Modules\\'))
                ->toBeTrue();
>>>>>>> laraxot/master
        }
    });

    it('handles reflection operations safely', function () {
        // Test that reflection operations don't cause crashes
<<<<<<< HEAD
        $xotService = new ModuleAction('Xot');
        $models = $xotService->getModels();

        // Test each returned model class
        foreach ($models as $modelClass) {
            Assert::assertTrue(is_string($modelClass) && (class_exists($modelClass) || interface_exists($modelClass)));
=======
        $models = $this->service->getModels();

        // Test each returned model class
        foreach ($models as $modelClass) {
            expect(class_exists($modelClass) || interface_exists($modelClass))->toBeTrue();
>>>>>>> laraxot/master
        }
    });

    it('processes module directory structure', function () {
        // Test that the service can process module directories
<<<<<<< HEAD
        $xotService = new ModuleAction('Xot');
        $models = $xotService->getModels();
=======
        $models = $this->service->getModels();

        expect($models)->toBeArray();
>>>>>>> laraxot/master
    });

    it('handles snake_case conversion correctly', function () {
        // Test string conversion logic
        $testString = 'TestModelName';
        $snakeCase = Str::snake($testString);

<<<<<<< HEAD
        Assert::assertSame('test_model_name', $snakeCase);
=======
        expect($snakeCase)->toBe('test_model_name');
>>>>>>> laraxot/master
    });

    it('integrates with Laravel filesystem', function () {
        // Test filesystem operations
<<<<<<< HEAD
        Assert::assertTrue(class_exists('Illuminate\Support\Facades\File'));
=======
        expect(class_exists('Illuminate\Support\Facades\File'))->toBeTrue();
>>>>>>> laraxot/master
    });

    it('can handle multiple module instances', function () {
        $services = [
<<<<<<< HEAD
            new ModuleAction('Chart'),
            new ModuleAction('User'),
            new ModuleAction('Xot'),
            new ModuleAction('Job'),
        ];

        foreach ($services as $service) {
            Assert::assertInstanceOf(ModuleAction::class, $service);
            $models = $service->getModels();
=======
            new ModuleService('Chart'),
            new ModuleService('User'),
            new ModuleService('Xot'),
            new ModuleService('Job'),
        ];

        foreach ($services as $service) {
            expect($service)->toBeInstanceOf(ModuleService::class);
            $models = $service->getModels();
            expect($models)->toBeArray();
>>>>>>> laraxot/master
        }
    });

    it('validates module existence checking', function () {
        // Test with non-existent module
<<<<<<< HEAD
        $nonExistentService = new ModuleAction('NonExistentModule');
        $models = $nonExistentService->getModels();

        Assert::assertEmpty($models);
=======
        $nonExistentService = new ModuleService('NonExistentModule');
        $models = $nonExistentService->getModels();

        expect($models)->toBeArray()->and($models)->toBeEmpty();
>>>>>>> laraxot/master
    });

    it('handles namespace construction correctly', function () {
        // Test namespace building logic
<<<<<<< HEAD
        $chartService = new ModuleAction('Chart');
        $models = $chartService->getModels();

        foreach ($models as $modelClass) {
            Assert::assertStringContainsString('Modules\\Chart\\', (string) $modelClass);
=======
        $chartService = new ModuleService('Chart');
        $models = $chartService->getModels();

        foreach ($models as $modelClass) {
            expect($modelClass)->toContain('Modules\\Chart\\');
>>>>>>> laraxot/master
        }
    });

    it('processes file extensions correctly', function () {
        // Test that only .php files are processed
<<<<<<< HEAD
        $xotService = new ModuleAction('Xot');
        $models = $xotService->getModels();

        // All returned classes should be valid PHP classes
        foreach ($models as $modelClass) {
            Assert::assertTrue(is_string($modelClass));
            Assert::assertGreaterThan(0, strlen((string) $modelClass));
=======
        $models = $this->service->getModels();

        // All returned classes should be valid PHP classes
        foreach ($models as $modelClass) {
            expect(is_string($modelClass))->toBeTrue()->and(strlen($modelClass))->toBeGreaterThan(0);
>>>>>>> laraxot/master
        }
    });

    it('handles exception scenarios gracefully', function () {
        // Test various edge cases that might cause exceptions
        $edgeCaseServices = [
<<<<<<< HEAD
            new ModuleAction(''),
            new ModuleAction('InvalidModule'),
            new ModuleAction('Test123'),
        ];

        foreach ($edgeCaseServices as $service) {
=======
            new ModuleService(''),
            new ModuleService('InvalidModule'),
            new ModuleService('Test123'),
        ];

        foreach ($edgeCaseServices as $service) {
            expect($service->getModels(...))->not->toThrow(Exception::class);
>>>>>>> laraxot/master
        }
    });

    it('validates return type consistency', function () {
<<<<<<< HEAD
        $xotService = new ModuleAction('Xot');
        $models = $xotService->getModels();

        // Validate that all keys are strings and all values are class strings
        foreach ($models as $key => $value) {
            Assert::assertNotEmpty($key);
            Assert::assertNotEmpty($value);
            Assert::assertGreaterThan(0, strlen($key));
            Assert::assertGreaterThan(0, strlen($value));
=======
        $models = $this->service->getModels();

        expect($models)->toBeArray();

        // Validate that all keys are strings and all values are class strings
        foreach ($models as $key => $value) {
            expect($key)
                ->toBeString()
                ->and($value)
                ->toBeString()
                ->and(strlen($key))
                ->toBeGreaterThan(0)
                ->and(strlen($value))
                ->toBeGreaterThan(0);
>>>>>>> laraxot/master
        }
    });

    it('can work with Laravel service container', function () {
        // Test service container integration
<<<<<<< HEAD
        $serviceFromContainer = app(ModuleAction::class, ['name' => 'TestModule']);

        Assert::assertInstanceOf(ModuleAction::class, $serviceFromContainer);
=======
        $serviceFromContainer = app(ModuleService::class, ['name' => 'TestModule']);

        expect($serviceFromContainer)->toBeInstanceOf(ModuleService::class);
>>>>>>> laraxot/master
    });

    it('handles concurrent access correctly', function () {
        // Test multiple simultaneous calls
        $results = [];
        for ($i = 0; $i < 3; $i++) {
<<<<<<< HEAD
            $service = new ModuleAction('Xot');
=======
            $service = new ModuleService('Xot');
>>>>>>> laraxot/master
            $results[] = $service->getModels();
        }

        // All results should be consistent
<<<<<<< HEAD
        Assert::assertSame($results[0], $results[1]);
        Assert::assertSame($results[0], $results[2]);
=======
        expect($results[0])->toBe($results[1])->and($results[1])->toBe($results[2]);
>>>>>>> laraxot/master
    });

    it('validates module path resolution', function () {
        // Test that module paths are resolved correctly
<<<<<<< HEAD
        $xotService = new ModuleAction('Xot');
        $models = $xotService->getModels();

        foreach ($models as $modelClass) {
            // Each model class should follow the correct namespace pattern
            Assert::assertMatchesRegularExpression('/^Modules\\\\[A-Za-z]+\\\\Models\\\\[A-Za-z]+$/', (string) $modelClass);
=======
        $models = $this->service->getModels();

        foreach ($models as $modelClass) {
            // Each model class should follow the correct namespace pattern
            expect($modelClass)->toMatch('/^Modules\\\\[A-Za-z]+\\\\Models\\\\[A-Za-z]+$/');
>>>>>>> laraxot/master
        }
    });

    it('handles file system operations safely', function () {
        // Test file system operations
<<<<<<< HEAD
        $xotService = new ModuleAction('Xot');
        $models = $xotService->getModels();
=======
        $models = $this->service->getModels();

        // Should not cause file system errors
        expect($models)->toBeArray();
>>>>>>> laraxot/master
    });

    it('integrates with Laravel string helpers', function () {
        // Test string helper integration
<<<<<<< HEAD
        Assert::assertTrue(class_exists('Illuminate\Support\Str'));
        $testStudly = Str::studly('test_string');
        Assert::assertSame('TestString', $testStudly);
=======
        expect(class_exists('Illuminate\Support\Str'))->toBeTrue();

        $testStudly = Str::studly('test_string');
        expect($testStudly)->toBe('TestString');
>>>>>>> laraxot/master
    });

    it('validates class instantiation patterns', function () {
        // Test that the service follows proper instantiation patterns
<<<<<<< HEAD
        $xotService = new ModuleAction('Xot');
        $reflection = new ReflectionClass($xotService);
        $constructor = $reflection->getConstructor();

        Assert::assertNotNull($constructor);
        Assert::assertTrue($constructor->isPublic());
=======
        $reflection = new ReflectionClass($this->service);
        $constructor = $reflection->getConstructor();

        expect($constructor)->not->toBeNull()->and($constructor->isPublic())->toBeTrue();
>>>>>>> laraxot/master
    });

    it('can handle model discovery efficiently', function () {
        // Test performance of model discovery
<<<<<<< HEAD
        $xotService = new ModuleAction('Xot');
        $startTime = microtime(true);

        $models = $xotService->getModels();
=======
        $startTime = microtime(true);

        $models = $this->service->getModels();
>>>>>>> laraxot/master

        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;

<<<<<<< HEAD
        Assert::assertLessThan(5.0, $executionTime); // Should complete within 5 seconds
=======
        expect($models)->toBeArray()->and($executionTime)->toBeLessThan(5.0); // Should complete within 5 seconds
>>>>>>> laraxot/master
    });
});
