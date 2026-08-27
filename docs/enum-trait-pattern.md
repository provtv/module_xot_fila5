# EnumTrait Pattern - Standard Architetturale per Enums

## Scopo
<<<<<<< HEAD

`Modules\Xot\Traits\EnumTrait` e' il trait standard Laraxot per gli enum PHP backed proprietari. Centralizza metadati UI, traduzioni, helper di form, liste e colonne derivate dagli enum, evitando che ogni modulo riscriva manualmente la stessa logica.

## Regola Architetturale

> Tutti gli enum PHP backed proprietari in `laravel/Modules` devono importare e usare `Modules\Xot\Traits\EnumTrait`.

La regola vale per gli enum Filament (`HasLabel`, `HasColor`, `HasIcon`, `HasDescription`) e anche per enum di dominio non ancora esposti in Filament: il trait e' il contratto comune e rende l'enum pronto alla normalizzazione.

Sono esclusi codice `vendor`, package terzi vendorizzati e fixture di test non applicative.

## Perche

- **Logica**: `getLabel()`, `getColor()`, `getIcon()` e `getDescription()` hanno una sola implementazione corretta. Gli enum dichiarano casi; il trait risolve la rappresentazione.
- **Politica**: Xot governa il protocollo cross-module. I moduli possiedono valori e traduzioni, ma non ridefiniscono il contratto.
- **Religione del progetto**: DRY, type safety, traduzioni e Filament devono convergere, non moltiplicarsi in `match` locali.
- **Bellezza**: un enum leggibile mostra il dominio. I dettagli visuali stanno nei lang file, dove possono essere governati e tradotti.
- **Zen**: stesso gesto ovunque: import, `use EnumTrait;`, traduzioni sotto `values`. Meno eccezioni, meno rumore.

## Struttura Enum

```php
<?php

=======
`EnumTrait` è il trait standard di Laraxot per tutti gli enum PHP backed che necessitano di integrazione con Filament UI. Centralizza etichette, colori, icone e descrizioni tramite file di traduzione, eliminando la necessità di implementazioni manuali nelle singole classi enum.

## Regola Architetturale

> **REGOLA**: Tutti gli enum che implementano `HasColor`, `HasLabel`, `HasIcon` o `HasDescription` **DEVONO** usare `EnumTrait` anziché implementare manualmente i metodi `getLabel()`, `getColor()`, `getIcon()`, `getDescription()`.

## Come Funziona

### 1. Classe Enum (Minimalista)
```php
<?php
>>>>>>> laraxot/master
declare(strict_types=1);

namespace Modules\NomeModulo\Enums;

use Filament\Support\Contracts\HasColor;
<<<<<<< HEAD
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Modules\Xot\Traits\EnumTrait;

enum MioEnum: string implements HasColor, HasIcon, HasLabel
{
    use EnumTrait;

    case CASO_UNO = 'caso_uno';
    case CASO_DUE = 'caso_due';
}
```

## Traduzioni Canoniche

`EnumTrait` usa `TransTrait::transClass()` e legge questa struttura:

```text
{module}::{enum_snake}.values.{enum_value}.label
{module}::{enum_snake}.values.{enum_value}.color
{module}::{enum_snake}.values.{enum_value}.icon
{module}::{enum_snake}.values.{enum_value}.description
```

Esempio `Modules/NomeModulo/lang/it/mio_enum.php`:

```php
<?php

declare(strict_types=1);

