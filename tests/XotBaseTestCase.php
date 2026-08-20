<?php

declare(strict_types=1);

namespace Modules\Xot\Tests;

use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use Mockery\MockInterface;
use Modules\User\Database\Factories\TenantFactory;
use Modules\User\Database\Factories\UserFactory;
use Modules\User\Models\Tenant;
use Modules\Xot\Contracts\UserContract;
use Modules\Xot\Database\Factories\ModuleFactory;
use Modules\Xot\Datas\XotData;
use Modules\Xot\Models\Module;
use Modules\Xot\Providers\XotServiceProvider;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * Class XotBaseTestCase.
 *
 * Shared bootstrap base test case for module tests.
 * DatabaseTransactions belongs in each module TestCase when that module needs transactional isolation.
 *
 * @property object|null $action
 * @property Model|null $model
 * @property object|null $service
 * @property object|null $widget
 * @property string|null $tempDir
 * @property object|null $record
 * @property object|null $transition
 * @property object|null $resource
 * @property Model|null $testModel
 * @property object|null $extraClass
 * @property Model|null $baseModel
 * @property string|null $testDir
 * @property string|null $workDir
 */
abstract class XotBaseTestCase extends BaseTestCase
{
    use CreatesApplication;

    public mixed $action = null;

    public mixed $model = null;

    public mixed $service = null;

    public mixed $widget = null;

    public mixed $tempDir = null;

    public mixed $record = null;

    public mixed $transition = null;

    public mixed $resource = null;

    public mixed $testModel = null;

    public mixed $extraClass = null;

    public mixed $baseModel = null;

    public ?string $testDir = null;

    public ?string $workDir = null;

    public mixed $saved = null;

    public mixed $extra_attributes = null;

