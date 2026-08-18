# XotBaseResource

## Panoramica

XotBaseResource è la classe base astratta per tutte le risorse Filament nel sistema. Estende `Filament\Resources\Resource` e implementa funzionalità comuni per la gestione delle risorse.

## Caratteristiche Principali

### Contratto reale (non questo snippet)

SSoT verificata sul PHP: [filament/xotbaseresource.md](./filament/xotbaseresource.md).

- `form()` è `final` e carica `{Resource}\Schemas\{Model}Form` (non `getFormSchema()` inline).
- `getFormSchema()` **non** è abstract né final: delega a `getFormSchemaOld()` (default `[]`).
- Se manca `{Model}Form` → `LogicException`. Nessun fallback Action cablato.

## Best Practices

1. **Non Sovrascrivere Metodi Final**
   - Non tentare di sovrascrivere `form()`
   - Schema in `{Model}Form` (ponte: `getFormSchemaOld()`). Widget: `getFormSchema()`
   - Rispettare la struttura definita nella classe base

2. **Gestione delle Table Actions**
   - Se `getTableActions()` restituisce solo ViewAction, EditAction e DeleteAction, rimuoverlo
   - Se presente, deve includere `...parent::getTableActions()`
   - Se `getTableBulkActions()` restituisce solo DeleteBulkAction, rimuoverlo

3. **Label e Traduzioni**
   - Non utilizzare mai `->label('')` direttamente
   - Gestire le label tramite file di traduzione
   - Utilizzare il trait `NavigationLabelTrait`

## Esempio di Implementazione Corretta

```php
namespace Modules\Notify\Filament\Resources;

use Modules\Xot\Filament\Resources\XotBaseResource;
use Filament\Forms;

class NotificationResource extends XotBaseResource
{
    protected static ?string $model = 'Modules\Notify\Models\Notification';

    // Preferire Schemas\{Model}Form; getFormSchema() qui è solo ponte verso Old
    public static function getFormSchemaOld(): array
    {
        return [
            Forms\Components\TextInput::make('title')
                // Non usare ->label() direttamente
                // Le label sono gestite via file di traduzione
        ];
    }

    // Non sovrascrivere form() perché è final
    // Non definire getTableActions() se restituisce solo azioni standard
}
```

## Collegamenti Bidirezionali

### Collegamenti nella Root
- [Architettura Filament](../../../docs/architecture/filament.md)
- [Gestione Risorse](../../../docs/architecture/resources.md)
- [Regole XotBaseResource](../../../docs/regole/xotbaseresource-rules.md)

### Collegamenti ai Moduli
- [Notify Resource](../../Notify/docs/filament-resources.md)
- [User Resource](../../User/docs/filament-resources.md)

## Note Importanti

1. Non sovrascrivere mai metodi marcati come `final`
2. Implementare sempre i metodi astratti richiesti
3. Utilizzare i file di traduzione per le label
4. Evitare override non necessari di metodi
5. Seguire le convenzioni di Filament

## Form/Table class e fallback sul model

`form()` è `final`; `table()` nel codice **non** lo è. Lo schema vive in `{Resource}\Schemas\{Model}Form` e `{Resource}\Tables\{Plural}Table`.

`getFormClass()` / `getTableClass()` / `getInfolistClass()` cercano le classi nested su `static::class`. Se mancano, `GetResourceClassNameByModelClassAction` risolve la Resource del model nel pannello (Performance/IR su model Ptv). `LogicException` solo se manca anche quella. Dettaglio e lezione: [get-resource-class-name-by-model-class-action.md](./get-resource-class-name-by-model-class-action.md).

`getFormSchemaOld()` resta solo come ponte di migrazione sulle Resource, **non** sui Widget (`XotBaseWidget::getFormSchema()`).
