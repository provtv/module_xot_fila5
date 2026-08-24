<?php

declare(strict_types=1);

use Modules\Xot\Helpers\XotSeedHelper;

if (! function_exists('xotSeedModelOnce')) {
    /**
<<<<<<< .merge_file_XIdEMc
     * @param  class-string  $modelClass
=======
     * @param class-string $modelClass
>>>>>>> .merge_file_Ui1oiT
     */
    function xotSeedModelOnce(string $modelClass): void
    {
        XotSeedHelper::seedModelOnce($modelClass);
    }
}
