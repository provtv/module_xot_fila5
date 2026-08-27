<?php

declare(strict_types=1);

namespace Modules\Xot\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Modules\Xot\Models\Traits\HasXotFactory;
use Modules\Xot\Models\Traits\RelationX;
use Modules\Xot\Traits\Updater;
use Webmozart\Assert\Assert;

/**
 * Class XotBaseModel.
 */
abstract class XotBaseModel extends EloquentModel
{
    /** @use HasXotFactory<Factory<static>> */
    use HasXotFactory;

    use RelationX;
    use Updater;

    /**
     * Indicates whether attributes are snake cased on arrays.
     *
     * @see https://laravel-news.com/6-eloquent-secrets
     *
     * @var bool
     */
    public static $snakeAttributes = true;

    /** @var int */
    protected $perPage = 30;

    /** @var string */
    protected $connection = 'xot';

    /** @var list<string> */
    protected $appends = [];

    /** @var list<string> */
    protected $hidden = [
        // 'password'
    ];

    /**
     * Resolve the concrete model class for the caller's module.
     *
     * @return class-string<EloquentModel>
     */
    public static function getClassName(): string
    {
        $object = Arr::first(debug_backtrace(), function (array $value) {
            return isset($value['object']) &&
            (Str::contains($value['object']::class, 'Models\\') || Str::contains($value['object']::class, 'Filament\\Resources\\'));
        });

        if (! isset($object['object'])) {
            // Fallback to static class when called outside model/resource context (e.g. ide-helper)
            if (class_exists(static::class) && is_subclass_of(static::class, EloquentModel::class)) {
                return static::class;
            }
            throw new \RuntimeException('Unable to resolve caller object for getClassName()');
        }

        $objectClass = $object['object']::class;
        if (method_exists($object['object'], 'getModelClass')) {
            $objectClass = $object['object']->getModelClass();
        }
        Assert::string($objectClass);
        /** @var string $objectClass */
        $namespace = Str::beforeLast((string) $objectClass, '\Models\\');
        $className = Str::afterLast(static::class, '\\');

        // Validate namespace was properly extracted (contains module path)
        if (! Str::contains($namespace, 'Modules\\')) {
            // Fallback to static class when namespace resolution fails
            if (class_exists(static::class) && is_subclass_of(static::class, EloquentModel::class)) {
                return static::class;
            }
        }

        $res = $namespace.'\\Models\\'.$className;

        // Defensive: check class exists before asserting
        if (! class_exists($res)) {
            // Fallback to static class
            if (class_exists(static::class) && is_subclass_of(static::class, EloquentModel::class)) {
                return static::class;
            }
            throw new \RuntimeException("Resolved class {$res} does not exist");
        }

        Assert::subclassOf($res, EloquentModel::class);

        return $res;
    }

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'id' => 'string',
            'uuid' => 'string',
            'published_at' => 'datetime',
            'verified_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
            'updated_by' => 'string',
            'created_by' => 'string',
            'deleted_by' => 'string',
        ];
    }
}
