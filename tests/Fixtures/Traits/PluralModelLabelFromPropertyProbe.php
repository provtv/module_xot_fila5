<?php

declare(strict_types=1);

namespace Modules\Xot\Tests\Fixtures\Traits;

use Modules\Xot\Tests\Fixtures\Stubs\HasCustomModelLabelProbeBase;

class PluralModelLabelFromPropertyProbe extends HasCustomModelLabelProbeBase
{
    protected static ?string $pluralModelLabel = 'Plural Labels';

    public static function getModelLabel(): string
    {
        return 'Label';
    }
}
