# Xot Module - Filament v4 Upgrade Notes

This document outlines specific considerations and changes for the `Xot` module, particularly concerning its foundational `XotBaseSection` component, during the Filament v4 upgrade process. For a comprehensive overview of the Filament v4 upgrade, refer to the main project documentation: [`docs/filament_v4_upgrade.md`](../../../docs/filament_v4_upgrade.md).

## **Key Changes and Action Items for `Xot` Module**

### **1. `XotBaseSection` Component (`Modules\Xot\Filament\Schemas\Components\XotBaseSection.php`)**

*   **Architectural Rule:** In alignment with the Laraxot philosophy, all custom Filament Section components within the project **must extend `Modules\Xot\Filament\Schemas\Components\XotBaseSection`**. This class serves as the standardized base, ensuring architectural consistency and providing a central point for common Section functionalities. Direct extension of `Filament\Schemas\Components\Section` is to be avoided.

*   **`disableLiveUpdates()` Compatibility Shim:**
    *   **Issue:** During the Filament v4 upgrade, a `BadMethodCallException` was encountered in child components (e.g., `CompanySection`), indicating that the `disableLiveUpdates()` method was being called on `Section` instances, but this method is no longer natively available in Filament v4's `Section` component.
    *   **Resolution:** An empty `public function disableLiveUpdates(): static` method has been added to `XotBaseSection`. This method acts as a compatibility shim, "catching" any calls to `disableLiveUpdates()` and preventing `BadMethodCallException`s at runtime. This allows existing code (or Filament's internal lifecycle) that might still attempt to call this method to function without error, without requiring a full re-implementation of its v3 behavior if it's no longer necessary in v4.

### **2. Filament v4 Section Component Behavior (`columnSpanFull`)**

*   **Issue:** In Filament v3, `Section` components automatically spanned the full width of their parent grid. In Filament v4, `Section` components now only consume one column by default.
*   **Action Required for `XotBaseSection` Implementations:** While `XotBaseSection` itself doesn't directly configure its `columnSpan`, all components extending it (e.g., `CompanySection`, `AddressSection`, `ContactSection`) need to explicitly apply `->columnSpanFull()` where full-width layout is desired.
    *   Alternatively, to revert to the v3 default globally for all `Section` components, a `configureUsing()` call can be placed in a service provider (e.g., `AppServiceProvider`):
    ```php
    use Filament\Schemas\Components\Section;

    Section::configureUsing(fn (Section $section) => $section->columnSpanFull());
    ```

### **3. Widget Initialization (`initXotBaseWidget`)**

*   **Issue**: I widget che estendono `XotBaseWidget` (usando `InteractsWithForms`) fallivano nel catturare i dati di input se lo stato del form non veniva inizializzato esplicitamente.
*   **Architettura**: A causa delle firme (signatures) variabili del metodo `mount()` tra i vari widget (parametri diversi), non è possibile definire `mount()` nella classe base.
*   **Soluzione**: È stato introdotto il metodo `initXotBaseWidget()` in `XotBaseWidget`. Ogni widget figlio DEVE chiamare `$this->initXotBaseWidget()` nel proprio metodo `mount()`.
*   **Esempio**:
    ```php
    public function mount(): void
    {
        $this->initXotBaseWidget();
    }
    ```

### **4. Metodi deprecati in Filament v4 — mappa delle sostituzioni**

PHPStan a `level: max` segnala questi con identifier `method.deprecated`,
`staticMethod.deprecated`, `method.deprecatedClass`, `staticMethod.deprecatedClass` e
`classConstant.deprecatedClass`. Tabella verificata il 2026-08-19 sul modulo `User`
(19 segnalazioni chiuse) leggendo i messaggi di deprecazione di Filament, non a memoria.

| Deprecato | Sostituto | Classe |
|-----------|-----------|--------|
| `modalSubheading()` | `modalDescription()` | `Filament\Actions\Action` |
| `modalButton()` | `modalSubmitActionLabel()` | `Filament\Actions\Action` |
| `form([...])` | `schema([...])` | `Filament\Actions\Action` |
| `bulkActions()` | `toolbarActions()` | `Filament\Tables\Table` |
| `actions()` | `recordActions()` | `Filament\Tables\Table` |
| `getTableColumns()`, `getTableFilters()`, `getTableActions()`, `getTableBulkActions()`, `getTableHeaderActions()`, `getTableEmptyStateActions()`, `getTableHeading()`, `getDefaultTableSortColumn()`, `getDefaultTableSortDirection()` | override di `table()` | `Filament\Resources\Pages\ListRecords`, `Filament\Widgets\TableWidget` |
| `Filament\Forms\Components\Placeholder` (intera classe) | `Filament\Infolists\Components\TextEntry` con `state()` | — |

#### `Placeholder` → `TextEntry`: due dettagli che non sono un rename

1. **`content()` diventa `state()`**, ma `TextEntry` **scappa l'HTML per default** mentre
   `Placeholder` lo rendeva. Se la closure può restituire `HtmlString` — il caso tipico è
   `return new HtmlString('&mdash;')` come fallback di un campo vuoto — serve `->html()`,
   altrimenti in pagina compare la entity letterale:

   ```php
   TextEntry::make('created_at')->html()->state(static function ($record) {
       // …
       return new HtmlString('&mdash;');
   })
   ```

   Se il contenuto è testo semplice (una traduzione senza markup), `->html()` non serve.

2. **`TextEntry` vive in `Filament\Infolists\Components`**, non in `Filament\Forms\Components`:
   l'import va cambiato, e in Filament v4 il componente è utilizzabile dentro uno `Schema`
   di form senza wrapper.

#### La convenzione Laraxot `getTableColumns()` è un caso a parte

I metodi `getTableXxx()` deprecati dal framework sono anche i nomi della convenzione
Laraxot: una sottoclasse che li dichiara **sovrascrive un metodo deprecato del parent**, e
ogni chiamata da `HasXotTable` diventa un `method.deprecated`. La via d'uscita è rinominare
la convenzione (non il pattern) con un nome che non collida — ma va fatta con un default
nel trait, mai con un `abstract`: `abstract` su un trait montato da 98 classi concrete rende
il tree non caricabile finché l'ultima non è migrata. Incidente del 2026-08-19 documentato
in [`docs/chat/xot-getxottablecolumns-abstract-blocca-bootstrap-2026-08-19.md`](../../../../docs/chat/xot-getxottablecolumns-abstract-blocca-bootstrap-2026-08-19.md).

---
**DRY (Don't Repeat Yourself) / KISS (Keep It Simple, Stupid) Principles:**

*   **Centralized `XotBaseSection`:** This class is a prime example of DRY, consolidating architectural decisions and compatibility layers in one place for all custom sections.
*   **Compatibility Shim (KISS):** The `disableLiveUpdates()` shim is a simple, effective solution to a complex version compatibility problem, embodying the KISS principle by resolving the error with minimal code and impact.
*   **Explicit Configuration:** Encouraging explicit use of `columnSpanFull()` promotes clarity and reduces reliance on implicit framework behaviors, leading to more robust and predictable UI layouts.

By maintaining and documenting `XotBaseSection`, the `Xot` module reinforces core architectural patterns and facilitates a smoother transition to Filament v4.
