<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\ModelClass;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Illuminate\Database\Eloquent\Relations\Pivot;
<<<<<<< .merge_file_dCxYAE
use Illuminate\Support\Str;
use Modules\Xot\Actions\Cast\SafeStringCastAction;
use Modules\Xot\Actions\ModelClass\GuessPivotFullClassAction;
use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;

use function Safe\file;

=======
use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;

>>>>>>> .merge_file_3Kw23I
class GuessMorphPivotAction
{
    use QueueableAction;

    /**
     * Guess the pivot class for a many-to-many relationship.
     *
     * @param string|class-string<Model> $related The related model class name
<<<<<<< .merge_file_dCxYAE
     * @param string|class-string<Model> $class   The class 
=======
     * @param string|class-string<Model> $class   The class
>>>>>>> .merge_file_3Kw23I
     */
    public function execute(string $related, string $class): MorphPivot
    {
        $pivot_name = class_basename($related).'Morph';

        $pivot_class = app(GuessPivotFullClassAction::class)->execute($pivot_name, $related, $class);
        $pivot = app($pivot_class);
        Assert::isInstanceOf($pivot, MorphPivot::class);

        return $pivot;
    }
<<<<<<< .merge_file_dCxYAE

   
=======
>>>>>>> .merge_file_3Kw23I
}
