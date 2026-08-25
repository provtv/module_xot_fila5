<?php

declare(strict_types=1);

namespace Modules\Xot\Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;

use function Safe\realpath;

/**
 * Trait CreatesApplication.
 *
 * Provides the createApplication method for test cases.
 * This trait is used by all module test cases to bootstrap the Laravel application.
 */
trait CreatesApplication
{
    /**
     * Creates the application.
     */
    public function createApplication(): Application
    {
        // Get base path (assuming tests are in Modules/{Module}/tests/)
        $basePath = realpath(__DIR__.'/../../../');

        // Explicitly set the base path before requiring bootstrap/app.php
        $_ENV['APP_BASE_PATH'] = $basePath;

        $appEnv = $_ENV['APP_ENV'] ?? getenv('APP_ENV') ?: 'local';
        $envFile = $this->resolveTestingEnvFile($basePath);

        if ($appEnv === 'testing' && $envFile === null) {
            throw new \RuntimeException(
                'Env di test mancante: serve laravel/.env.sqlite (canonico) oppure laravel/.env.testing. '
                .'Copiare .env e sostituire i nomi DB con le repliche *_test.'
            );
        }

        $app = $this->loadLaravelApplication($basePath.'/bootstrap/app.php');

        if ($appEnv === 'testing' && $envFile !== null) {
            $app->loadEnvironmentFrom($envFile);
        }

        // Bind essential paths if they are not correctly resolved
        $app->instance('path.base', $basePath);
        $app->bind('path.public', fn () => $basePath.'/public_html');
        $app->bind('path.storage', fn () => $basePath.'/storage');

        // Bootstrap kernel to ensure all service providers and aliases are registered
        $kernel = $app->make(Kernel::class);
        if (! $kernel instanceof Kernel) {
            throw new \RuntimeException('Console kernel must implement Illuminate\Contracts\Console\Kernel.');
        }

        $kernel->bootstrap();
        $app->boot(); // Ensure all service providers are booted

        // CRITICAL: DO NOT force database connections!
        // TenantServiceProvider automatically configures module connections
        // by reading DB_DATABASE from .env.testing
        // Forcing connections here destroys the dynamic configuration system

        return $app;
    }

    private function loadLaravelApplication(string $bootstrapPath): Application
    {
        $app = require $bootstrapPath;
        if (! $app instanceof Application) {
            throw new \RuntimeException('bootstrap/app.php must return an Application instance.');
        }

        return $app;
    }

    /**
     * File di environment dei test, in ordine di preferenza.
     *
     * `.env.sqlite` è il nome canonico dell'env di test del progetto. Il nome è
     * storico: dentro c'è MySQL sulle repliche `*_test`, non SQLite — i test
     * girano sullo stesso dialetto del runtime per non inseguire differenze
     * fra SQLite e MySQL. `.env.testing` resta come fallback.
     *
     * @return string|null nome del file (relativo alla root Laravel) o null se nessuno è leggibile
     */
    private function resolveTestingEnvFile(string $basePath): ?string
    {
        foreach (['.env.sqlite', '.env.testing'] as $candidate) {
            if (is_readable($basePath.'/'.$candidate)) {
                return $candidate;
            }
        }

        return null;
    }
}
