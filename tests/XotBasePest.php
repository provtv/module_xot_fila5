<?php

declare(strict_types=1);

namespace Modules\Xot\Tests;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Assert;
use ReflectionClass;
use ReflectionNamedType;
use ReflectionType;
use Throwable;

/**
 * Asserzioni condivise da tutti i moduli.
 *
 * Prima era uno script di funzioni globali caricato con
 * `require_once __DIR__.'/../../Xot/tests/XotBasePest.php'` dal `Pest.php` di
 * ogni modulo. Nel frattempo i test la invocavano come classe
 * (`XotBasePest::reflectionSource(...)`), che non esisteva: a runtime morivano
 * su classe non trovata, e PHPStan segnalava quattordici `class.notFound`.
 *
 * Ora e' una classe vera sotto il PSR-4 gia' dichiarato in
 * `Modules/Xot/composer.json` (`Modules\Xot\Tests\` => `tests/`): l'autoload
 * basta, i `require_once` sparsi nei moduli non servono piu' e i due stati
 * — file presente ma classe assente — non possono piu' coesistere.
 *
 * I test girano sulle repliche MySQL `*_test`, mai su SQLite: stesso dialetto
 * del runtime, nessuna sorpresa fra ambiente di test e produzione.
 */
final class XotBasePest
{
    /**
     * Riga presente sulla connessione indicata.
     *
     * @param array<string, mixed> $where
     */
    public static function assertTableHas(string $connection, string $table, array $where): void
    {
        Assert::assertTrue(self::tableQueryExists($connection, $table, $where));
    }

    /**
     * Riga assente sulla connessione indicata.
     *
     * @param array<string, mixed> $where
     */
    public static function assertTableMissing(string $connection, string $table, array $where): void
    {
        Assert::assertFalse(self::tableQueryExists($connection, $table, $where));
    }

    /**
     * @param array<string, mixed> $where
     */
    public static function tableQueryExists(string $connection, string $table, array $where): bool
    {
        $query = DB::connection($connection)->table($table);

        foreach ($where as $column => $value) {
            $query->where((string) $column, $value);
        }

        return $query->exists();
    }

    /**
     * Rilegge il model dal database e ne garantisce il tipo.
     *
     * @template T of Model
     *
     * @param T               $model
     * @param class-string<T> $class
     *
     * @return T
     */
    public static function assertFreshModel(Model $model, string $class)
    {
        $fresh = $model->fresh();
        Assert::assertInstanceOf($class, $fresh);

        return $fresh;
    }

    /**
     * @template T of Model
     *
     * @param EloquentCollection<int, T>|Collection<int, T> $collection
     * @param class-string<T>                              $class
     *
     * @return T
     */
    public static function assertFirstModel(EloquentCollection|Collection $collection, string $class)
    {
        Assert::assertNotEmpty($collection);
        $first = $collection->first();
        Assert::assertInstanceOf($class, $first);

        return $first;
    }

    /**
     * Narrowing di un valore non tipizzato ad array, senza cast ciechi.
     *
     * Il parametro e' `mixed` per contratto: il compito del metodo e' proprio
     * restringere cio' che arriva da una API che non dichiara il tipo. E' il
     * caso in cui `mixed` non e' una scorciatoia ma la firma corretta.
     *
     * @return array<string, mixed>
     */
    public static function assertArray(mixed $value): array
    {
        Assert::assertIsArray($value);

        /** @var array<string, mixed> $value */
        return $value;
    }

    /**
     * @param class-string<Throwable> $exceptionClass
     */
    public static function assertThrows(callable $callback, string $exceptionClass): void
    {
        try {
            $callback();
        } catch (Throwable $exception) {
            Assert::assertInstanceOf($exceptionClass, $exception);

            return;
        }

        Assert::fail(\sprintf('Expected exception %s was not thrown.', $exceptionClass));
    }

    /**
     * @param list<string>|array<int, string> $haystack
     */
    public static function assertListContains(string $needle, array $haystack): void
    {
        Assert::assertTrue(\in_array($needle, $haystack, true));
    }

    public static function assertReflectionNamedType(?ReflectionType $type): ReflectionNamedType
    {
        Assert::assertNotNull($type);
        Assert::assertInstanceOf(ReflectionNamedType::class, $type);

        return $type;
    }

    public static function assertReflectionTypeName(?ReflectionType $type, string $expected): void
    {
        Assert::assertSame($expected, self::assertReflectionNamedType($type)->getName());
    }

    /**
     * Path del file che dichiara la classe: `getFileName()` puo' tornare `false`
     * per le classi interne, quindi l'assert e' parte del contratto.
     *
     * @param class-string $class
     */
    public static function reflectionFilename(string $class): string
    {
        $filename = (new ReflectionClass($class))->getFileName();
        Assert::assertIsString($filename);

        return $filename;
    }

    /**
     * Sorgente della classe, per gli assert "il codice non contiene X".
     *
     * @param class-string $class
     */
    public static function reflectionSource(string $class): string
    {
        return \Safe\file_get_contents(self::reflectionFilename($class));
    }
}