return [
    'values' => [
        'caso_uno' => [
            'label' => 'Caso uno',
            'color' => 'primary',
            'icon' => 'heroicon-o-star',
            'description' => 'Descrizione del caso uno',
        ],
        'caso_due' => [
            'label' => 'Caso due',
            'color' => 'success',
            'icon' => 'heroicon-o-check-circle',
            'description' => 'Descrizione del caso due',
        ],
=======
use Filament\Support\Contracts\HasLabel;
use Modules\Xot\Traits\EnumTrait;

enum MioEnum: string implements HasColor, HasLabel
{
    use EnumTrait;

    case CASO_UNO = 'valore_uno';
    case CASO_DUE = 'valore_due';
}
```

### 2. File di Traduzione
Creare `Modules/NomeModulo/lang/{locale}/mio_enum.php`:
```php
<?php
declare(strict_types=1);

return [
    'valore_uno' => [
        'label' => 'Etichetta Caso Uno',
        'color' => 'primary',
        'icon' => 'heroicon-o-star',         // opzionale
        'description' => 'Descrizione...',    // opzionale
    ],
    'valore_due' => [
        'label' => 'Etichetta Caso Due',
        'color' => 'success',
>>>>>>> laraxot/master
    ],
];
```

<<<<<<< HEAD
## Metodi ereditati

| Metodo | Fonte canonica |
|---|---|
| `getLabel(): string` | `values.{value}.label` |
| `getColor(): string` | `values.{value}.color` |
| `getIcon(): string` | `values.{value}.icon` |
| `getDescription(): string` | `values.{value}.description` |
| `getSearchable(): array` | `static::cases()` |
| `getFormSchema(): array` | campi `TextInput` generati dai casi |
| `columns(Blueprint, ?XotBaseMigration)` | definizioni colonna dell'enum |
| `toArray(): array` | mappa value => label |

## Anti-pattern

```php
// Sbagliato: protocollo UI duplicato nel singolo enum.
public function getLabel(): string
{
    return match ($this) {
        self::CASO_UNO => 'Caso uno',
    };
}
```

```php
// Sbagliato: TransTrait diretto al posto di EnumTrait.
use Modules\Xot\Filament\Traits\TransTrait;

use TransTrait;
```

## Migrazione legacy

1. Aggiungere `use Modules\Xot\Traits\EnumTrait;`.
2. Inserire `use EnumTrait;` nel body dell'enum.
3. Sostituire `TransTrait` diretto con `EnumTrait` quando presente.
4. Portare le traduzioni legacy da `{value}.label` o `options.{value}` a `values.{value}.label`.
5. Rimuovere `getLabel()`, `getColor()`, `getIcon()`, `getDescription()` manuali solo quando tutte le chiavi `values` sono presenti.
6. Mantenere metodi di dominio non standard (`label()`, `color()`, `options()`, `getDefault()`) se sono parte del contratto applicativo esistente.

## Riferimenti

- Regola root: `docs/wiki/rules/enum-trait-required.md`
- Regola storica: `docs/wiki/rules/enum-trait-standard.md`
=======
## Convenzione di Naming
- La chiave del file di traduzione è lo `snake_case` del nome della classe enum.
- Le chiavi interne corrispondono ai `value` dei casi enum.
- Ogni caso **deve** avere almeno `label` e `color`.

## Enums Conformi nel Progetto

| Modulo | Enum | File Traduzione |
|--------|------|-----------------|
| Xot | `DayOfWeek` | `xot/lang/it/day_of_week.php` |
| Xot | `GenderEnum` | `xot/lang/it/gender_enum.php` |
| Xot | `PdfEngineEnum` | `xot/lang/it/pdf_engine_enum.php` |
| Xot | `YesNoEnum` | `xot/lang/it/yes_no_enum.php` |
| Meetup | `EventStatus` | `meetup/lang/it/event_status.php` |
| Meetup | `EventAttendanceMode` | `meetup/lang/it/event_attendance_mode.php` |
| Meetup | `RepeatFrequency` | `meetup/lang/it/repeat_frequency.php` |

## Metodi Ereditati da EnumTrait

| Metodo | Interfaccia | Fonte |
|--------|-------------|-------|
| `getLabel(): string` | `HasLabel` | `{value}.label` nel file di traduzione |
| `getColor(): string` | `HasColor` | `{value}.color` nel file di traduzione |
| `getIcon(): string` | `HasIcon` | `{value}.icon` nel file di traduzione |
| `getDescription(): string` | `HasDescription` | `{value}.description` nel file di traduzione |
| `getFormSchema(): array` | - | Genera campi TextInput per ogni caso |
| `columns(Blueprint, ?Migration)` | - | Aggiunge colonne al database |

## Anti-Pattern (❌ NON FARE)
```php
// ❌ SBAGLIATO: Implementazione manuale
enum MioEnum: string implements HasLabel
{
    case A = 'a';

    public function getLabel(): string
    {
        return match ($this) {
            self::A => 'Etichetta A',
        };
    }
}
```

---
*Documentazione conforme agli standard Laraxot - DRY + KISS + SOLID*
>>>>>>> laraxot/master
