<?php

declare(strict_types=1);

namespace Modules\Xot\Actions;

use Spatie\QueueableAction\QueueableAction;

/**
<<<<<<< .merge_file_vaoHDi
 * @deprecated 2026-08-19 Nessun chiamante in laravel/. Usare {@see \Modules\Xot\Actions\Arr\RangeIntersectAction}
 *             e {@see \Modules\Xot\Actions\Arr\DiffAssocRecursiveAction} via `app(...)->execute(...)`.
=======
 * @deprecated 2026-08-19 Nessun chiamante in laravel/. Usare {@see Arr\RangeIntersectAction}
 *             e {@see Arr\DiffAssocRecursiveAction} via `app(...)->execute(...)`.
>>>>>>> .merge_file_sXpUuo
 */
class ArrayAction
{
    use QueueableAction;

    /**
<<<<<<< .merge_file_vaoHDi
     * @deprecated Usare {@see \Modules\Xot\Actions\Arr\RangeIntersectAction::execute()}
=======
     * @deprecated Usare {@see Arr\RangeIntersectAction::execute()}
>>>>>>> .merge_file_sXpUuo
     *
     * @return array{0: int, 1: int}|false
     */
    public static function rangeIntersect(int $a, int $b, int $c, int $d): array|bool
    {
        $maxStart = max($a, $c);
        $minEnd = min($b, $d);

        if ($maxStart <= $minEnd) {
            return [$maxStart, $minEnd];
        }

        return false;
    }

    /**
<<<<<<< .merge_file_vaoHDi
     * @deprecated Usare {@see \Modules\Xot\Actions\Arr\DiffAssocRecursiveAction::execute()}
=======
     * @deprecated Usare {@see Arr\DiffAssocRecursiveAction::execute()}
>>>>>>> .merge_file_sXpUuo
     *
     * @param array<int|string, mixed> $array1
     * @param array<int|string, mixed> $array2
     *
     * @return array<int|string, mixed>
     */
    public static function diff_assoc_recursive(array $array1, array $array2): array
    {
        $outputDiff = [];
        foreach ($array1 as $key => $value) {
            if (array_key_exists($key, $array2)) {
                if (is_array($value)) {
                    if (! is_array($array2[$key])) {
                        $outputDiff[$key] = $value;
                    } else {
                        $recursiveDiff = self::diff_assoc_recursive($value, $array2[$key]);
                        if (count($recursiveDiff)) {
                            $outputDiff[$key] = $recursiveDiff;
                        }
                    }
                } else {
                    if ($value !== $array2[$key]) {
                        $outputDiff[$key] = $value;
                    }
                }
            } else {
                $outputDiff[$key] = $value;
            }
        }

        return $outputDiff;
    }

    public function execute(): void
    {
    }
}
