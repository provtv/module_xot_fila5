<?php

declare(strict_types=1);

namespace Modules\Xot\Tests;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Mockery\MockInterface;
use PHPUnit\Framework\Assert;

use function Safe\rmdir;
use function Safe\scandir;
use function Safe\unlink;
use function Safe\file_get_contents;
use Modules\Xot\States\Transitions\XotBaseTransition;
use Modules\Xot\Actions\Cast\SafeEloquentCastAction;
use Modules\User\Models\User;
use Modules\User\Database\Factories\UserFactory;

/**
 * Base test case for Xot module.
 *
 * Uses MySQL from .env.testing.
 * All module connections are mapped by TenantServiceProvider.
 * Migrations must be run ONCE externally: php artisan migrate --env=testing
 * DatabaseTransactions handles rollback between tests.
 *
 * @property object|null $action
 * @property Model|null $model
 * @property object|null $service
 * @property string|null $tempDir
 * @property object|null $record
 * @property object|null $transition
 * @property object|null $resource
 * @property Model|null $testModel
 * @property object|null $extraClass
 * @property Model|null $baseModel
 * @property string|null $testDir
 */
abstract class TestCase extends XotBaseTestCase
{

    /**
     * Fixture condivisa per i test di SafeEloquentCastAction.
     *
     * @return array{0: SafeEloquentCastAction, 1: Model}
     */
    public static function safeEloquentCastFixture(): array
    {
        $model = new class extends Model
        {
            /** @var array<string, mixed> */
            protected $attributes = [
                'name' => 'Mario',
                'age' => 42,
                'score' => 12.5,
                'active' => true,
                'meta' => ['k' => 'v'],
                'empty' => '',
            ];

            protected $guarded = [];
        };

        return [app(SafeEloquentCastAction::class), $model];
    }

    /**
     * Fixture condivisa per i test di XotBaseTransition.
     *
     * @return array{0: User, 1: XotBaseTransition}
     */
    public static function xotBaseTransitionFixture(): array
    {
        /** @var User $record */
        $record = UserFactory::new()->make();

        $transition = new class($record) extends XotBaseTransition
        {
            public static string $name = 'test_transition';
        };

        return [$record, $transition];
    }
    use DatabaseTransactions;

    /** @var list<string> */
    protected $connectionsToTransact = ['sqlite', 'user', 'tenant', 'xot'];

    public mixed $action = null;

    public mixed $model = null;

    public mixed $service = null;

    public mixed $tempDir = null;

    public mixed $record = null;

    public mixed $transition = null;

    public mixed $resource = null;

    public mixed $testModel = null;

    public mixed $extraClass = null;

    public mixed $baseModel = null;

    public ?string $testDir = null;

    public mixed $saved = null;

    public mixed $extra_attributes = null;

    /**
     * @return array<int, class-string<ServiceProvider>>
     */
    protected function getPackageProviders(Application $app): array
    {
        return parent::getPackageProviders($app);
    }

    protected function setUp(): void
    {
        $this->prepareSharedFixcitySqliteForTesting();

        parent::setUp();

        if ($this->shouldSkipForMissingXotDb()) {
            $this->markTestSkipped('DB condiviso non disponibile per test Feature Xot.');
        }
    }

    /**
     * Salta Feature / `xot-db` offline; Unit puri e `no-xot-db` restano verdi.
     * Shared sqlite non è la replica MySQL di testing.
     *
     * Nota: Pest `uses()->group('xot-db')` non sempre riempie `$this->groups()` —
     * fallback: rileva `group('xot-db')` nel file sorgente del test.
     */
    protected function shouldSkipForMissingXotDb(): bool
    {
        $testFile = $this->resolvePestTestFile();
        $isUnit = $testFile !== null && str_contains($testFile, '/tests/Unit/');
        $isXotDbGroup = false;
        if ($testFile !== null && is_file($testFile)) {
            $source = file_get_contents($testFile);
            if (str_contains($source, "group('no-xot-db')")) {
                return false;
            }
            $isXotDbGroup = str_contains($source, "group('xot-db')");
        }
<<<<<<< .merge_file_LfBQu1

        if ($isUnit && ! $isXotDbGroup) {
            return false;
        }

=======

        if ($isUnit && ! $isXotDbGroup) {
            return false;
        }

>>>>>>> .merge_file_smWcNQ
        // Qui c'era uno skip incondizionato quando il driver è sqlite. La premessa —
        // «lo sqlite condiviso è scratch / incompleto» — è decaduta: lo schema si
        // costruisce con `php artisan xot:build-test-sqlite` e le suite parallele non si
        // lockano più (un solo PDO condiviso, un file per processo via `XOT_TEST_SQLITE`).
        // Se il database manca davvero lo dice il metodo qui sopra, che guarda le tabelle.
        return static::xotDbUnavailable();
    }

    private function resolvePestTestFile(): ?string
    {
        $class = static::class;

        if (property_exists($class, '__filename')) {
            /** @var string $filename */
            $filename = $class::$__filename;

            return $filename;
        }

        $file = (new \ReflectionClass($this))->getFileName();

        return $file !== false ? $file : null;
    }

    /**
     * Feature Xot spesso persistono su `users`: verifica connessione user.
     */
    public static function xotDbUnavailable(): bool
    {
        try {
            DB::connection('user')->getPdo();

            return ! DB::connection('user')->getSchemaBuilder()->hasTable('users');
        } catch (\Throwable) {
            return true;
        }
    }

