<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\ModelClass;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
<<<<<<< .merge_file_Gw7eX6
use Illuminate\Support\Str;
use Modules\Xot\Actions\Cast\SafeStringCastAction;
use Modules\Xot\Actions\ModelClass\GuessPivotFullClassAction;
use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;

use function Safe\file;

=======
use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;

>>>>>>> .merge_file_zQ5JGd
class GuessPivotAction
{
    use QueueableAction;

    /**
     * Guess the pivot class for a many-to-many relationship.
     *
     * @param string|class-string<Model> $related The related model class name
<<<<<<< .merge_file_Gw7eX6
     * @param string|class-string<Model> $class   The class 
=======
     * @param string|class-string<Model> $class   The class
>>>>>>> .merge_file_zQ5JGd
     */
    public function execute(string $related, string $class): Pivot
    {
        $model_names = [
            class_basename($class),
            class_basename($related),
        ];
        sort($model_names);
        $pivot_name = implode('', $model_names);

        $pivot_class = app(GuessPivotFullClassAction::class)->execute($pivot_name, $related, $class);

        $pivot = app($pivot_class);
        Assert::isInstanceOf($pivot, Pivot::class);

        return $pivot;
    }
<<<<<<< .merge_file_Gw7eX6

   
=======
>>>>>>> .merge_file_zQ5JGd
}
