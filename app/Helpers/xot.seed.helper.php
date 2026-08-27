<?php

declare(strict_types=1);

use Illuminate\Database\Eloquent\Model;
use Modules\Xot\Actions\Factory\GetFactoryAction;

if (! function_exists('xotSeedModelOnce')) {
    /**
     * @param  class-string<Model>  $modelClass
     */
    function xotSeedModelOnce(string $modelClass): void
    {
        (new GetFactoryAction())
            ->execute($modelClass)
            ->createOne();
    }
}
