<?php

declare(strict_types=1);

namespace Modules\Xot\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Factories\Factory;
=======
>>>>>>> laraxot/master
use Illuminate\Database\Eloquent\Relations\MorphPivot as EloquentMorphPivot;
use Illuminate\Support\Carbon;
use Modules\Xot\Models\Traits\HasXotFactory;
use Modules\Xot\Traits\Updater;

use function Safe\preg_match;

/**
 * Base MorphPivot class for all modules.
 *
 * Centralizes common MorphPivot configurations and behaviors.
 * The $connection is automatically set based on the child class namespace.
 *
<<<<<<< HEAD
 * @property string|int      $id
 * @property string          $morph_type
 * @property string|int      $morph_id
 * @property string|null     $related_type
 * @property string|int|null $related_id
 * @property Carbon|null     $created_at
 * @property Carbon|null     $updated_at
 * @property Carbon|null     $deleted_at
=======
 * @property string|int $id
 * @property string $morph_type
 * @property string|int $morph_id
 * @property string|null $related_type
 * @property string|int|null $related_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
>>>>>>> laraxot/master
 * @property string|int|null $created_by
 * @property string|int|null $updated_by
 * @property string|int|null $deleted_by
 */
abstract class XotBaseMorphPivot extends EloquentMorphPivot
{
<<<<<<< HEAD
    /** @use HasXotFactory<Factory<static>> */
    use HasXotFactory;

=======
    use HasXotFactory;
>>>>>>> laraxot/master
    use Updater;

    /** @var bool */
    public $incrementing = true;

    /** @var bool */
    public $timestamps = true;

    /**
     * Indicates whether attributes are snake cased on arrays.
     *
     * @see https://laravel-news.com/6-eloquent-secrets
     *
     * @var bool
     */
    public static $snakeAttributes = true;

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 30;

    /** @var list<string> */
    protected $appends = [];

    /** @var string */
    protected $primaryKey = 'id';

    /** @var string */
    protected $keyType = 'string';

    /** @var list<string> */
    protected $fillable = [
        'id',
        'post_id',
        'post_type',
        'related_type',
        'user_id',
        'note',
    ];

    /**
     * Get the database connection for the model.
     *
     * Automatically determines connection from child class namespace.
     * Example: Modules\Rating\Models\RatingMorph → 'rating'
     */
    public function getConnectionName(): ?string
    {
        if (isset($this->connection)) {
<<<<<<< HEAD
            return $this->normalizeConnectionName($this->connection);
=======
            /** @var string */
            return $this->connection;
>>>>>>> laraxot/master
        }

        // Extract module name from namespace: Modules\Rating\... → rating
        $namespace = static::class;
        $matches = [];
<<<<<<< HEAD
        if (1 === preg_match('/Modules\\\\(\w+)\\\\/', $namespace, $matches) && isset($matches[1])) {
            return strtolower($matches[1]);
        }

        return $this->normalizeConnectionName(parent::getConnectionName());
    }

    protected function normalizeConnectionName(string|\UnitEnum|null $connection): ?string
    {
        if ($connection instanceof \BackedEnum) {
            return (string) $connection->value;
        }

        if ($connection instanceof \UnitEnum) {
            return $connection->name;
        }

        return $connection;
=======
        if (preg_match('/Modules\\\\(\w+)\\\\/', $namespace, $matches) === 1 && isset($matches[1])) {
            return strtolower($matches[1]);
        }

        return parent::getConnectionName();
>>>>>>> laraxot/master
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'string', // must be string else primary key will be typed as int
            'uuid' => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
            'updated_by' => 'string',
            'created_by' => 'string',
            'deleted_by' => 'string',
        ];
    }
}
