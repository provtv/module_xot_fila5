# PHPStan Patterns - Dicembre 2025

## 🎯 Nuovi Pattern Scoperti

### 1. PHPDoc Tag Anti-Pattern
**Problema**: PHPDoc tag che tentano di sovrascrivere tipi nativi

```php
// ❌ ANTI-PATTERN
/** @var view-string $view */
return view($view);

// ✅ PATTERN CORRETTO
return view((string) $view);
```

**Spiegazione**: I PHPDoc tag non dovrebbero essere usati per forzare tipi quando PHP può inferirli o quando un cast esplicito è più appropriato.

### 2. Type Safety con Assert prima di costruttori
**Pattern**: Validare tipi prima di passare a costruttori strict

```php
// ✅ PATTERN
$out = View::make($view, $data);
$html = $out->render();
Assert::string($html);
return new HtmlString($html);
```

**Spiegazione**: Usare Assert di Webmozart per garantire type safety prima di creare oggetti con tipi strict.

### 3. Import Verification Pattern
**Problema**: Import di classi che non esistono o uso errato di facade

```php
// ❌ ERRORE
use Illuminate\Support\Facades\View as ViewFactory;

// ✅ CORRETTO
use Illuminate\Support\Facades\View;
```

**Spiegazione**: Verificare sempre che le classi importate esistano e usare il nome corretto delle facade.

#### 3-bis. Gli alias di root non sono classi — misurato il 2026-08-24

L'anti-pattern più costoso di questa famiglia non è la facade sbagliata: è la facade
importata **dalla root del namespace**, cioè l'alias di `config/app.php` usato come se fosse
una classe.

```php
// ❌ ANTI-PATTERN — funziona a runtime, per PHPStan la classe non esiste
use Route;
use Request;
use Validator;
use Log;
use Str;

// ✅ CORRETTO
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;   // ← NON una facade: la classe vera sta in Support
```

**Perché costa più di quanto sembra.** Un solo import sbagliato produce da due a quattro
errori, perché quello vero è il primo e gli altri sono la sua ombra:

```
class.notFound     Call to static method current() on an unknown class Route.
method.nonObject   Cannot call method parameters() on mixed.
argument.type      Parameter #1 $array of function extract expects array, mixed given.
return.type        Method …::getContextName() should return string but returns mixed.
```

Nessuno dei tre a valle si corregge dove è scritto: si correggono **tutti** risalendo
all'import. È il caso da manuale della regola «`mixed` è l'ultima spiaggia — risali alla
sorgente, non castare».

**Come si trova l'intera famiglia in un modulo:**

```bash
grep -rn "^use [A-Z][A-Za-z]*;" Modules/<Modulo>/app
```

Un `use` con un solo segmento e nessuna barra è sempre sospetto: le uniche forme legittime
sono le classi globali di PHP (`Exception`, `Throwable`, `DateTime`, `ArrayAccess`, …).

**Misura del 2026-08-24**: su tutta la corsa `analyse Modules` (5 709 errori) gli errori
attribuiti a file di `app/` analizzati per sé erano **19**, e **tutti e 19** venivano da
questa famiglia: 7 file, 5 nomi. Corretti gli import, `[OK] No errors`, senza toccare una
riga di logica. Story `bmad-output/stories/2.11.phpstan-facade-import-root-namespace.story.md`.

## 🔧 Pattern Consolidati

### 1. SafeStringCastAction per Cast Sicuri
```php
$title = SafeStringCastAction::cast($attachment->title);
$description = SafeStringCastAction::cast($attachment->description);
```

### 2. hasAttribute() invece di property_exists()
```php
// ❌ SU MODELLI ELOQUENT
if (property_exists($model, 'attribute')) { }

// ✅ CORRETTO
if ($model->hasAttribute('attribute')) { }
```

### 3. Type Narrowing Esplicito
```php
$causerId = null;
if ($this->user !== null) {
    if (! $this->user instanceof User) {
        throw new \InvalidArgumentException('User must be an instance of User');
    }
    $id = $this->user->getAttribute('id');
    $causerId = is_int($id) || is_string($id) ? $id : null;
}
```

## 📚 Regole d'Oro

1. **Nessun compromesso sulla type safety**
2. **PHPDocs solo quando necessari**
3. **Assert per validazioni critiche**
4. **Cast espliciti quando PHPStan non inferisce**
5. **Sempre usare classi XotBase per Filament**

## 🚀 Da Evitare

- `property_exists()` su modelli Eloquent
- PHPDoc tag ridondanti
- Mixed types non gestiti
- Estensione diretta di classi Filament
- `->label()` su componenti Filament

## ✅ Best Practices

- Safe cast actions
- Type narrowing
- hasAttribute() per modelli
- XotBase extension
- File di traduzione per label

## 🎉 Risultati

Applicando questi pattern, abbiamo raggiunto:
- **0 errori PHPStan** in tutti i moduli
- **Type safety al livello massimo**
- **Codice manutenibile e robusto**
