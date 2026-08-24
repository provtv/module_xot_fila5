<?php

declare(strict_types=1);

namespace Modules\Xot\Tests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Mockery\MockInterface;
use Modules\User\Database\Factories\UserFactory;
use Modules\User\Models\User;
use Modules\Xot\Actions\Cast\SafeEloquentCastAction;
use Modules\Xot\States\Transitions\XotBaseTransition;
use PHPUnit\Framework\Assert;

use function Safe\file_get_contents;
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

    /**
     * Fixture condivisa per i test di SafeEloquentCastAction.
     *
     * @return array{0: SafeEloquentCastAction, 1: Model}
     */
    public static function safeEloquentCastFixture(): array
    {
        $model = new class extends Model {
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

        $transition = new class($record) extends XotBaseTransition {
            public static string $name = 'test_transition';
        };

        return [$record, $transition];
    }

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
<<<<<<< .merge_file_Qjat1p
        $isUnit = $testFile !== null && str_contains($testFile, '/tests/Unit/');
        $isXotDbGroup = false;
        if ($testFile !== null && is_file($testFile)) {
=======
        $isUnit = null !== $testFile && str_contains($testFile, '/tests/Unit/');
        $isXotDbGroup = false;
        if (null !== $testFile && is_file($testFile)) {
>>>>>>> .merge_file_xeDs99
            $source = file_get_contents($testFile);
            if (str_contains($source, "group('no-xot-db')")) {
                return false;
            }
            $isXotDbGroup = str_contains($source, "group('xot-db')");
        }
<<<<<<< .merge_file_Qjat1p

        if ($isUnit && ! $isXotDbGroup) {
            return false;
        }

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

=======

        if ($isUnit && ! $isXotDbGroup) {
            return false;
        }

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

        return false !== $file ? $file : null;
    }

    /**
     * Feature Xot spesso persistono su `users`: verifica connessione user.
     */
    public static function xotDbUnavailable(): bool
    {
        try {
            DB::connection('user')->getPdo();

>>>>>>> .merge_file_xeDs99
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
    }
}