    /**
     * @param  array<string, mixed>  $data
     */
    public function assertDatabaseHasRow(string $table, array $data, ?string $connection = null): void
    {
        $this->assertDatabaseHas($table, $data, $connection);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function assertDatabaseMissingRow(string $table, array $data, ?string $connection = null): void
    {
        $this->assertDatabaseMissing($table, $data, $connection);
    }

    public function assertDatabaseCountRow(string $table, int $count, ?string $connection = null): void
    {
        $this->assertDatabaseCount($table, $count, $connection);
    }

    /**
     * @template T of object
     *
     * @param  class-string<T>  $class
     * @return MockObject&T
     */
    public function createUnitMock(string $class): MockObject
    {
        return $this->createMock($class);
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

    public function skipTest(string $message = ''): never
    {
        $this->markTestSkipped($message);
    }

    /**
     * @param  class-string<\Throwable>  $exceptionClass
     */
    public function expectApplicationException(string $exceptionClass, ?string $message = null): void
    {
        if ($message !== null) {
            $this->expectExceptionObject(new $exceptionClass($message));

            return;
        }

        $this->expectException($exceptionClass);
    }

    /**
     * Percorso del file SQLite condiviso dai test.
     *
     * Sovrascrivibile con `XOT_TEST_SQLITE` perché SQLite ammette un solo writer: per
     * far girare più moduli in parallelo serve un file per processo, altrimenti i run
     * si bloccano a vicenda. Senza la variabile resta il file storico, quindi il
     * comportamento di default non cambia.
     */
    public static function sharedSqlitePath(): string
    {
        $override = getenv('XOT_TEST_SQLITE');

        if (is_string($override) && $override !== '') {
            return $override;
        }

        return database_path('fixcity_data.sqlite');
    }

    /**
     * Punta l'intero ambiente di test sul file sqlite condiviso.
     *
     * Gira dentro `refreshApplication()`, cioe' dopo la creazione dell'app ma prima
     * che `setUpTraits()` faccia partire `DatabaseTransactions`: e' l'unico punto in
     * cui la connessione di default e' ancora modificabile. Senza questo la default
     * resta quella di `.env` (MySQL su un host non raggiungibile) e ogni test muore
     * dopo 120 s di timeout PDO. Le connessioni nominate dei moduli (`ptv`, `sigma`,
     * `activity`, ...) vengono rimappate qui, cosi' `DB::connection('activity')`
     * risolve invece di sollevare "Database connection [activity] not configured".
     */
    protected function refreshApplication(): void
    {
        parent::refreshApplication();

        $database = self::sharedSqlitePath();

        /** @var array<string, mixed> $connections */
        $connections = (array) config('database.connections', []);

        foreach (array_keys($connections) as $name) {
            config()->set('database.connections.'.$name, [
                'driver' => 'sqlite',
                'database' => $database,
                'prefix' => '',
                'foreign_key_constraints' => false,
                'busy_timeout' => 10000,
            ]);
            DB::purge((string) $name);
        }

        config()->set('database.default', 'sqlite');
        DB::purge('sqlite');

        // Il cache store `database` vuole una tabella `cache` che nessuna migration del
        // repo crea: `spatie/laravel-permission` passa dal suo registrar cacheato, e
        // duecento test di Incentivi morivano su `no such table: cache`. In un test la
        // cache non deve nemmeno essere condivisa fra un caso e l'altro.
        config()->set('cache.default', 'array');

        $this->shareSingleSqlitePdoAcrossConnections();
    }

    /**
     * Fa condividere a tutte le connessioni lo stesso oggetto Connection, e quindi lo
     * stesso PDO.
     *
     * Puntarle tutte allo stesso file non basta: ogni nome risolto apre un handle
     * distinto, e `DatabaseTransactions` ne apre una transazione per ciascuno di quelli
     * elencati in `$connectionsToTransact`. SQLite ammette un solo writer, quindi dal
     * secondo `BEGIN` in poi si prende `SQLSTATE[HY000]: General error: 5 database is
     * locked` — otto test di Media morivano così, e nessuno per colpa dello schema.
     *
     * Deve girare **qui**, in coda a `refreshApplication()`: farlo prima di
     * `parent::setUp()` non serve, perché Testbench ricostruisce l'app e l'aliasing
     * viene buttato via insieme alle connessioni risolte.
     */
    private function shareSingleSqlitePdoAcrossConnections(): void
    {
        /** @var DatabaseManager $manager */
        $manager = $this->app->make('db');

        $shared = $manager->connection('sqlite');

        $managerReflection = new \ReflectionClass($manager);
        $connectionsProperty = $managerReflection->getProperty('connections');
        $connectionsProperty->setAccessible(true);

        /** @var array<string, mixed> $resolved */
        $resolved = $connectionsProperty->getValue($manager);

        /** @var array<string, mixed> $connections */
        $connections = (array) config('database.connections', []);

        foreach (array_keys($connections) as $name) {
            $resolved[(string) $name] = $shared;
        }

        $connectionsProperty->setValue($manager, $resolved);
    }

    /**
     * @return array<int, class-string<ServiceProvider>>
     */
    protected function getPackageProviders(Application $app): array
    {
        return [
            XotServiceProvider::class,
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        if (! $this->app->bound('translator')) {
            $this->app->singleton('translator', static function (Application $app): Translator {
                return new Translator(
                    new ArrayLoader,
                    'en'
                );
            });
        }
    }

    protected function tearDown(): void
    {
        try {
            if ($this->app instanceof Application) {
                /** @var DatabaseManager $db */
                $db = $this->app->make('db');

                /** @var array<string, mixed> $connections */
                $connections = (array) config('database.connections', []);
                foreach (array_keys($connections) as $name) {
                    $db->disconnect((string) $name);
                }

                $db->disconnect();
                $db->purge();
            }
        } catch (\Throwable) {
            // Ignore teardown disconnection issues to avoid masking test failures.
        }

        parent::tearDown();
    }

    protected static function generateUniqueEmail(): string
    {
        return 'test-'.uniqid((string) mt_rand(), true).'@example.com';
    }

    /**
     * @return class-string<Model&UserContract>
     */
    protected static function getUserClass(): string
    {
        return XotData::make()->getUserClass();
    }

    /**
     * @param  array<string, mixed>  $attributes
     */
    protected static function createTestUser(array $attributes = []): UserContract
    {
        /** @var Factory<Model&UserContract> $factory */
        $factory = UserFactory::new();
        /** @var UserContract $user */
        $user = $factory->create($attributes);

        return $user;
    }

    /**
     * @param  array<string, mixed>  $attributes
     */
    protected static function createTestTenant(array $attributes = []): Tenant
    {
        /** @var Tenant $tenant */
        $tenant = TenantFactory::new()->createOne($attributes);

        return $tenant;
    }

    /**
     * @param  array<string, mixed>  $attributes
     */
    protected static function createTestModule(array $attributes = []): Module
    {
        return ModuleFactory::new()->createOne($attributes);
    }

    /**
     * Point every sqlite connection at fixcity_data.sqlite and share one PDO.
     *
     * Multiple named connections (activity, user, gdpr, …) on the same SQLite file
     * each opening their own transaction causes "database is locked". Sharing the
     * primary PDO lets DatabaseTransactions roll back all module writes together.
     *
     * Call before parent::setUp() when the test case uses DatabaseTransactions.
     */
    protected function prepareSharedFixcitySqliteForTesting(): void
    {
        if ($this->app === null) {
            $this->refreshApplication();
        }

        $database = self::sharedSqlitePath();

        /** @var array<string, array<string, mixed>> $connections */
        $connections = config('database.connections', []);

        /** @var list<string> $sqliteConnections */
        $sqliteConnections = [];

        foreach (array_keys($connections) as $connection) {
            if (config("database.connections.{$connection}.driver") !== 'sqlite') {
                continue;
            }

            $sqliteConnections[] = $connection;
            $this->app['config']->set("database.connections.{$connection}.database", $database);
            $this->app['config']->set("database.connections.{$connection}.busy_timeout", 10000);
        }

        foreach ($sqliteConnections as $connection) {
            DB::purge($connection);
        }

        if ($sqliteConnections === []) {
            return;
        }

        $primaryName = in_array('sqlite', $sqliteConnections, true)
            ? 'sqlite'
            : $sqliteConnections[0];

        /** @var DatabaseManager $database */
        $database = $this->app->make('db');
        $primaryConnection = $database->connection($primaryName);

        $managerReflection = new \ReflectionClass($database);
        $connectionsProperty = $managerReflection->getProperty('connections');
        $connectionsProperty->setAccessible(true);

        /** @var array<string, mixed> $resolved */
        $resolved = $connectionsProperty->getValue($database);

        foreach ($sqliteConnections as $connection) {
            $resolved[$connection] = $primaryConnection;
        }

        $connectionsProperty->setValue($database, $resolved);
    }

    public function bindInstance(string $abstract, object $instance): void
    {
        $this->instance($abstract, $instance);
    }

    public function disableExceptionHandling(): void
    {
        $this->withoutExceptionHandling();
    }

    public function enableExceptionHandling(): void
    {
        $this->withExceptionHandling();
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
}
