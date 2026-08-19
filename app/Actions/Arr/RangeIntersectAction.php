<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Arr;

use Spatie\QueueableAction\QueueableAction;

/**
 * ---.
 */
class RangeIntersectAction
{
    use QueueableAction;

    /**
     * @return array{0: int, 1: int}|false
     */
    public function execute(int $a0, int $b0, int $a1, int $b1): array|bool
    {
        $maxStart = max($a0, $a1);
        $minEnd = min($b0, $b1);

        if ($maxStart <= $minEnd) {
            return [$maxStart, $minEnd];
        }

        return false;
    }
}
