---
title: PHPStan + Pest→Assert Migration Strategy
type: rule
tags: [phpstan, pest, assert, testing, quality-gate]
created_at: 2026-06-10
updated_at: 2026-06-10
---

# PHPStan + Pest→Assert Migration Strategy

## Regola critica
**SOLO l'utente modifica `phpstan.neon`** — fix code, not config.

## Problema: `method.internalClass` (23k errori)

PHPStan flags `expect()->toBe()` chains as calls on Pest internal classes.

**Fix**: Convertire `expect()` → `PHPUnit\Framework\Assert::assert*()`.

Script: `Modules/Activity/tools/convert-pest-to-assert.php`

**Runner per tutti i moduli:**
```bash
for mod in Cms Fixcity Gdpr Geo Job Notify Tenant UI User Xot; do
  php -r "\$root='Modules/$mod/tests'; ..."
done
```

## Pattern conversione (singola riga)

| Pest | PHPUnit Assert |
|------|---------------|
| `expect($x)->toBeTrue()` | `Assert::assertTrue($x)` |
| `expect($x)->toBeFalse()` | `Assert::assertFalse($x)` |
| `expect($x)->toBeNull()` | `Assert::assertNull($x)` |
| `expect($x)->not->toBeNull()` | `Assert::assertNotNull($x)` |
| `expect($x)->toBe($v)` | `Assert::assertSame($v, $x)` |
| `expect($x)->toEqual($v)` | `Assert::assertEquals($v, $x)` |
| `expect($x)->toBeInstanceOf(C::class)` | `Assert::assertInstanceOf(C::class, $x)` |
| `expect($x)->toHaveCount($n)` | `Assert::assertCount($n, $x)` |
| `expect($x)->toBeString()` | `Assert::assertIsString($x)` |
| `expect($x)->toBeFloat()` | `Assert::assertIsFloat($x)` |
| `expect($x)->toBeEmpty()` | `Assert::assertEmpty($x)` |
| `expect($x)->not->toBeEmpty()` | `Assert::assertNotEmpty($x)` |
| `expect($x)->toContain($s)` | `Assert::assertStringContainsString($s, $x)` |

## Catene multiriga — fix manuale

Se la conversione genera `Assert::assertSame(val)->toBeFloat(, $result)`:
```php
// BROKEN (da regex incompleta):
Assert::assertSame(123.45)->toBeFloat(, $result);

// CORRETTO:
Assert::assertSame(123.45, $result);
Assert::assertIsFloat($result);
```

## Conflict Webmozart vs PHPUnit Assert

Se un file usa `Webmozart\Assert\Assert` + PHPUnit Assert:
```php
use PHPUnit\Framework\Assert as PhpunitAssert;
use Webmozart\Assert\Assert; // runtime assertions

PhpunitAssert::assertTrue($result);
Assert::notNull($value); // webmozart runtime
```

## File non convertibili

- `.pest.php` — Pest DSL nativo, non convertibile
- `->with()` chains — dataset providers Pest, non convertibili
- Entrambi richiedono `phpstan.neon ignoreErrors: [identifier: method.internalClass]`

## Trait errors in test-stub context

Errori come `Method TestStub::foo() return type does not specify generics`:
- Il trait viene analizzato nel contesto dello stub → errori appaiono nel file del trait
- Fix: inline `// @phpstan-ignore missingType.generics` sulla firma del metodo nel trait

## Risultato Jun 2026
- Da 24,494 a **0 pure production errors**
- 503 file convertiti su 10 moduli
- 19 test-stub context errors residui (accettabili)

## `assertNotEmpty()` non è una guardia di tipo (27 agosto 2026)

`XotBasePest::assertArray()` era scritto così:

```php
public static function assertArray(mixed $value): array
{
    Assert::assertNotEmpty($value);

    /** @var array<string, mixed> $value */
    return $value;
}
```

Due difetti in quattro righe:

1. **Non prova che il valore sia un array.** `assertNotEmpty` passa su `'x'`, su `1`, su
   un oggetto. Il `@var` sotto scavalca l'inferenza di PHPStan e dichiara un tipo che
   nessuno ha verificato — esattamente ciò che la regola del progetto vieta.
2. **Rifiuta un risultato vuoto legittimo.** `AnalyzeTranslationFilesTest`
   (`flatten array handles empty array`) falliva con *«Failed asserting that an array is
   not empty»* su un `flattenArray([])` che tornava correttamente `[]`.

La forma corretta è quella già usata da `assertString()` nello stesso file: guardia
esplicita più `Assert::fail()`, che ha `never` come tipo di ritorno **nativo**, quindi
PHPStan restringe davvero.

```php
public static function assertArray(mixed $value): array
{
    if (! \is_array($value)) {
        Assert::fail('Expected array, got '.get_debug_type($value).'.');
    }

    /** @var array<string, mixed> $value */
    return $value;
}
```

Il `@var` resta, ma ora fa solo il passo da `array` ad `array<string, mixed>`: raffina
le chiavi, non inventa il tipo.

**Quando un helper condiviso fallisce, chiedersi se sbaglia il test o l'helper.** Un test
che verifica il caso vuoto e un helper che rifiuta il vuoto non possono avere ragione
entrambi. E **allentare** il contratto di un helper (da «non vuoto» a «è un array») non
rompe nessuno dei suoi 50 chiamanti; irrigidirlo li avrebbe rotti tutti.

Verifica dopo la modifica: `phpstan analyse Modules/Xot Modules/Notify` → `[OK] No errors`.
