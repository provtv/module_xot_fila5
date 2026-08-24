<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Trend;

use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use InvalidArgumentException;
use Modules\Xot\Datas\TrendData;
use Spatie\QueueableAction\QueueableAction;
use UnexpectedValueException;

class BuildTrendCollectionAction
{
    use QueueableAction;

    /**
     * @template TModel of Model
     *
     * @param  Builder<TModel>  $query
     * @return Collection<int, TrendData>
     */
    public function execute(
        Builder $query,
        Carbon $start,
        Carbon $end,
        string $interval = 'day',
        string $dateColumn = 'created_at',
        string $dateAlias = 'date',
        string $aggregateColumn = '*',
        string $aggregate = 'count',
    ): Collection {
        $trend = Trend::query($query)
            ->between($start, $end)
            ->interval($interval)
            ->dateColumn($dateColumn)
            ->dateAlias($dateAlias);

        $values = match ($aggregate) {
            'avg' => $trend->average($aggregateColumn),
            'min' => $trend->min($aggregateColumn),
            'max' => $trend->max($aggregateColumn),
            'sum' => $trend->sum($aggregateColumn),
            'count' => $trend->count($aggregateColumn),
            default => throw new InvalidArgumentException('Unsupported trend aggregate.'),
        };

        return $values
            ->map(static function (mixed $value): TrendData {
                if (! $value instanceof TrendValue) {
                    throw new UnexpectedValueException('Trend returned an invalid value.');
                }

                $aggregate = $value->aggregate;
                if ($aggregate !== null && ! is_int($aggregate) && ! is_float($aggregate) && ! is_string($aggregate)) {
                    throw new UnexpectedValueException('Trend returned an invalid aggregate.');
                }

                return TrendData::from([
                    'date' => $value->date,
                    'aggregate' => $aggregate,
                ]);
            })
            ->values();
    }
}
