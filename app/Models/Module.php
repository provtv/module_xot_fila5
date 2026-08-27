<?php

declare(strict_types=1);

namespace Modules\Xot\Models;

use Illuminate\Database\Eloquent\Builder;
<<<<<<< HEAD
use Illuminate\Support\Arr;
use Modules\Xot\Contracts\ProfileContract;
use Modules\Xot\Database\Factories\ModuleFactory;
use Nwidart\Modules\Facades\Module as ModuleFacade;
use Nwidart\Modules\Module as NModule;

use function Safe\json_encode;

use Sushi\Sushi;

/**
 * @property int                             $id
 * @property string|null                     $name
 * @property string|null                     $slug
 * @property string|null                     $version
 * @property string|null                     $description
 * @property bool|null                       $status
 * @property bool|null                       $enabled
 * @property bool|null                       $is_active
 * @property int|null                        $priority
 * @property string|null                     $path
 * @property string|null                     $icon
 * @property array<array-key, mixed>|null    $colors
 * @property array<array-key, mixed>|null    $dependencies
 * @property array<array-key, mixed>|null    $config
 * @property array<array-key, mixed>|null    $metadata
 * @property \Illuminate\Support\Carbon|null $activation_date
 * @property \Illuminate\Support\Carbon|null $deactivation_date
 * @property \Illuminate\Support\Carbon|null $installation_date
 * @property array<array-key, mixed>|null    $update_history
 * @method static Builder<static>|Module newModelQuery()
 * @method static Builder<static>|Module newQuery()
 * @method static Builder<static>|Module query()
 * @method static Builder<static>|Module whereColors($value)
 * @method static Builder<static>|Module whereDescription($value)
 * @method static Builder<static>|Module whereIcon($value)
 * @method static Builder<static>|Module whereId($value)
 * @method static Builder<static>|Module whereName($value)
 * @method static Builder<static>|Module wherePath($value)
 * @method static Builder<static>|Module wherePriority($value)
 * @method static Builder<static>|Module whereStatus($value)
 * @property ProfileContract|null $creator
 * @property ProfileContract|null $deleter
 * @property ProfileContract|null $updater
 * @method static ModuleFactory factory($count = null, $state = [])
 * @mixin \Eloquent
 */
final class Module extends BaseModel
=======
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Nwidart\Modules\Facades\Module as ModuleFacade;
use Nwidart\Modules\Module as NModule;
use Sushi\Sushi;

use function Safe\json_encode;

/**
 * @property int         $id
 * @property string|null $name
 * @property string|null $description
 * @property bool|null   $status
 * @property int|null    $priority
 * @property string|null $path
 * @method static Builder|Module newModelQuery()
 * @method static Builder|Module newQuery()
 * @method static Builder|Module query()
 * @method static Builder|Module whereDescription($value)
 * @method static Builder|Module whereId($value)
 * @method static Builder|Module whereName($value)
 * @method static Builder|Module wherePath($value)
 * @method static Builder|Module wherePriority($value)
 * @method static Builder|Module whereStatus($value)
 * @property string|null $icon
 * @property array<string, string>|null $colors
 * @method static Builder|Module whereColors($value)
 * @method static Builder|Module whereIcon($value)
 * @mixin IdeHelperModule
 * @mixin \Eloquent
 */
class Module extends Model
>>>>>>> laraxot/master
{
    use Sushi;

    protected $fillable = [
        'name',
<<<<<<< HEAD
        'slug',
        'version',
        'description',
        'status',
        'enabled',
        'is_active',
=======
        // 'alias',
        // 'description',
        'status',
>>>>>>> laraxot/master
        'priority',
        'path',
        'icon',
        'colors',
<<<<<<< HEAD
        'dependencies',
        'config',
        'metadata',
        'activation_date',
        'deactivation_date',
        'installation_date',
        'update_history',
    ];

    /**
     * @var string
     */
    protected $connection = 'xot';

    /**
=======
    ];

    /**
>>>>>>> laraxot/master
     * @return array<int, array<string, mixed>>
     */
    public function getRows(): array
    {
        $modules = ModuleFacade::all();
        $modules = Arr::map($modules, function (NModule $module): array {
            $config = config('tenant::config');
<<<<<<< HEAD
            if (! is_array($config)) {
=======
            if (!is_array($config)) {
>>>>>>> laraxot/master
                $config = [];
            }
            $colors = Arr::get($config, 'colors', []);

            return [
                'name' => $module->getName(),
                // 'alias' => $module->getAlias(),
                'description' => $module->getDescription(),
                'status' => $module->isEnabled(),
                'priority' => $module->get('priority'),
                'path' => $module->getPath(),
                'icon' => Arr::get($config, 'icon', 'heroicon-o-question-mark-circle'),
                'colors' => json_encode($colors),
            ];
        });

<<<<<<< HEAD
        /** @var array<int, array<string, mixed>> $rows */
        $rows = array_values($modules);

        return $rows;
=======
        /** @var array<int, array<string, mixed>> */
        return array_values($modules);
>>>>>>> laraxot/master
    }

    protected function casts(): array
    {
        return [
            'name' => 'string',
            'description' => 'string',
            'status' => 'boolean',
<<<<<<< HEAD
            'enabled' => 'boolean',
=======
>>>>>>> laraxot/master
            'priority' => 'integer',
            'path' => 'string',
            'icon' => 'string',
            'colors' => 'array',
        ];
    }
<<<<<<< HEAD

    public function isEnabled(): bool
    {
        if (null !== $this->enabled) {
            return (bool) $this->enabled;
        }

        if (null !== $this->status) {
            return (bool) $this->status;
        }

        return (bool) ($this->is_active ?? false);
    }

    public function isDisabled(): bool
    {
        return ! $this->isEnabled();
    }
=======
>>>>>>> laraxot/master
}
