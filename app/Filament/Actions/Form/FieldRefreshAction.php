<?php

/**
 * @see https://coderflex.com/blog/create-advanced-filters-with-filament
 */

declare(strict_types=1);

namespace Modules\Xot\Filament\Actions\Form;

use Filament\Notifications\Notification;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;
use Modules\Xot\Filament\Actions\XotBaseAction;

class FieldRefreshAction extends XotBaseAction
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->translateLabel();
        $this->icon('heroicon-o-arrow-path')
            ->label('')
            ->tooltip('Ricalcola valore')
            ->action(function (mixed $record, Set $set): void {
                $name = $this->getName();
                if (! is_string($name) || $name === '') {
                    Notification::make()
                        ->title('Errore')
                        ->body('Nome campo non valido')
                        ->danger()
                        ->send();

                    return;
                }

                if (! is_object($record)) {
                    Notification::make()
                        ->title('Errore')
                        ->body('Record non valido')
                        ->danger()
                        ->send();

                    return;
                }

                $getter = 'get'.Str::studly($name);

                // is_callable e non method_exists: method_exists e' true anche per
                // metodi protected/private, ma la chiamata dall'esterno finirebbe in
                // Model::__call -> BadMethodCallException (500 invece di notifica).
                if (! is_callable([$record, $getter])) {
                    $exists = method_exists($record, $getter);
                    Notification::make()
                        ->title('Errore')
                        ->body(sprintf(
                            $exists
                                ? 'Il metodo %s esiste su [%s] ma non e\' public: FieldRefreshAction lo invoca dall\'esterno.'
                                : 'Metodo %s non disponibile sul record [%s]',
                            $getter,
                            get_class($record),
                        ))
                        ->danger()
                        ->send();

                    return;
                }

                $value = $record->{$getter}();
                $set($name, $value);

                Notification::make()
                    ->title('Valore ricalcolato')
                    ->body('Il valore del campo è stato ricalcolato con successo['.print_r($value, true).']')
                    ->success()
                    ->send();
            });
    }

    public static function getDefaultName(): ?string
    {
        return 'field_refresh';
    }
}
