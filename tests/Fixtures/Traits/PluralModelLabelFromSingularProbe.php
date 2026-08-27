<?php

declare(strict_types=1);

namespace Modules\Xot\Tests\Fixtures\Traits;

use Modules\Xot\Tests\Fixtures\Stubs\HasCustomModelLabelProbeBase;

class PluralModelLabelFromSingularProbe extends HasCustomModelLabelProbeBase
{
    public static function getModelLabel(): string
    {
        return 'Category';
    }
}
