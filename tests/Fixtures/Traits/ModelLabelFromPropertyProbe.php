<?php

declare(strict_types=1);

namespace Modules\Xot\Tests\Fixtures\Traits;

use Modules\Xot\Tests\Fixtures\Stubs\HasCustomModelLabelProbeBase;

class ModelLabelFromPropertyProbe extends HasCustomModelLabelProbeBase
{
    protected static ?string $modelLabel = 'Custom Label';
}
