---
title: "Convenzioni per Form Schema in Filament"
slug: filament-form-schema-conventions
module: Xot
type: convention
status: enforced
language: it-IT
updated: 2026-08-05
tags: [filament, form, schema, xotbase, resource, migration]
related:
  - filament-resource-rules.md
  - ../../../../bashscripts/ai/wiki/concepts/filament-resource-schema-tables-pattern.md
---

# Convenzioni per Form Schema in Filament

## Dove vive lo schema

La sorgente di verità è la classe Form dedicata della Resource:

```
Modules/<M>/app/Filament/Resources/<Name>Resource/Schemas/<Model>Form.php
```

che estende `Modules\Xot\Filament\Resources\Schemas\XotBaseResourceForm` e
implementa `getFormSchema()`.

`XotBaseResource::form()` è `final` e risolve quella classe via
`getFormClass()`. `XotBaseResource::getFormSchema()` è a sua volta `final`:
una Resource che prova a dichiararlo produce un fatal
`Cannot override final method`. Lo schema legacy di una Resource si parcheggia
in `getFormSchemaOld()` mantenendo il docblock con generics completi.

## Regola Fondamentale

`getFormSchema()` deve **SEMPRE** restituire un array associativo con chiavi
stringhe, mai un array numerico.

## Implementazione Corretta

```php
// ✅ CORRETTO — nella classe Schemas\<Model>Form
public static function getFormSchema(): array
{
    return [
        'title' => Forms\Components\TextInput::make('title')
            ->required(),
        'content' => Forms\Components\RichEditor::make('content')
            ->columnSpan(2),
        'status' => Forms\Components\Select::make('status')
            ->options(StatusEnum::options()),
    ];
}
```

## Implementazione Errata

```php
// ❌ ERRATO
public static function getFormSchema(): array
{
    return [
        Forms\Components\TextInput::make('title')
            ->required(),
        Forms\Components\RichEditor::make('content')
            ->columnSpan(2),
        Forms\Components\Select::make('status')
            ->options(StatusEnum::options()),
    ];
}
```

## Componenti Deprecati da Evitare

La classe `Forms\Components\Card` è deprecata e **NON** deve essere utilizzata. Utilizzare invece:

```php
// ✅ CORRETTO
'info_section' => Forms\Components\Section::make('Informazioni')
    ->schema([
        'name' => Forms\Components\TextInput::make('name'),
        'email' => Forms\Components\TextInput::make('email'),
    ]),
```

## Origine dei Campi

I campi del form devono essere ricavati da:

1. **Modello Eloquent**: Utilizzare le proprietà e le relazioni del modello
2. **Migration**: Basarsi sui campi definiti nelle migrazioni
3. **Vincoli di Business**: Riflettere i requisiti specifici dell'applicazione

Non inventare o aggiungere arbitrariamente campi che non esistono nel modello o nelle migration.

## Proprietà di Navigazione

Nelle classi che estendono `XotBaseResource`, **NON** definire:

- `protected static ?string $navigationIcon`
- `protected static ?string $navigationGroup`
- `protected static ?int $navigationSort`
- `public static function getNavigationLabel()`
- `public static function getPluralModelLabel()`
- `public static function getModelLabel()`

`XotBaseResource` gestisce automaticamente questi aspetti.

## Esempi Completi

### Prima (Non Corretto)

```php
class MyResource extends XotBaseResource
{
    protected static ?string $navigationIcon = 'heroicon-o-document';

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRecords::route('/'),
            'create' => Pages\CreateRecord::route('/create'),
            'edit' => Pages\EditRecord::route('/{record}/edit'),
        ];
    }

    public static function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('title'),
            Forms\Components\RichEditor::make('content'),
        ];
    }
}
```

### Dopo (Corretto)

```php
class MyResource extends XotBaseResource
{
    /**
     * @return array<string, \Filament\Schemas\Components\Component>
     */
    public static function getFormSchemaOld(): array
    {
        return [
            'title' => Forms\Components\TextInput::make('title'),
            'content' => Forms\Components\RichEditor::make('content'),
        ];
    }
}
```

> **Contratto 2026-08:** ogni Resource **deve** avere `{Model}Form`, `{Plural}Table`, `{Model}Infolist`. Se manca la classe → `LogicException` (no soft-skip). `getFormSchemaOld()` / `getInfolistSchema()` sulla Resource sono solo **bridge di contenuto** in migrazione: lo schema si sposta nella classe dedicata, poi si rimuove Old. Su `XotBaseRelationManager` override = `getFormSchemaOld()`. Su `XotBaseResourceForm` = `getFormSchema()` (può delegare a Old). Array sempre a chiavi stringa. Canon wiki: [xotbaseresource-formschema-old-pattern.md](../../../../docs/wiki/filament/xotbaseresource-formschema-old-pattern.md).

## Vantaggi dell'Approccio Corretto

1. **Consistenza**: Mantiene coerenza in tutto il progetto
2. **Mantenibilità**: Facilita la gestione e la modifica dei form
3. **Chiarezza**: Rende esplicita l'associazione tra campi e componenti
4. **Estensibilità**: Permette l'override parziale del form schema nelle classi derivate

## Documentazione Correlata

- [XotBaseResource](./XOT_BASE_RESOURCE.md)
- [Form Components](./FORM_COMPONENTS.md)
- [Form Validation](./FORM_VALIDATION.md)
- [Filament Best Practices](../../docs/rules/filament_best_practices.md)
