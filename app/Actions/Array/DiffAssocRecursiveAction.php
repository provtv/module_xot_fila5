<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Array;

use Spatie\QueueableAction\QueueableAction;

/**
 * ---.
 */
class DiffAssocRecursiveAction
{
    use QueueableAction;

    /**
<<<<<<< HEAD
    * @param array<int|string, mixed> $data
=======
     * @param array<int|string, mixed> $data
>>>>>>> laraxot/dev
     *
     * @return array<int|string, array<int|string, mixed>>
     */
    public static function fixType(array $data): array
    {
        $collection = collect($data)->map(static function ($item) {
            if (! is_array($item)) {
                throw new \Exception('['.__LINE__.']['.self::class.']');
            }

            return collect($item)->map(static function ($item0) {
                if (is_numeric($item0)) {
                    $item0 *= 1;
                }

                return $item0;
            })->all();
        });

        return $collection->all();
    }

    /**
<<<<<<< HEAD
    * @param array<int|string, mixed> $arr_1
=======
     * @param array<int|string, mixed> $arr_1
>>>>>>> laraxot/dev
     * @param array<int|string, mixed> $arr_2
     *
     * @return array<int|string, array<int|string, mixed>>
     */
    public function execute(array $arr_1, array $arr_2): array
    {
        $coll_1 = collect(self::fixType($arr_1));
        $arr_2 = self::fixType($arr_2);

        $ris = $coll_1->filter(static function ($value, $key) use ($arr_2) {
            try {
                return ! \in_array($value, $arr_2, false);
            } catch (\Exception $exception) {
<<<<<<< HEAD
               throw $exception;
=======
                throw $exception;
>>>>>>> laraxot/dev
            }
        });

        return $ris->all();
    }
}
