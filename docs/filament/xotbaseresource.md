# XotBaseResource — pattern Filament

## Perché esiste

L'admin Filament (schede indennità, performance, progressioni) apre Resource. `XotBaseResource` è il contratto unico: niente estensione diretta di `Filament\Resources\Resource`. Chi lo usa: sviluppatori e agenti che toccano il pannello senza rompere ricerca per matr/cognome né i form di firma.

## Contratto verificato sul codice (non sulla wiki)

Fonte: `app/Filament/Resources/XotBaseResource.php`.

| Metodo | Nel codice oggi | Cosa fare |
|---|---|---|
| `form()` | **`final`** — carica `{Resource}\Schemas\{Model}Form` | Non overrideare |
| `table()` | **non** final — carica `{Resource}\Tables\{Plural}Table` | Preferire la Table nested, non reimplementare a caso |
| `getFormSchema()` | **non** final, **non** abstract: delega a `getFormSchemaOld()` | Ponte: 74 Resource lo sovrascrivono ancora. `final` qui = pagina bianca all'autoload |
| `getFormSchemaOld()` | **non** abstract, default `[]` | Ponte di migrazione verso `{Model}Form::getFormSchema()`. Non esiste sui Widget |
| `getFormClass()` / `getTableClass()` / `getInfolistClass()` | nested su `static::class`, poi Resource canonica del model (`GetResourceClassNameByModelClassAction`) | Nessun form/table vuoto. `LogicException` solo se mancano **entrambe** |

Wiki root che dice «`getFormSchema` final + `getFormSchemaOld` abstract» è **fiction**. SSoT = questo file + il PHP.

Widget e RelationManager: `getFormSchema()` (istanza). `#[Override]` su `getFormSchemaOld()` lì è fatal PHP 8.3 e ferma PHPStan su tutto `Modules`.

## Panoramica

`XotBaseResource` estende `Filament\Resources\Resource` e centralizza form, tabelle, pagine, relazioni e navigazione (DRY).

## Metodi finali (non sovrascrivere)

- `form()` — risolve la Form class nested, non lo schema inline
- `table()` nel codice **non** è `final`; il percorso canonico resta `{Plural}Table`

## Cosa implementare nella Resource figlia

| Metodo | Obbligatorio | Note |
| :--- | :---: | :--- |
| `{Model}Form` nested / `getFormSchemaOld()` | ponte | Schema campi; chiavi stringa. Preferire `Schemas\{Model}Form` |
| `getPages()` | no | Solo se servono view, pagine custom o naming Page non standard |
| `getRelations()` | no | Solo se ci sono RelationManager; non dichiarare `return []` |
| `getTableColumns()` | no | Colonne in `ListRecords::getListTableColumns()` |

## `getPages()` — quando non dichiararlo

Se la Resource espone solo list/create/edit e le classi Page rispettano la convenzione della base, **non** implementare `getPages()`.

Dettaglio, tabella naming ed esempi: [getpages-redundancy-rule.md](./getpages-redundancy-rule.md).

```php
// ✅ Resource minimale
class CoeffResource extends XotBaseResource
{
    protected static ?string $model = Coeff::class;

  /**
   * @return array<string, \Filament\Schemas\Components\Component>
   */
    public static function getFormSchema(): array
    {
        return [ /* ... */ ];
    }
}
```

Page attese (namespace `{Resource}\Pages\`):

- `List{Str::plural($name)}` — es. `ListCoeffs` per `CoeffResource`
- `Create{$name}` — es. `CreateCoeff`
- `Edit{$name}` — es. `EditCoeff`
- `View{$name}` — opzionale; la base la registra solo se la classe esiste

## Namespace e tipizzazione

- Namespace: `Modules\{ModuleName}\Filament\Resources`
- `declare(strict_types=1);` obbligatorio
- Non dichiarare `$navigationIcon`, `$navigationGroup`, `$navigationSort`, `$translationPrefix` (gestiti altrove)
- Mai `->label()` sui componenti Filament

## Esempio completo minimale

```php
<?php

declare(strict_types=1);

namespace Modules\Example\Filament\Resources;

use Modules\Example\Models\Example;
use Modules\Xot\Filament\Resources\XotBaseResource;

class ExampleResource extends XotBaseResource
{
    protected static ?string $model = Example::class;

    /**
     * @return array<string, \Filament\Schemas\Components\Component>
     */
    public static function getFormSchema(): array
    {
        return [
            // campi con chiavi stringa
        ];
    }
}
```

## Collegamenti

- [getpages-redundancy-rule.md](./getpages-redundancy-rule.md)
- [resources/architecture/forbidden-methods.md](./resources/architecture/forbidden-methods.md)
- [filament-class-extension-rules.md](../filament-class-extension-rules.md)
- [../filament-resource-rules.md](../filament-resource-rules.md)

*Ultimo aggiornamento: giugno 2025*
