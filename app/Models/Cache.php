<?php

declare(strict_types=1);

namespace Modules\Xot\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Builder;
use Modules\Xot\Contracts\ProfileContract;
use Modules\Xot\Database\Factories\CacheFactory;
=======
use Modules\Xot\Database\Factories\CacheFactory;
use Illuminate\Database\Eloquent\Builder;
use Modules\Xot\Contracts\ProfileContract;
>>>>>>> laraxot/master

/**
 * Modules\Xot\Models\Cache.
 *
 * @property string $key
 * @property string $value
 * @property int    $expiration
<<<<<<< HEAD
 * @method static CacheFactory          factory($count = null, $state = [])
 * @method static Builder<static>|Cache newModelQuery()
 * @method static Builder<static>|Cache newQuery()
 * @method static Builder<static>|Cache query()
 * @method static Builder<static>|Cache whereExpiration($value)
 * @method static Builder<static>|Cache whereKey($value)
 * @method static Builder<static>|Cache whereValue($value)
 * @property ProfileContract|null $creator
 * @property ProfileContract|null $deleter
 * @property ProfileContract|null $updater
=======
 * @method static CacheFactory factory($count = null, $state = [])
 * @method static Builder|Cache newModelQuery()
 * @method static Builder|Cache newQuery()
 * @method static Builder|Cache query()
 * @method static Builder|Cache whereExpiration($value)
 * @method static Builder|Cache whereKey($value)
 * @method static Builder|Cache whereValue($value)
 * @property int $expiration
 * @method static CacheFactory factory($count = null, $state = [])
 * @method static Builder|Cache newModelQuery()
 * @method static Builder|Cache newQuery()
 * @method static Builder|Cache query()
 * @method static Builder|Cache whereExpiration($value)
 * @method static Builder|Cache whereKey($value)
 * @method static Builder|Cache whereValue($value)
 * @property ProfileContract|null $creator
 * @property ProfileContract|null $updater
 * @mixin IdeHelperCache
>>>>>>> laraxot/master
 * @mixin \Eloquent
 */
class Cache extends BaseModel
{
    protected $table = 'cache';

    protected $primaryKey = 'key';

    protected $keyType = 'string';

    /** @var list<string> */
    protected $fillable = [
        'key',
        'value',
        'expiration',
    ];
}
