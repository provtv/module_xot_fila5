<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Filament;

use Filament\Resources\Resource;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;

/**
 * Plain text for Filament grid labels — Htmlable, enum HasLabel, scalar.
 */
class GetResourceClassNameByModelClassAction
{
    use QueueableAction;

    /**
     * @param class-string<Model> $model_class
     *
     * @return class-string<Resource>
     */
    public function execute(string $model_class): string
    {
        
        $resouce_class = Str::of($model_class)
        ->replace('Models\\', 'Filament\\Resources\\')
        ->append('Resource')
        ->toString();
        Assert::classExists($resouce_class, __FILE__.':'.__LINE__.' - '.$resouce_class.'['.$model_class.']');
        Assert::isAOf($resouce_class, Resource::class, __FILE__.':'.__LINE__.' - '.$resouce_class.'['.$model_class.']');

        return $resouce_class;
    }
}