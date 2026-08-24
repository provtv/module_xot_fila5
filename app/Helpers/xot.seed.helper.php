<?php

declare(strict_types=1);

use Modules\Xot\Helpers\XotSeedHelper;

if (! function_exists('xotSeedModelOnce')) {
    /**
     * @param  class-string  $modelClass
     */
    function xotSeedModelOnce(string $modelClass): void
    {
        XotSeedHelper::seedModelOnce($modelClass);
    }
}
