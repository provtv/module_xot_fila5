<?php

declare(strict_types=1);

namespace Coolsam\FilamentModules\Extensions;

use Illuminate\Support\Facades\Log;
use Nwidart\Modules\LaravelModulesServiceProvider as BaseModulesServiceProvider;

class LaravelModulesServiceProvider extends BaseModulesServiceProvider
{
    public function register(): void
    {
        $this->registerPanels();
        parent::register();
<<<<<<< HEAD
        Log::debug('Registered Modules');
=======
        Log::info('Registered Modules');
>>>>>>> laraxot/master
    }

    public function registerPanels(): void
    {
        // Override this to do anything during registration
    }
}
