<?php

declare(strict_types=1);

namespace Modules\Xot\Tests\Fixtures\Stubs;

use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Modules\Xot\Models\Cache as CacheModel;

final class XotCovRelationHost extends CacheModel
{
    public $timestamps = false;

    public function guessPivot(string $related, ?string $class = null): Pivot
    {
        return new XotCovPivot;
    }

    public function guessMorphPivot(string $related, ?string $_class = null): MorphPivot
    {
        return new XotCovMorphPivot;
    }
}
