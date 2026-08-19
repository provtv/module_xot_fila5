<?php

declare(strict_types=1);

/*
 * Bootstrap Pest — modulo Xot.
 *
 * Gli helper condivisi cross-modulo stanno in `Modules\Xot\Tests\XotBasePest`, raggiungibile
 * per autoload PSR-4: nessun `require_once`, né qui né nei bootstrap degli altri moduli.
 *
 * Ogni file di test dichiara da sé `uses(\Modules\Xot\Tests\TestCase::class);`. Vietati
 * `uses(...)->in(...)` e `pest()->extend(...)`: chiamano metodi di `Pest\PendingCalls\UsesCall`
 * e `Pest\Configuration`, entrambe `@internal`, e PHPStan risponde `method.internalClass`.
 */
