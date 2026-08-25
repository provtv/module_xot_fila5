<?php

declare(strict_types=1);

namespace Modules\Xot\Filament\Resources\Schemas;

use Closure;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Modules\Xot\Actions\Cast\SafeStringCastAction;

class XotBaseResourceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components(static::getFormSchema())
            ->columns(static::getFormSchemaColumns());
    }

    public static function getFormSchemaColumns(): int
    {
        return 1;
    }

    /**
     * Schema del form. In migrazione può delegare a {@see static::getFormSchemaOld()}.
     *
     * @return array<string, Component>
     */
    public static function getFormSchema(): array
    {
        return static::getFormSchemaOld();
    }

    /**
     * Bridge di migrazione — rimuovere quando lo schema vive solo in getFormSchema().
     *
     * @return array<string, Component>
     */
    public static function getFormSchemaOld(): array
    {
        return [
        ];
    }

    /**
     * Select su relazione con etichette sempre valorizzate e ordinate.
     *
     * `Select::relationship()` legge le opzioni con `pluck()`: se la colonna
     * titolo e' nullable il valore `null` arriva a
     * `Select::isOptionDisabled(string|Htmlable $label)` e la pagina va in
     * TypeError. Il callback per record evita il problema, ma disattiva
     * l'ordinamento automatico che Filament applica solo sul ramo `pluck()`,
     * quindi l'ordinamento va richiesto esplicitamente.
     *
     * @param  string  $name  nome del campo (es. `customer_id`)
     * @param  string  $relationship  nome della relazione sul model (es. `customer`)
     * @param  string  $titleAttribute  colonna usata come etichetta
     */
    protected static function relationshipSelect(string $name, string $relationship, string $titleAttribute = 'name'): Select
    {
        return Select::make($name)
            ->relationship(
                $relationship,
                $titleAttribute,
                static fn (Builder $query): Builder => $query->orderBy($query->qualifyColumn($titleAttribute)),
            )
            ->getOptionLabelFromRecordUsing(static::optionLabelFromRecord($titleAttribute));
    }

    /**
     * Etichetta non vuota per un record usato come opzione di Select.
     *
     * Il fallback sulla chiave primaria tiene l'opzione selezionabile anche
     * quando la colonna titolo e' nulla, invece di far fallire l'intera pagina.
     *
     * @return Closure(Model): string
     */
    protected static function optionLabelFromRecord(string $titleAttribute = 'name'): Closure
    {
        return static function (Model $record) use ($titleAttribute): string {
            $label = SafeStringCastAction::cast(
                data_get($record, str_replace('->', '.', $titleAttribute)),
            );

            return $label !== ''
                ? $label
                : '#'.SafeStringCastAction::cast($record->getKey());
        };
    }

    /**
     * Elenco degli step Wizard per form multi‑passaggio (nome ufficiale allineato a Filament **`HasWizard::getSteps()`**).
     * I form lineari lo lasciano vuoto.
     *
     * @return array<string, Step>
     */
    public static function getSteps(): array
    {
        return [];
    }

    protected static function getStepByName(string $name): Step
    {
        $methodName = Str::of($name)
            ->snake()
            ->studly()
            ->prepend('get')
            ->append('Schema')
            ->toString();

        if (method_exists(static::class, $methodName)) {
            $schemaResult = static::$methodName();
            /** @var array<Htmlable|string> $schemaComponents */
            $schemaComponents = \is_array($schemaResult) ? array_values($schemaResult) : [];

            return Step::make($name)->schema($schemaComponents);
        }
        dddx($methodName);

        return Step::make($name)->schema([]);
    }
}
