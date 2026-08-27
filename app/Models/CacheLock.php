<?php

declare(strict_types=1);

namespace Modules\Xot\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Builder;
use Modules\Xot\Contracts\ProfileContract;
use Modules\Xot\Database\Factories\CacheLockFactory;
=======
use Modules\Xot\Database\Factories\CacheLockFactory;
use Illuminate\Database\Eloquent\Builder;
use Modules\Xot\Contracts\ProfileContract;
>>>>>>> laraxot/master

/**
 * Modules\Xot\Models\CacheLock.
 *
 * @property string $key
 * @property string $owner
 * @property int    $expiration
<<<<<<< HEAD
 * @method static CacheLockFactory          factory($count = null, $state = [])
 * @method static Builder<static>|CacheLock newModelQuery()
 * @method static Builder<static>|CacheLock newQuery()
 * @method static Builder<static>|CacheLock query()
 * @method static Builder<static>|CacheLock whereExpiration($value)
 * @method static Builder<static>|CacheLock whereKey($value)
 * @method static Builder<static>|CacheLock whereOwner($value)
 * @property ProfileContract|null $creator
 * @property ProfileContract|null $deleter
 * @property ProfileContract|null $updater
=======
 * @method static CacheLockFactory factory($count = null, $state = [])
 * @method static Builder|CacheLock newModelQuery()
 * @method static Builder|CacheLock newQuery()
 * @method static Builder|CacheLock query()
 * @method static Builder|CacheLock whereExpiration($value)
 * @method static Builder|CacheLock whereKey($value)
 * @method static Builder|CacheLock whereOwner($value)
 * @property int $expiration
 * @method static CacheLockFactory factory($count = null, $state = [])
 * @method static Builder|CacheLock newModelQuery()
 * @method static Builder|CacheLock newQuery()
 * @method static Builder|CacheLock query()
 * @method static Builder|CacheLock whereExpiration($value)
 * @method static Builder|CacheLock whereKey($value)
 * @method static Builder|CacheLock whereOwner($value)
 * @property ProfileContract|null $creator
 * @property ProfileContract|null $updater
 * @mixin IdeHelperCacheLock
>>>>>>> laraxot/master
 * @mixin \Eloquent
 */
class CacheLock extends BaseModel
{
    /** @var list<string> */
    protected $fillable = [
        'key',
        'owner',
        'expiration',
    ];
}
