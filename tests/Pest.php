<?php

declare(strict_types=1);

/*
 * Bootstrap Pest — modulo Xot.
 *
 * Gli helper condivisi cross-modulo stanno in `Modules\Xot\Tests\XotBasePest`, raggiungibile
 * per autoload PSR-4: nessun `require_once`, né qui né nei bootstrap degli altri moduli.
 *
 * Ogni file di test dichiara da sé `uses(\Modules\Xot\Tests\TestCase::class);` — forma nuda,
 * sul TestCase **concreto** del modulo, mai su `XotBaseTestCase` che è astratto (AD-5b).
 *
 * Nota storica: qui c'era scritto che `uses(...)->in(...)` e `pest()->extend(...)` erano
 * vietati perché toccano `Pest\PendingCalls\UsesCall` e `Pest\Configuration`, entrambe
 * `@internal`, facendo scattare `method.internalClass`. **Non è più vero.** Con
 * `pestphp/pest-plugin-phpstan` v5 registrato da `phpstan/extension-installer`, quell'
 * identificatore compare zero volte sull'intero `Modules` — misurato il 2026-08-19 su una
 * run da 2036 errori — e `Modules/Activity/tests/Pest.php` usa già `pest()->extend(...)->in(...)`.
 *
 * Il divieto è decaduto; resta la regola sul bersaglio del binding, che è una scelta di
 * architettura e non un effetto collaterale dell'analisi statica.
 *
 * Perché la nota resta invece di sparire: il divieto è stato copiato negli handoff di più
 * sessioni, e senza una smentita esplicita continua a propagarsi.
 *
 * @see ../docs/wiki/concepts/pest5-configuring-tests.md
 */
