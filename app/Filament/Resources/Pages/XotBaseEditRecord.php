<?php

declare(strict_types=1);

namespace Modules\Xot\Filament\Resources\Pages;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord as FilamentEditRecord;
use Filament\Support\Components\Component;
use Illuminate\Database\Eloquent\Model;
use Modules\Xot\Filament\Support\RecordAnchor;
use Modules\Xot\Filament\Traits\TransTrait;

abstract class XotBaseEditRecord extends FilamentEditRecord
{
    use TransTrait;

    /**
     * Il breadcrumb verso l'elenco punta alla riga del record aperto.
     *
     * Senza frammento si torna in cima alla lista e la riga appena modificata va
     * ricercata a mano. La pagina di elenco ricorda gia' filtri, ordinamento e numero
     * di pagina, quindi qui basta l'ancora: la riga e' gia' nella pagina servita.
     *
     * @return array<string>
     */
    #[\Override]
    public function getResourceBreadcrumbs(): array
    {
        $breadcrumbs = parent::getResourceBreadcrumbs();

        $indexUrl = $this->getResourceUrl();
        if (! array_key_exists($indexUrl, $breadcrumbs)) {
            return $breadcrumbs;
        }

        $key = $this->getRecord()->getKey();
        if (! is_int($key) && ! is_string($key)) {
            return $breadcrumbs;
        }

        $anchored = [];
        foreach ($breadcrumbs as $url => $label) {
            $anchored[$url === $indexUrl ? RecordAnchor::appendTo($url, $key) : $url] = $label;
        }

        return $anchored;
    }

    public static function getNavigationLabel(): string
    {
        return static::transFunc(__FUNCTION__);
    }

    public static function getNavigationIcon(): string
    {
        return static::transFunc(__FUNCTION__);
    }

    public static function canDelete(Model $record): bool
    {
        $resource = static::getResource();

        $result = $resource::canDelete($record);

        return is_bool($result) ? $result : false;
    }

    public static function canForceDelete(Model $record): bool
    {
        $resource = static::getResource();

        $result = $resource::canForceDelete($record);

        return is_bool($result) ? $result : false;
    }

    public static function canRestore(Model $record): bool
    {
        $resource = static::getResource();

        $result = $resource::canRestore($record);

        return is_bool($result) ? $result : false;
    }

    /**
     * Get the form schema.
     *
     * @return array<int, Component>
     */
    protected function getFormSchemaOld(): array
    {
        return [];
    }

    /**
     * Get the header actions.
     *
     * @return array<string, Action|ActionGroup>
     */
    protected function getHeaderActions(): array
    {
        return [
            'delete' => DeleteAction::make()
                ->icon('heroicon-o-trash')
                ->visible(fn (Model $record) => static::canDelete($record)),
            /*
            'forceDelete' => Actions\ForceDeleteAction::make()
                ->icon('heroicon-o-trash')
                ->visible(fn(Model $record) => static::canForceDelete($record)),
            'restore' => Actions\RestoreAction::make()
                ->icon('heroicon-o-trash')
                ->visible(fn(Model $record) => static::canRestore($record)),
            // ...
            */
        ];
    }
}