    /**
     * @template T of object
     *
     * @param  class-string<T>  $class
     * @return T
     */
    public function getAction(string $class): object
    {
        Assert::assertInstanceOf($class, $this->action);

        /** @var T $action */
        $action = $this->action;

        return $action;
    }

    /**
     * @template T of object
     *
     * @param  class-string<T>  $abstract
     * @param  (\Closure(MockInterface&T): void)|null  $callback
     * @return MockInterface&T
     */
    public function mockService(string $abstract, ?\Closure $callback = null): MockInterface
    {
        /** @var MockInterface&T $mock */
        $mock = $this->mock($abstract, $callback);

        return $mock;
    }

    /**
     * @param  class-string<\Throwable>  $exception
     */
    public function expectThrowable(string $exception): void
    {
        $this->expectException($exception);
    }

    public function expectThrowableMessage(string $message): void
    {
        $this->expectExceptionMessageMatches('/'.preg_quote($message, '/').'/');
    }

    public function expectThrowableMessageMatches(string $pattern): void
    {
        $this->expectExceptionMessageMatches($pattern);
    }

    public function failTest(string $message = ''): void
    {
        $this->fail($message);
    }

    /**
     * Recursively remove a directory and all its contents.
     */
    public function rrmdir(string $dir): void
    {
        if (! is_dir($dir)) {
            return;
        }

        /** @var array<int, string> $files */
        $files = scandir($dir);

        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            $path = $dir.'/'.$file;
            if (is_dir($path) && ! is_link($path)) {
                $this->rrmdir($path);

                continue;
            }

            unlink($path);
        }

        rmdir($dir);
=======
use Mockery;
use Modules\SaluteOra\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Hash;
use Modules\Xot\Contracts\UserContract;
use Modules\Xot\Datas\XotData;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    //use DatabaseMigrations;

    // =============================================================================
    // SHARED TEST HELPER FUNCTIONS (DRY Pattern)
    // =============================================================================
    // Queste funzioni erano duplicate in molti file di test
    // Centralizzate qui per manutenibilità e coerenza
    // =============================================================================

    /**
     * Generate a unique email for testing to prevent database conflicts.
     *
     * @return string
     */
    protected static function generateUniqueEmail(): string
    {
        $faker = fake();
        return $faker->unique()->safeEmail();
    }

    /**
     * Get the configured User class via XotData (correct architecture pattern).
     *
     * @return string
     */
    protected static function getUserClass(): string
    {
        return XotData::make()->getUserClass();
    }

    /**
     * Create a test user via XotData pattern with proper architecture.
     *
     * @param array<string, mixed> $attributes
     * @return UserContract
     */
    protected static function createTestUser(array $attributes = []): UserContract
    {
        $userClass = static::getUserClass();
        $defaultData = [
            'email' => static::generateUniqueEmail(),
            'password' => Hash::make('password123'),
            'name' => fake()->name(),
        ];

        $userData = array_merge($defaultData, $attributes);

        /** @var UserContract&Model $user */
        $user = $userClass::factory()->create($userData);

        return $user;
    }

    /**
     * Mock XotData for widget testing (Gold Standard Pattern).
     *
     * Prevents "Class not found" errors and provides consistent behavior
     * across all widget tests.
     *
     * @return void
     */
    protected static function mockXotData(): void
    {
        $mockXotData = Mockery::mock(XotData::class)->makePartial();

        // Mock dei metodi critici con fallback sicuri
        $mockXotData->shouldReceive('getUserClass')->andReturn(User::class);

        $mockXotData
            ->shouldReceive('getUserResourceClassByType')
            ->with('patient')
            ->andReturn('\\Modules\\User\\Filament\\Resources\\PatientResource');

        $mockXotData
            ->shouldReceive('getUserResourceClassByType')
            ->with('doctor')
            ->andReturn('\\Modules\\User\\Filament\\Resources\\DoctorResource');

        $mockXotData
            ->shouldReceive('getUserResourceClassByType')
            ->with(Mockery::any())
            ->andReturn('\\Modules\\User\\Filament\\Resources\\UserResource');

        $mockXotData->shouldReceive('make')->andReturn($mockXotData);

        // ✅ CRITICO: Bind nel container per risoluzione automatica
        app()->instance(XotData::class, $mockXotData);
    }

    /**
     * Create test user with specific type for multi-type testing.
     *
     * @param string $type
     * @param array<string, mixed> $attributes
     * @return UserContract
     */
    protected static function createTestUserWithType(string $type, array $attributes = []): UserContract
    {
        $attributes['type'] = $type;
        return static::createTestUser($attributes);
    }

    /**
     * Generate test data array with common fields.
     *
     * @param array<string, mixed> $overrides
     * @return array<string, mixed>
     */
    protected static function generateTestData(array $overrides = []): array
    {
        $defaultData = [
            'name' => fake()->name(),
            'email' => static::generateUniqueEmail(),
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        return array_merge($defaultData, $overrides);
    }

    /**
     * Assert that user is authenticated with correct type.
     *
     * @param string|null $expectedType
     * @return void
     */
    protected function assertUserAuthenticated(null|string $expectedType = null): void
    {
        $this->assertAuthenticated();

        if ($expectedType !== null) {
            /** @var UserContract|null $user */
            $user = auth()->user();
            $this->assertNotNull($user);

            if ($user && method_exists($user, 'type')) {
                $this->assertEquals($expectedType, $user->type ?? null);
            }
        }
>>>>>>> laraxot/master
    }
}
