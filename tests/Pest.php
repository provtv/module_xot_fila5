<?php

declare(strict_types=1);

use Modules\Xot\Tests\TestCase;

/*
 * Bootstrap Pest — modulo Xot.
 *
 * Configurazione idiomatica secondo https://pestphp.com/docs/configuring-tests:
 * il TestCase si dichiara una volta qui, non in ogni file. I file esistenti
 * continuano a scrivere `uses(TestCase::class)` e va bene: `extend()` e' un
 * default, non un divieto.
 *
 * ## Cronologia — perche' prima era vietato, e cosa lo ha fatto decadere
 *
 * Fino al 2026-08-24 questo file portava la riga «Vietato `pest()->extend()` e
 * `expect()->extend()` qui (PHPStan `method.internalClass`)». Era vero: senza
 * `pestphp/pest-plugin-phpstan` l'analizzatore vedeva `Pest\Expectation`, marcata
 * `@internal` dal pacchetto, chiamata da fuori del namespace `Pest`.
 *
 * La condizione che lo faceva decadere non era scritta da nessuna parte, quindi
 * nessuno l'ha rimisurata: un divieto non produce errori, produce assenza.
 * Installato `pestphp/pest-plugin-phpstan 5.2.0` (Pest 5), la misura del
 * 2026-08-25 su questo file, con `pest()->extend()` **e** `expect()->extend()`:
 *
 *     ./vendor/bin/phpstan analyse Modules/Xot/tests/Pest.php --no-progress
 *     [OK] No errors
 *
 * Nessuna annotazione phpstan-ignore serve: il plugin risolve `method.internalClass` alla
 * radice. Se un domani ricomparisse, la prima cosa da verificare e' che
 * `pest-plugin-phpstan` sia ancora installato e caricato da
 * `phpstan/extension-installer` — non che il divieto vada reintrodotto.
 *
 * Regola generale, da qui in avanti: un divieto scritto in un commento dichiara
 * la condizione che lo fa scadere, altrimenti sopravvive alla propria causa.
 *
 * ## Cosa non vive piu' qui
 *
 * Nessun `require_once`. Le asserzioni condivise stanno in
 * `Modules\Xot\Tests\XotBasePest`, i fixture in `Modules\Xot\Tests\Fixtures\`:
 * li risolve il PSR-4 gia' dichiarato in `Modules/Xot/composer.json`.
 * Gli helper `Pest\Laravel\*` li fornisce `pestphp/pest-plugin-laravel`.
 *
 * I test girano sulle repliche MySQL `*_test`, mai su SQLite.
 *
 * Story: XOT-5.41, ROOT-17.6.
 */

pest()->extend(TestCase::class)->in(__DIR__.'/Unit', __DIR__.'/Feature');
