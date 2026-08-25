<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Module;

use Illuminate\Support\Facades\File;
use Spatie\QueueableAction\QueueableAction;

class GetModuleConfigAction
{
    use QueueableAction;

<<<<<<< HEAD
   /**
=======
    /**
>>>>>>> laraxot/dev
     * @return array<string, mixed>
     */
    public function execute(string $moduleName, string $config): array
    {
        $configPath = app(GetModulePathByGeneratorAction::class)->execute($moduleName, 'config');
        $configFile = $configPath.'/'.$config.'.php';
        if (! file_exists($configFile)) {
            throw new \Exception('Config file not found: '.$configFile);
        }
<<<<<<< HEAD
        $loaded = File::getRequire($configFile);
        if (! is_array($loaded)) {
            throw new \Exception('Config file must return array: '.$configFile);
        }

=======

        $loaded = File::getRequire($configFile);
        if (! is_array($loaded)) {
            throw new \Exception('Config file must return array: '.$configFile);
        }

>>>>>>> laraxot/dev
        /** @var array<string, mixed> $normalized */
        $normalized = [];

        foreach ($loaded as $key => $value) {
            if (! is_string($key)) {
                continue;
            }

            /* @var string $key */
            $normalized[$key] = $value;
        }

        /* @var array<string, mixed> $normalized */
        return $normalized;
    }
}
