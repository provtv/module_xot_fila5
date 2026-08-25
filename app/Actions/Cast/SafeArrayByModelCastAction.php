<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Cast;

use Illuminate\Database\Eloquent\Model;
use Spatie\QueueableAction\QueueableAction;

class SafeArrayByModelCastAction
{
    use QueueableAction;

    /**
     * @return array<string, mixed>
     */
    public function execute(Model $model): array
    {
        try {
            /** @var array<string, mixed> $res */
            $res = $model->attributesToArray();

            return $res;
<<<<<<< HEAD
       } catch (\ValueError|\Error $e) {
=======
        } catch (\ValueError|\Error $e) {
>>>>>>> laraxot/dev
            return $this->safeExecute($model);
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function safeExecute(Model $model): array
    {
        $data = [];
        foreach ($model->getAttributes() as $key => $value) {
            try {
<<<<<<< HEAD
               $data[$key] = $model->getAttribute($key);
=======
                $data[$key] = $model->getAttribute($key);
>>>>>>> laraxot/dev
            } catch (\ValueError|\Error) {
            }
        }

        return $data;
    }
}
