<?php

declare(strict_types=1);

namespace Modules\Xot\Filament\Resources;

use Filament\Forms\Components\TextInput;
use Modules\Xot\Filament\Resources\CacheLockResource\Pages\CreateCacheLock;
use Modules\Xot\Filament\Resources\CacheLockResource\Pages\EditCacheLock;
use Modules\Xot\Filament\Resources\CacheLockResource\Pages\ListCacheLocks;
use Modules\Xot\Models\CacheLock;

class CacheLockResource extends XotBaseResource
{
    protected static ?string $model = CacheLock::class;

    /**
     * Get the form schema for the resource.
     *
     * @return array<string, mixed>
     */
    // #[\Override]
    public static function getFormSchemaOld(): array
    {
        return [
            'key' => TextInput::make('key')->required()->maxLength(255),
            'owner' => TextInput::make('owner')->required()->maxLength(255),
            'expiration' => TextInput::make('expiration')->required()->numeric(),
        ];
    }

    #[\Override]
    public static function getRelations(): array
    {
        return [];
    }

    #[\Override]
    public static function getPages(): array
    {
        return [
            'index' => ListCacheLocks::route('/'),
            'create' => CreateCacheLock::route('/create'),
            'edit' => EditCacheLock::route('/{record}/edit'),
        ];
    }
}
