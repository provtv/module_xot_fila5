<?php

declare(strict_types=1);

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Assert;

/*
 * Bootstrap Pest condiviso di tutti i moduli.
 *
 * Ogni `Modules/<Modulo>/tests/Pest.php` parte da qui:
 *
 *     require_once __DIR__.'/../../Xot/tests/XotBasePest.php';
 *
 * PHP non permette a uno script di bootstrap di "estendere" una classe: la
 * relazione base → modulo si realizza con questo require. Qui vive solo ciò che
 * serve a TUTTI i moduli; gli helper specifici del dominio (factory, create*,
 * make*) restano nel Pest.php del modulo.
 *
 * Regole:
 * - vietato `uses()->in()` e `pest()->extend()` in questi bootstrap: PHPStan
 *   li segnala come `method.internalClass`. Ogni file di test dichiara da sé
 *   `uses(\Modules\<Modulo>\Tests\TestCase::class)`.
 * - il TestCase del modulo estende `Modules\Xot\Tests\XotBaseTestCase`.
 * - i test girano su MySQL (repliche `*_test`), mai su SQLite: stesso dialetto
 *   del runtime, nessuna sorpresa fra ambiente di test e produzione.
 *
 * Ogni funzione è protetta da `function_exists()`: in una run full-suite Pest
 * carica il `Pest.php` di TUTTI i moduli nello stesso processo, quindi due
 * moduli che dichiarassero lo stesso helper globale darebbero un fatal
 * "cannot redeclare". La guardia rende il require idempotente e permette a un
 * modulo di sovrascrivere un helper caricandone il proprio *prima* del require.
 */

require_once __DIR__.'/PestStubs.php';

if (! function_exists('xotAssertTableHas')) {
    /**
     * Riga presente sulla connessione indicata.
     *
     * @param  array<string, mixed>  $where
     */
    function xotAssertTableHas(string $connection, string $table, array $where): void
    {
        Assert::assertTrue(xotTableQueryExists($connection, $table, $where));
    }
}

if (! function_exists('xotAssertTableMissing')) {
    /**
     * Riga assente sulla connessione indicata.
     *
     * @param  array<string, mixed>  $where
     */
    function xotAssertTableMissing(string $connection, string $table, array $where): void
    {
        Assert::assertFalse(xotTableQueryExists($connection, $table, $where));
    }
}

if (! function_exists('xotTableQueryExists')) {
    /**
     * @param  array<string, mixed>  $where
     */
    function xotTableQueryExists(string $connection, string $table, array $where): bool
    {
        $query = DB::connection($connection)->table($table);

        foreach ($where as $column => $value) {
            $query->where((string) $column, $value);
        }

        return $query->exists();
    }
}

if (! function_exists('xotAssertFreshModel')) {
    /**
     * Rilegge il model dal database e ne garantisce il tipo.
     *
     * @template T of Model
     *
     * @param  T  $model
     * @param  class-string<T>  $class
     * @return T
     */
    function xotAssertFreshModel(Model $model, string $class)
    {
        $fresh = $model->fresh();
        Assert::assertInstanceOf($class, $fresh);

        return $fresh;
    }
}

if (! function_exists('xotAssertFirstModel')) {
    /**
     * @template T of Model
     *
     * @param  EloquentCollection<int, T>|Collection<int, T>  $collection
     * @param  class-string<T>  $class
     * @return T
     */
    function xotAssertFirstModel(EloquentCollection|Collection $collection, string $class)
    {
        Assert::assertNotEmpty($collection);
        $first = $collection->first();
        Assert::assertInstanceOf($class, $first);

        return $first;
    }
}

if (! function_exists('xotAssertArray')) {
    /**
     * Narrowing di un `mixed` ad array tipizzato, senza cast ciechi.
     *
     * @return array<string, mixed>
     */
    function xotAssertArray(mixed $value): array
    {
        Assert::assertIsArray($value);

        /** @var array<string, mixed> $value */
        return $value;
    }
}

if (! function_exists('xotAssertThrows')) {
    /**
     * @param  class-string<\Throwable>  $exceptionClass
     */
    function xotAssertThrows(callable $callback, string $exceptionClass): void
    {
        try {
            $callback();
        } catch (\Throwable $exception) {
            Assert::assertInstanceOf($exceptionClass, $exception);

            return;
        }

        Assert::fail(\sprintf('Expected exception %s was not thrown.', $exceptionClass));
    }
}

if (! function_exists('xotAssertListContains')) {
    /**
     * @param  list<string>|array<int, string>  $haystack
     */
    function xotAssertListContains(string $needle, array $haystack): void
    {
        Assert::assertTrue(\in_array($needle, $haystack, true));
    }
}

if (! function_exists('xotAssertReflectionNamedType')) {
    function xotAssertReflectionNamedType(?\ReflectionType $type): \ReflectionNamedType
    {
        Assert::assertNotNull($type);
        Assert::assertInstanceOf(\ReflectionNamedType::class, $type);

        return $type;
    }
}

if (! function_exists('xotAssertReflectionTypeName')) {
    function xotAssertReflectionTypeName(?\ReflectionType $type, string $expected): void
    {
        Assert::assertSame($expected, xotAssertReflectionNamedType($type)->getName());
    }
}

if (! function_exists('xotReflectionFilename')) {
    /**
     * Path del file che dichiara la classe: `getFileName()` può tornare `false`
     * per le classi interne, quindi l'assert è parte del contratto.
     *
     * @param  class-string  $class
     */
    function xotReflectionFilename(string $class): string
    {
        $filename = (new \ReflectionClass($class))->getFileName();
        Assert::assertIsString($filename);

        return $filename;
    }
}

if (! function_exists('xotReflectionSource')) {
    /**
     * Sorgente della classe, per gli assert "il codice non contiene X".
     *
     * @param  class-string  $class
     */
    function xotReflectionSource(string $class): string
    {
        return \Safe\file_get_contents(xotReflectionFilename($class));
    }
}
