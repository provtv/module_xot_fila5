<?php

declare(strict_types=1);

namespace Modules\Xot\Tests\Fixtures\Traits;

use Modules\Xot\Tests\Fixtures\Stubs\HasCustomModelLabelProbeBase;

class ModelLabelFromModelNameProbe extends HasCustomModelLabelProbeBase
{
    public static function getModel(): string
    {
        return 'App\Models\UserInvitation';
    }
}
