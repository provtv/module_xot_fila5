<?php

declare(strict_types=1);

namespace Modules\Xot\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Modules\Xot\Contracts\ExtraContract;
use Modules\Xot\Database\Factories\ExtraFactory;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;
use Spatie\SchemalessAttributes\SchemalessAttributesTrait;

/**
 * Model Extra.
 *
 * @property int                                               $id
 * @property int|null                                          $model_id
 * @property string|null                                       $model_type
 * @property \Spatie\SchemalessAttributes\SchemalessAttributes $extra_attributes
 *
 * @method static Builder<static>|static disableCache()
 * @method static ExtraFactory      factory($count = null, $state = [])
 * @method static Builder<static>|static newModelQuery()
 * @method static Builder<static>|static newQuery()
 * @method static Builder<static>|static query()
 * @method static Builder<static>|static withCacheCooldownSeconds(?int $seconds = null)
 * @method static Builder<static>|static withExtraAttributes()
 *
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property Carbon|null $deleted_at
 * @property string|null $deleted_by
 *
 * @method static Builder<static>|static whereCreatedAt($value)
 * @method static Builder<static>|static whereCreatedBy($value)
 * @method static Builder<static>|static whereDeletedAt($value)
 * @method static Builder<static>|static whereDeletedBy($value)
 * @method static Builder<static>|static whereExtraAttributes($value)
 * @method static Builder<static>|static whereId($value)
 * @method static Builder<static>|static whereModelId($value)
 * @method static Builder<static>|static whereModelType($value)
 * @method static Builder<static>|static whereUpdatedAt($value)
 * @method static Builder<static>|static whereUpdatedBy($value)
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 */
abstract class BaseExtra extends BaseModel implements ExtraContract
{
    use SchemalessAttributesTrait;

    /** @var string */
    protected $connection = 'xot';

    protected $fillable = [
        'id',
        'model_id',
        'model_type',
        'extra_attributes',
    ];

    // ✅ CORRETTO: NON implementare scopeWithExtraAttributes() manualmente
    // Il trait SchemalessAttributesTrait lo fornisce automaticamente!

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    #[\Override]
    protected function casts(): array
    {
        return [
            'extra_attributes' => SchemalessAttributes::class,
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
            'updated_by' => 'string',
            'created_by' => 'string',
            'deleted_by' => 'string',
        ];
    }
}
