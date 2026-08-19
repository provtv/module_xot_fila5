<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Arr;

use Spatie\QueueableAction\QueueableAction;

/**
 * ---.
 */
class DiffAssocRecursiveAction
{
    use QueueableAction;

    /**
     * @param  array<int|string, mixed>  $data
     * @return array<int|string, array<int|string, mixed>>
     */
    public static function fixType(array $data): array
    {
        return collect($data)->map(static function (mixed $item): array {
            if (! is_array($item)) {
                throw new \Exception('['.__LINE__.']['.self::class.']');
            }

            return self::normalizeArray($item);
        })->all();
    }

    /**
     * @param  array<int|string, mixed>  $data
     * @return array<int|string, mixed>
     */
    private static function normalizeArray(array $data): array
    {
        return collect($data)->map(static function (mixed $value) {
            if (is_array($value)) {
                return self::normalizeArray($value);
            }

            if (is_numeric($value)) {
                return $value * 1;
            }

            return $value;
        })->all();
    }

    /**
     * @param  array<int|string, mixed>  $arr_1
     * @param  array<int|string, mixed>  $arr_2
     * @return array<int|string, array<int|string, mixed>>
     */
    public function execute(array $arr_1, array $arr_2): array
    {
        $arr_1 = self::fixType($arr_1);
        $arr_2 = self::fixType($arr_2);

        $result = [];

        foreach ($arr_1 as $key => $value) {
            if (
                array_key_exists($key, $arr_2)
                && is_array($value)
                && is_array($arr_2[$key])
                && array_is_list($value)
            ) {
                /** @var array<int, mixed> $rightList */
                $rightList = $arr_2[$key];
                $filtered = array_values(array_filter(
                    $value,
                    static fn (mixed $item): bool => ! \in_array($item, $rightList, false)
                ));

                if ($filtered !== []) {
                    $result[$key] = $filtered;
                }

                continue;
            }

            if (! \in_array($value, $arr_2, false)) {
                $result[$key] = $value;
            }
        }

        return $result;
    }
}
