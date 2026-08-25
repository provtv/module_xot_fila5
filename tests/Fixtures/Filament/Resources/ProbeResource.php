<?php

declare(strict_types=1);

namespace Modules\Xot\Tests\Fixtures\Filament\Resources;

use Filament\Schemas\Components\Wizard\Step;
use Modules\Xot\Filament\Resources\XotBaseResource;

class ProbeResource extends XotBaseResource
{
    protected static string $module = 'Xot';

    protected static ?string $model = null;

<<<<<<< HEAD
   public static function getFormSchemaOld(): array
=======
    public static function getFormSchemaOld(): array
>>>>>>> laraxot/dev
    {
        return [];
    }

<<<<<<< HEAD
   /**
=======
    /**
>>>>>>> laraxot/dev
     * @return array<int, string>
     */
    public static function getCustomStepSchema(): array
    {
        return ['ok'];
    }

    public static function callGetKeyTrans(string $key): string
    {
        return static::getKeyTrans($key);
    }

    public static function callGetStepByName(string $name): Step
    {
        return static::getStepByName($name);
    }

    public static function resetModelCache(): void
    {
        static::$model = null;
    }
}
