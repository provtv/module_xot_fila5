<?php

declare(strict_types=1);

namespace Modules\Xot\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Modules\Xot\Contracts\ProfileContract;
use Modules\Xot\Database\Factories\ExtraFactory;
use Spatie\SchemalessAttributes\SchemalessAttributes;
=======
use Spatie\SchemalessAttributes\SchemalessAttributes;
use Illuminate\Database\Eloquent\Builder;
use Modules\Xot\Database\Factories\ExtraFactory;
use Illuminate\Support\Carbon;
use Modules\Xot\Contracts\ProfileContract;
>>>>>>> laraxot/master

/**
 * Model Extra.
 *
<<<<<<< HEAD
 * @property string                    $id
 * @property string                    $model_type
 * @property string                    $model_id
 * @property SchemalessAttributes|null $extra_attributes
 * @property Carbon|null               $created_at
 * @property Carbon|null               $updated_at
 * @property string|null               $updated_by
 * @property string|null               $created_by
 * @property Carbon|null               $deleted_at
 * @property string|null               $deleted_by
 * @method static ExtraFactory          factory($count = null, $state = [])
 * @method static Builder<static>|Extra newModelQuery()
 * @method static Builder<static>|Extra newQuery()
 * @method static Builder<static>|Extra query()
 * @method static Builder<static>|Extra whereCreatedAt($value)
 * @method static Builder<static>|Extra whereCreatedBy($value)
 * @method static Builder<static>|Extra whereDeletedAt($value)
 * @method static Builder<static>|Extra whereDeletedBy($value)
 * @method static Builder<static>|Extra whereExtraAttributes($value)
 * @method static Builder<static>|Extra whereId($value)
 * @method static Builder<static>|Extra whereModelId($value)
 * @method static Builder<static>|Extra whereModelType($value)
 * @method static Builder<static>|Extra whereUpdatedAt($value)
 * @method static Builder<static>|Extra whereUpdatedBy($value)
 * @method static Builder<static>|Extra withExtraAttributes()
 * @property ProfileContract|null $creator
 * @property ProfileContract|null $deleter
 * @property ProfileContract|null $updater
 * @mixin \Eloquent
 */
final class Extra extends BaseExtra
=======
 * @property int                                               $id
 * @property int|null                                          $model_id
 * @property string|null                                       $model_type
 * @property SchemalessAttributes $extra_attributes
 * @method static Builder|BaseModel disableCache()
 * @method static ExtraFactory factory($count = null, $state = [])
 * @method static \Illuminate\Contracts\Database\Eloquent\Builder|Extra newModelQuery()
 * @method static Builder|Extra newQuery()
 * @method static Builder|Extra query()
 * @method static Builder|BaseModel withCacheCooldownSeconds(?int $seconds = null)
 * @method static Builder|Extra withExtraAttributes()
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null                     $updated_by
 * @property string|null                     $created_by
 * @property Carbon|null $deleted_at
 * @property string|null                     $deleted_by
 * @method static Builder|Extra whereCreatedAt($value)
 * @method static Builder|Extra whereCreatedBy($value)
 * @method static Builder|Extra whereDeletedAt($value)
 * @method static Builder|Extra whereDeletedBy($value)
 * @method static Builder|Extra whereExtraAttributes($value)
 * @method static Builder|Extra whereId($value)
 * @method static Builder|Extra whereModelId($value)
 * @method static Builder|Extra whereModelType($value)
 * @method static Builder|Extra whereUpdatedAt($value)
 * @method static Builder|Extra whereUpdatedBy($value)
 * @property ProfileContract|null $creator
 * @property ProfileContract|null $updater
 * @mixin IdeHelperExtra
 * @mixin \Eloquent
 */
class Extra extends BaseExtra
>>>>>>> laraxot/master
{
}
