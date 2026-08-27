---
title: "PHPStan Pest Bridge Discipline"
type: concept
module: Xot
tags: [xot, phpstan, pest, testing, bridge]
created: 2026-06-10
updated: 2026-08-19
qmd: "Xot phpstan pest bridge discipline public assertions tests stay pest helper"
issues:
  - "https://github.com/laraxot/module_xot_fila5/issues/28"
discussions:
  - "https://github.com/laraxot/module_xot_fila5/discussions/29"
related:
  - ./pest4-bootstrap-composer.md
  - ./pest-phpstan-plugin.md
  - ../../../../../../bmad-output/architecture.md
  - ../../../../../../docs/wiki/skills/phpstan-pest-remediation.md
---

# PHPStan Pest Bridge Discipline

Xot e' il posto giusto per pattern condivisi di test/static analysis, ma il bridge non deve cambiare il framework dei test.

## Contratto

- Pest resta il framework test.
- PHPStan resta governato dal solo `laravel/phpstan.neon` utente.
- Bridge/helper condivisi devono rendere tipizzabili le assertion ricorrenti, non mascherare errori.
- Bootstrap condiviso: [`XotBasePest.php`](../../../tests/XotBasePest.php) come **classe di metodi statici sotto la mappa PSR-4 `Modules\Xot\Tests\`** (AD-5c) — non `require_once`, e **non** `autoload.files`.
  - Rettifica 2026-08-19: questa riga citava un «ADR-014 — bootstrap via Composer autoload files». Quell'ADR non è mai esistito: `bmad-output/architecture.md` si ferma a ADR-013 e `Modules/Xot/composer.json` ha `autoload-dev` vuoto. La decisione effettiva è AD-5c nella [spine](../../../../../../_bmad-output/planning-artifacts/architecture/architecture-base_ptvx_fila5-2026-08-19/ARCHITECTURE-SPINE.md).
  - Perché non `autoload.files`: una voce che punta a un file rimosso uccide il boot di `artisan`, `phpstan` e `pest` insieme — è già successo in questo repo. Una classe PSR-4 mancante fallisce solo dove è usata.
- Pest 4: helper dominio in `tests/Helpers.php` (auto-caricato da BootFiles).
- **Vietato** `Modules/*/tests/Support/` e `PestFunctionBridge.php` (deprecati 2026-08-19 — vedi [`bmad-output/architecture.md`](../../../../../../bmad-output/architecture.md) ADR-002).
- Helper globali con prefisso `xot*` (`xotAssertFirstModel`, `xotAssertTableHas`, …); helper dominio solo nel `Pest.php` del modulo, con `function_exists()`.
- `uses(\Modules\<M>\Tests\TestCase::class)` sempre **dopo** gli `import use` nel file Pest.

## Le tre misure che spiegano il contratto

Non sono preferenze di stile. Prodotte il 2026-08-19 con
`./vendor/bin/phpstan analyse <file> --no-progress` da `laravel/`, sul solo `phpstan.neon`
(`level: max`, `bleedingEdge`, Larastan).

### 1. Ogni catena Pest su `@internal` — aggiornamento plugin v5 (2026-08-19)

Con **`pestphp/pest-plugin-phpstan` v5** e `phpstan.neon` senza `includes:` duplicati, probe su
`Modules/Rating/tests/`:

| forma | esito (post-plugin) |
| --- | --- |
| `uses(TestCase::class);` | OK |
| `pest()->extend(TestCase::class)->in('.');` | OK |
| `expect(1)->toBe(1);` | OK (Expectation tipizzata) |

**Prerequisito:** utente rimuove `includes:` duplicati da `phpstan.neon` (extension-installer).
Senza cleanup, PHPStan può uscire senza analizzare.

**Fallback LOCKED:** se il gate su `Pest.php` fallisce → `uses(TestCase::class)` nuda per file.

Misura storica (pre-plugin v5, handoff v1.3):

| forma | esito |
| --- | --- |
| `uses(TestCase::class)->in(__DIR__);` | `method.internalClass` — `UsesCall::in()` |
| `pest()->extend(...)->in(...)` | 2 × `method.internalClass` |

La causa non è l'API scelta ma la **concatenazione**: `uses()`, `pest()` ed `expect()` sono
funzioni pubbliche, ma gli oggetti che restituiscono sono annotati `@internal`. La doc ufficiale
mostra `pest()->extend()` perché è la doc di Pest 5 e non assume `level: max`: la doc non è
sbagliata, è il nostro perimetro a essere più stretto — e per AD-1 nessun `ignoreErrors` è
aggiungibile.

### 2. `$this` dentro una closure Pest non è il TestCase

```php
uses(Modules\Xot\Tests\XotBaseTestCase::class);

it('…', function (): void {
    $this->assertDatabaseHasRow('users', ['id' => 1]);
});
```

```
Call to an undefined method Pest\PendingCalls\TestCall::assertDatabaseHasRow().
```

Spostare gli helper condivisi su metodi della classe base e chiamarli via `$this` *sembra* la
soluzione elegante, e li rende invisibili all'analisi statica. I metodi di `XotBaseTestCase`
restano per il ciclo di vita del test — `setUp`, mock, transazioni — non per le assertion.

### 3. Debito attuale del modulo

`phpstan analyse Modules/Xot` con cache svuotata: **361 errori**, di cui 33
`method.internalClass` **tutti** su `Pest\Mixins\Expectation`. Zero `phpstan.parse`: il blocco
storico da `tests/Support/PestFunctionBridge.php`
([#57](https://github.com/laraxot/module_xot_fila5/issues/57)) non esiste più. Remediation:
story `4.2.xot-expect-to-assert-and-coverage`.

## Helper XotBaseTestCase (usare nei moduli)

| Metodo | Uso |
|--------|-----|
| `mockService($class, $closure)` | Mock in Pest senza chiamare `$this->mock()` protetto |
| `expectsOnce()` / `expectsExactly(n)` | Expectation PHPUnit tipizzate per Pest |
| `expectApplicationException($class)` | Wrapper `expectException` |
| `rrmdir($dir)` | Cleanup directory in test feature (Xot `TestCase`) |

## Pattern moduli (2026-08-19)

- **Bootstrap cross-modulo:** Composer `autoload.files` → XotBasePest (ADR-014), non `require_once`.
- **Dominio:** `tests/Helpers.php` (Pest 4 BootFiles).
- **Rating:** story 3.1 + 3.6 pilota.
- **Fixcity:** helper `ticket()`, `authUser()`, … — [phpstan-pest-testcase-helpers](../../../Fixcity/docs/wiki/concepts/phpstan-pest-testcase-helpers.md); `PestHelper.php` tipizzato
- **Notify:** `notificationManager()` + trait doubles — [phpstan-pest-test-doubles](../../../Notify/docs/wiki/concepts/phpstan-pest-test-doubles.md)
- **Xot:** test File — no `@var TestCase $this` se la closure non usa `$this`; no `assertIsString(tempnam())`
- **Xot Blade:** `RegisterBladeComponentsActionTest` — `Assert::assertSame` sul count collection; Mockery `allows(['execute' => …])` + `@var Action&MockInterface`; no `expect()->toBe*` se PHPStan emette `method.internalClass` (vedi [PHPSTAN-BEST-PRACTICES](../phpstan-best-practices.md) §7–8)
- **Tenant:** non ridefinire `mockService()`; non re-tipizzare `$model`/`$baseModel` se il parent ha `mixed`
- **UI:** `createStub` + `willReturn(null)` per action mock; no `andReturnNull()` Mockery

## Mockery nei test policy (story 5.18)

PHPStan non accetta `Mockery::mock(UserContract::class)` dove serve `UserContract` con `shouldReceive()`:

```php
/**
 * @return Mockery\MockInterface&UserContract
 */
function makeIrUser(): UserContract
{
    /** @var Mockery\MockInterface&UserContract $user */
    $user = Mockery::mock(UserContract::class);

    return $user;
}

/** @var BaseModel&Mockery\MockInterface $model */
$model = Mockery::mock(BaseModel::class)->makePartial();
```

Test non implementati: **`todo('motivo')`**, non `test(fn(){})->skip()` (emptyClosure) né
`test('…')->skip()` (PHPStan: 1 arg, void).

Hub piattaforma: [platform-completion-roadmap](../overviews/platform-completion-roadmap.md).

## Quando centralizzare in Xot

Centralizzare solo se il pattern e' usato da piu' moduli:

- helper per database assertion senza `$this` ambiguo;
- helper per factory `createOne()` e narrowing del modello (`bashscripts/tools/fix-test-factory-createone.php`);
- wrapper assertion per stringhe, array shape o class-string.

Non centralizzare fix one-shot di un singolo test Activity.
