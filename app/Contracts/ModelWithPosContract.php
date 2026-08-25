<?php

declare(strict_types=1);

namespace Modules\Xot\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\ModelStatus\Status;

/**
 * Modules\Xot\Contracts\ModelWithPosContract.
 *
 * @property int                     $id
 * @property int|null                $user_id
 * @property string|null             $post_type
 * @property Carbon|null             $created_at
 * @property Carbon|null             $updated_at
 * @property string|null             $created_by
 * @property string|null             $updated_by
 * @property string|null             $title
 * @property PivotContract|null      $pivot
 * @property string                  $tennant_name
 * @property UserContract|null       $user
 * @property string                  $status
 * @property Collection<int, Status> $statuses
 * @property int|null                $statuses_count
 * @property int|null                $pos
 *
 * @method void detach(Model $model)
 * @method void attach(Model $model)
 * @method string treeLabel()
 * @method \Illuminate\Support\Collection<int, Model> treeSons()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo<Model, Model> user()
 *
 * @phpstan-require-extends Model
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 */
interface ModelWithPosContract
{
}
