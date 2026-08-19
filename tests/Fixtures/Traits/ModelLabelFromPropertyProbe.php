<?php

declare(strict_types=1);

namespace Modules\Xot\Tests\Fixtures\Traits;

class ModelLabelFromPropertyProbe extends HasCustomModelLabelProbeBase
{
    protected static ?string $modelLabel = 'Custom Label';
}
