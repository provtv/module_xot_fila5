<?php

declare(strict_types=1);

namespace Modules\Xot\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Builder;
use Modules\Xot\Contracts\ProfileContract;
use Modules\Xot\Database\Factories\PulseEntryFactory;

/**
 * @property string               $id
 * @property int                  $timestamp
 * @property string               $type
 * @property string               $key
 * @property string|null          $key_hash
 * @property int|null             $value
 * @property ProfileContract|null $creator
 * @property ProfileContract|null $updater
 * @method static PulseEntryFactory          factory($count = null, $state = [])
 * @method static Builder<static>|PulseEntry newModelQuery()
 * @method static Builder<static>|PulseEntry newQuery()
 * @method static Builder<static>|PulseEntry query()
 * @method static Builder<static>|PulseEntry whereId($value)
 * @method static Builder<static>|PulseEntry whereKey($value)
 * @method static Builder<static>|PulseEntry whereKeyHash($value)
 * @method static Builder<static>|PulseEntry whereTimestamp($value)
 * @method static Builder<static>|PulseEntry whereType($value)
 * @method static Builder<static>|PulseEntry whereValue($value)
 * @property ProfileContract|null $deleter
<<<<<<< .merge_file_c5f0sZ
=======
use Modules\Xot\Contracts\ProfileContract;
use Modules\Xot\Database\Factories\PulseEntryFactory;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property ProfileContract|null $creator
 * @property ProfileContract|null $updater
 * @method static PulseEntryFactory factory($count = null, $state = [])
 * @method static Builder|PulseEntry newModelQuery()
 * @method static Builder|PulseEntry newQuery()
 * @method static Builder|PulseEntry query()
 * @property int         $id
 * @property int         $timestamp
 * @property string $type
 * @property string $key
 * @property string|null $key_hash
 * @property int|null    $value
 * @method static Builder|PulseEntry whereId($value)
 * @method static Builder|PulseEntry whereKey($value)
 * @method static Builder|PulseEntry whereKeyHash($value)
 * @method static Builder|PulseEntry whereTimestamp($value)
 * @method static Builder|PulseEntry whereType($value)
 * @method static Builder|PulseEntry whereValue($value)
 * @mixin IdeHelperPulseEntry
>>>>>>> laraxot/master
=======
>>>>>>> .merge_file_Rx5tuo
 * @mixin \Eloquent
 */
class PulseEntry extends BaseModel
{
    /** @var list<string> */
    protected $fillable = [
        'type',
        'key',
        'value',
    ];
}
