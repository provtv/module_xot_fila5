<?php

declare(strict_types=1);

namespace Modules\Xot\Providers;

<<<<<<< HEAD
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Nwidart\Modules\Module;

use function Safe\preg_match;

use Webmozart\Assert\Assert;

/**
 * Service Provider per ottimizzazioni Filament.
 * SuperMucca Optimization Provider 🐄.
=======
use PDO;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Xot\Http\Middleware\FilamentMemoryMonitorMiddleware;
use function Safe\preg_match;

/**
 * Service Provider per ottimizzazioni Filament.
 * SuperMucca Optimization Provider 🐄
>>>>>>> laraxot/master
 */
class FilamentOptimizationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Registra il config
        $this->mergeConfigFrom(
            base_path('config/filament_optimization.php'),
            'filament_optimization'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Applica ottimizzazioni solo se abilitato
        if (config('filament_optimization.memory.enabled', true)) {
            $this->applyMemoryOptimizations();
        }

        // Configura query logging per performance monitoring
        if (config('filament_optimization.monitoring.log_slow_queries', true)) {
            $this->configureQueryLogging();
        }

<<<<<<< HEAD
=======
        // Registra middleware di monitoraggio
        if (config('filament_optimization.monitoring.memory_profiling', false)) {
            $this->registerMemoryMonitoring();
        }

>>>>>>> laraxot/master
        // Ottimizzazioni per l'ambiente di produzione
        if (app()->environment('production')) {
            $this->applyProductionOptimizations();
        }
    }

    /**
     * Applica ottimizzazioni per la memoria.
     */
    private function applyMemoryOptimizations(): void
    {
        // Ottimizza le query di default
<<<<<<< HEAD
        DB::listen(function (QueryExecuted $query): void {
            // Log query che superano la soglia di tempo
            $threshold = config('filament_optimization.monitoring.slow_query_threshold', 1000);
            Assert::numeric($threshold);
            /** @var int|float $threshold */
=======
        DB::listen(function ($query) {
            // Log query che superano la soglia di tempo
            $threshold = config('filament_optimization.monitoring.slow_query_threshold', 1000);
            
>>>>>>> laraxot/master
            if ($query->time > $threshold) {
                Log::warning('Slow query detected', [
                    'sql' => $query->sql,
                    'bindings' => $query->bindings,
                    'time' => $query->time,
<<<<<<< HEAD
                    'connection' => $query->connection->getName(),
=======
                    'connection' => $query->connectionName,
>>>>>>> laraxot/master
                ]);
            }
        });

        // Limita il numero di query per richiesta in development
        if (app()->environment('local', 'development')) {
            $this->limitQueriesInDevelopment();
        }
    }

    /**
     * Configura il logging delle query.
     */
    private function configureQueryLogging(): void
    {
        // Abilita query logging solo per richieste Filament admin
        if ($this->isFilamentAdminRequest()) {
            DB::enableQueryLog();
<<<<<<< HEAD

            // Log delle query alla fine della richiesta
            app()->terminating(function (): void {
                $queries = DB::getQueryLog();
                Assert::isArray($queries);
                /** @var array<int, array<string, mixed>> $queries */
                $totalQueries = count($queries);

                $times = [];
                foreach ($queries as $query) {
                    Assert::isArray($query);
                    if (isset($query['time']) && \is_numeric($query['time'])) {
                        $times[] = (float) $query['time'];
                    }
                }
                $totalTime = array_sum($times);

                if ($totalQueries > 50 || $totalTime > 1000) {
                    Log::debug('High query count or time detected', [
=======
            
            // Log delle query alla fine della richiesta
            app()->terminating(function () {
                $queries = DB::getQueryLog();
                $totalQueries = count($queries);
                $totalTime = array_sum(array_column($queries, 'time'));
                
                if ($totalQueries > 50 || $totalTime > 1000) {
                    Log::info('High query count or time detected', [
>>>>>>> laraxot/master
                        'total_queries' => $totalQueries,
                        'total_time' => $totalTime,
                        'url' => request()->fullUrl(),
                    ]);
                }
            });
        }
    }

    /**
<<<<<<< HEAD
=======
     * Registra il middleware di monitoraggio memoria.
     */
    private function registerMemoryMonitoring(): void
    {
        // Il middleware verrà registrato nel kernel HTTP
        app('router')->pushMiddlewareToGroup('web', FilamentMemoryMonitorMiddleware::class);
    }

    /**
>>>>>>> laraxot/master
     * Applica ottimizzazioni per l'ambiente di produzione.
     */
    private function applyProductionOptimizations(): void
    {
        // Disabilita query logging in produzione per performance
        DB::disableQueryLog();
<<<<<<< HEAD

        // Ottimizza la configurazione di Eloquent
        $this->optimizeEloquentConfiguration();

=======
        
        // Ottimizza la configurazione di Eloquent
        $this->optimizeEloquentConfiguration();
        
>>>>>>> laraxot/master
        // Configura caching aggressivo
        $this->configureAggressiveCaching();
    }

    /**
     * Ottimizza la configurazione di Eloquent.
     */
    private function optimizeEloquentConfiguration(): void
    {
        // Disabilita eventi Eloquent non necessari per performance
        if (config('filament_optimization.query.disable_events', false)) {
            // Questo può essere fatto per modelli specifici se necessario
        }
<<<<<<< HEAD

=======
        
>>>>>>> laraxot/master
        // Configura connection pooling se disponibile
        $currentOptions = config('database.connections.mysql.options');
        if ($currentOptions) {
            $optionsArray = is_array($currentOptions) ? $currentOptions : [];
            config([
                'database.connections.mysql.options' => array_merge(
                    $optionsArray,
                    [
<<<<<<< HEAD
                        \PDO::ATTR_PERSISTENT => true,
                        \PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
=======
                        PDO::ATTR_PERSISTENT => true,
                        PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
>>>>>>> laraxot/master
                    ]
                ),
            ]);
        }
    }

    /**
     * Configura caching aggressivo.
     */
    private function configureAggressiveCaching(): void
    {
        // Cache delle configurazioni
        if (config('filament_optimization.cache.module_configs', true)) {
            // Implementa caching per configurazioni moduli
            $this->cacheModuleConfigurations();
        }
<<<<<<< HEAD

=======
        
>>>>>>> laraxot/master
        // Cache delle navigation items
        if (config('filament_optimization.cache.navigation', true)) {
            // Già implementato in GetModulesNavigationItems
        }
    }

    /**
     * Cache delle configurazioni dei moduli.
     */
    private function cacheModuleConfigurations(): void
    {
        // Implementa caching per le configurazioni dei moduli
        // Questo riduce l'I/O del filesystem
        app()->singleton('module.configs', function () {
            return cache()->remember('xot:module:configs', now()->addHours(1), function () {
                // Carica tutte le configurazioni dei moduli
                $configs = [];
                $modules = app('modules')->all();
<<<<<<< HEAD

                foreach ($modules as $module) {
                    Assert::isInstanceOf($module, Module::class);
                    $modulePath = $module->getPath();
                    $configPath = $modulePath.'/Config/config.php';
                    if (file_exists($configPath)) {
                        $moduleName = $module->getName();
                        $configs[$moduleName] = require $configPath;
                    }
                }

=======
                
                foreach ($modules as $module) {
                    $configPath = $module->getPath() . '/Config/config.php';
                    if (file_exists($configPath)) {
                        $configs[$module->getName()] = require $configPath;
                    }
                }
                
>>>>>>> laraxot/master
                return $configs;
            });
        });
    }

    /**
     * Limita il numero di query in development.
     */
    private function limitQueriesInDevelopment(): void
    {
        $maxQueries = config('filament_optimization.development.max_queries_per_request', 100);
<<<<<<< HEAD

        app()->terminating(function () use ($maxQueries) {
            $queries = DB::getQueryLog();
            $totalQueries = count($queries);

=======
        
        app()->terminating(function () use ($maxQueries) {
            $queries = DB::getQueryLog();
            $totalQueries = count($queries);
            
>>>>>>> laraxot/master
            if ($totalQueries > $maxQueries) {
                Log::warning("High query count detected: {$totalQueries} queries", [
                    'url' => request()->fullUrl(),
                    'queries' => array_slice($queries, 0, 10), // Solo le prime 10 per il log
                ]);
            }
        });
    }

    /**
     * Determina se la richiesta corrente è per un pannello admin Filament.
     */
    private function isFilamentAdminRequest(): bool
    {
<<<<<<< HEAD
        if (! app()->runningInConsole() && request()) {
            $path = request()->path();

            return str_contains($path, '/admin')
                   || str_ends_with($path, '/admin')
                   || preg_match('/\/(user|<nome progetto>|cms|geo|notify|tenant)\/admin/', $path);
        }

=======
        if (!app()->runningInConsole() && request()) {
            $path = request()->path();
            return str_contains($path, '/admin') || 
                   str_ends_with($path, '/admin') ||
                   preg_match('/\/(user|techplanner|cms|geo|notify|tenant)\/admin/', $path);
        }
        
>>>>>>> laraxot/master
        return false;
    }
}
