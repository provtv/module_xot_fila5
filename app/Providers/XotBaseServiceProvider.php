<?php

declare(strict_types=1);

namespace Modules\Xot\Providers;

<<<<<<< HEAD
use BladeUI\Icons\Exceptions\SvgNotFound;
use BladeUI\Icons\Factory as BladeIconsFactory;
=======
use BladeUI\Icons\Exceptions\CannotRegisterIconSet;
use BladeUI\Icons\Factory as BladeIconsFactory;
use Exception;
>>>>>>> laraxot/master
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Modules\Xot\Actions\Blade\RegisterBladeComponentsAction;
use Modules\Xot\Actions\File\GetComponentsAction;
use Modules\Xot\Actions\Livewire\RegisterLivewireComponentsAction;
use Modules\Xot\Actions\Module\GetModulePathByGeneratorAction;
<<<<<<< .merge_file_b3YJ1j
<<<<<<< HEAD
use Modules\Xot\Datas\ComponentFileData;
use Nwidart\Modules\Traits\PathNamespace;
=======
=======
use Modules\Xot\Datas\ComponentFileData;
>>>>>>> .merge_file_XwChcu
use Nwidart\Modules\Traits\PathNamespace;
use Throwable;
>>>>>>> laraxot/master
use Webmozart\Assert\Assert;

/**
 * Class XotBaseServiceProvider.
 */
abstract class XotBaseServiceProvider extends ServiceProvider
{
    use PathNamespace;

    public string $name = '';

    public string $nameLower = '';

    protected string $module_dir = __DIR__;

    protected string $module_ns = __NAMESPACE__;

    protected string $module_base_ns;

<<<<<<< HEAD
=======
    /**
     * Boot the application events.
     */
>>>>>>> laraxot/master
    public function boot(): void
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
<<<<<<< HEAD
        $this->loadMigrationsFrom($this->module_dir.'/../../database/migrations');
        $this->registerLivewireComponents();
        $this->registerBladeComponents();
        $this->registerCommands();
        $this->registerPublicAssets();
    }

=======
        $this->loadMigrationsFrom($this->module_dir.'/../Database/Migrations');
        $this->registerLivewireComponents();
        $this->registerBladeComponents();
        $this->registerCommands();
    }

    /**
     * Register the service provider.
     */
>>>>>>> laraxot/master
    public function register(): void
    {
        $this->nameLower = Str::lower($this->name);
        $this->module_ns = collect(explode('\\', $this->module_ns))->slice(0, -1)->implode('\\');
        $this->app->register($this->module_ns.'\Providers\RouteServiceProvider');
        $this->app->register($this->module_ns.'\Providers\EventServiceProvider');
        $this->registerBladeIcons();
    }

    public function registerBladeIcons(): void
    {
<<<<<<< HEAD
        if ('' === $this->name) {
            throw new \Exception('name is empty on ['.static::class.']');
        }

        // Blade UI Kit default set may already contain prefixes like "geo".
        // Skip registration if the prefix would collide with the default set.
        $this->callAfterResolving(BladeIconsFactory::class, function (BladeIconsFactory $factory): void {
            try {
                $assetsPath = app(GetModulePathByGeneratorAction::class)->execute($this->name, 'assets');
                $svgPath = $assetsPath.'/../svg';
                if (! File::exists($svgPath)) {
                    return;
                }
                // Check if prefix already registered to avoid collision with default set.
                try {
                    $factory->svg($this->nameLower.'::non-existent-test');
                } catch (SvgNotFound $e) {
                    // Prefix not registered yet — safe to add.
                    $factory->add($this->nameLower, ['path' => $svgPath, 'prefix' => $this->nameLower]);
                }
            } catch (\Throwable $e) {
                // Ignore missing optional assets.
            }
        });
    }

    public function registerViews(): void
    {
        if ('' === $this->name) {
            throw new \Exception('name is empty on ['.static::class.']');
        }

        $viewPath = module_path($this->name, 'resources/views');

        if (! is_dir($viewPath)) {
            return;
        }
=======
        if ($this->name === '') {
            throw new Exception('name is empty on ['.static::class.']');
        }

        $this->callAfterResolving(BladeIconsFactory::class, function (BladeIconsFactory $factory) {
            $assetsPath = app(GetModulePathByGeneratorAction::class)->execute($this->name, 'assets');
            $svgPath = $assetsPath.'/../svg';
            try {
                $factory->add($this->nameLower, ['path' => $svgPath, 'prefix' => $this->nameLower]);
            } catch (Throwable $e) {
                // Ignore missing SVG path
            }
        });

        // $svgPath = app(GetModulePathByGeneratorAction::class)->execute($this->name, 'svg');
        /*
         * Assert::string($relativePath = config('modules.paths.generator.assets.path'));
         *
         * try {
         * $svgPath = module_path($this->name, $relativePath.'/../svg');
         * if (! is_string($svgPath)) {
         * throw new \Exception('Invalid SVG path');
         * }
         * $resolvedPath = $svgPath;
         * $svgPath = $resolvedPath;
         * } catch (\Error $e) {
         * $svgPath = base_path('Modules/'.$this->name.'/'.$relativePath.'/../svg');
         * if (! is_string($svgPath)) {
         * throw new \Exception('Invalid fallback SVG path');
         * }
         * }
         *
         * $basePath = base_path(DIRECTORY_SEPARATOR);
         * $svgPath = str_replace($basePath, '', $svgPath);
         *
         * Config::set('blade-icons.sets.'.$this->nameLower.'.path', $svgPath);
         * Config::set('blade-icons.sets.'.$this->nameLower.'.prefix', $this->nameLower);
         */
    }

    /**
     * Register views.
     */
    public function registerViews(): void
    {
        if ($this->name === '') {
            throw new Exception('name is empty on ['.static::class.']');
        }

        $viewPath = module_path($this->name, 'resources/views');
        // if (! is_string($viewPath)) {
        //    throw new \Exception('Invalid view path');
        // }
>>>>>>> laraxot/master

        $this->loadViewsFrom($viewPath, $this->nameLower);
    }

<<<<<<< HEAD
    public function registerTranslations(): void
    {
        if ('' === $this->name) {
            throw new \Exception('name is empty on ['.static::class.']');
=======
    /**
     * Restituisce il path della cartella lang del modulo, con fallback robusto.
     */
    protected function getLangPath(): string
    {
        try {
            return app(GetModulePathByGeneratorAction::class)->execute($this->name, 'lang');
        } catch (Throwable $e) {
            return base_path('Modules/'.$this->name.'/lang');
        }
    }

    /**
     * Registra le traduzioni del modulo.
     *
     * @throws Exception
     */
    public function registerTranslations(): void
    {
        if ($this->name === '') {
            throw new Exception('name is empty on ['.static::class.']');
>>>>>>> laraxot/master
        }

        $langPath = $this->getLangPath();
        $this->loadTranslationsFrom($langPath, $this->nameLower);
        $this->loadJsonTranslationsFrom($langPath);
    }

<<<<<<< HEAD
=======
    /**
     * Register an additional directory of factories.
     */
>>>>>>> laraxot/master
    public function registerFactories(): void
    {
        if (! app()->environment('production')) {
            // app(Factory::class)->load($this->module_dir.'/../Database/factories');
        }
    }

<<<<<<< HEAD
    public function registerBladeComponents(): void
    {
        $componentViewPath = app(GetModulePathByGeneratorAction::class)->execute($this->name, 'component-view');

        if (is_dir($componentViewPath)) {
            try {
                Blade::anonymousComponentPath($componentViewPath);
            } catch (\Exception $e) {
                // Ignore invalid or unavailable anonymous component paths.
            }
=======
    /**
     * Register config.
     */
    protected function registerConfig(): void
    {
        try {
            $configPath = app(GetModulePathByGeneratorAction::class)->execute($this->name, 'config');

            $files = File::glob($configPath.'/*.php');

            foreach ($files as $file) {
                $content = File::getRequire($file);
                $info = pathinfo($file);
                $key = $this->nameLower.'::'.$info['filename'];
                Config::set($key, $content);
            }
        } catch (Exception $e) {
            // Ignore missing configuration
            return;
        }
    }

    public function registerBladeComponents(): void
    {
        $componentViewPath = app(GetModulePathByGeneratorAction::class)->execute($this->name, 'component-view');
        try {
            Blade::anonymousComponentPath($componentViewPath);
        } catch (Exception|CannotRegisterIconSet $e) {
            // Ignore missing component view path
            dddx([
                'name' => $this->name,
                'componentViewPath' => $componentViewPath,
                'e' => $e->getMessage(),
            ]);
>>>>>>> laraxot/master
        }

        $componentClassPath = app(GetModulePathByGeneratorAction::class)->execute($this->name, 'component-class');

        $namespace = $this->module_ns.'\View\Components';
        Blade::componentNamespace($namespace, $this->nameLower);

        app(RegisterBladeComponentsAction::class)->execute($componentClassPath, $this->module_ns);
    }

<<<<<<< HEAD
=======
    /**
     * Register Livewire components.
     */
>>>>>>> laraxot/master
    public function registerLivewireComponents(): void
    {
        $prefix = '';
        app(RegisterLivewireComponentsAction::class)
            ->execute($this->module_dir.'/../Http/Livewire', Str::before($this->module_ns, '\Providers'), $prefix);
    }

    public function registerCommands(): void
    {
        $prefix = '';

        $comps = app(GetComponentsAction::class)
            ->execute(
                $this->module_dir.'/../Console/Commands',
                'Modules\\'.$this->name.'\\Console\\Commands',
                $prefix,
            );
<<<<<<< HEAD
        if (0 === $comps->count()) {
            return;
        }

        $commands = [];
        foreach ($comps->items() as $comp) {
            if (! $comp instanceof ComponentFileData) {
                continue;
            }
            Assert::string($comp->ns, __FILE__.':'.__LINE__.' - '.class_basename(self::class));
            $commands[] = $comp->ns;
        }
<<<<<<< .merge_file_b3YJ1j
        $this->commands($commands);
    }

    /** @return array<int, string> */
=======
        if ($comps->count() === 0) {
            return;
        }
        $commands = $comps->toArray();
        /** @var array<int, array{ns: string}> $commands */
        $commands = array_map(static function (mixed $item): string {
            Assert::isArray($item);
            Assert::keyExists($item, 'ns');
            Assert::string($item['ns'], __FILE__.':'.__LINE__.' - '.class_basename(__CLASS__));

            return $item['ns'];
        }, $commands);
=======
>>>>>>> .merge_file_XwChcu
        $this->commands($commands);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array<int, string>
     */
>>>>>>> laraxot/master
    public function provides(): array
    {
        return [];
    }
<<<<<<< HEAD

    protected function getLangPath(): string
    {
        try {
            return app(GetModulePathByGeneratorAction::class)->execute($this->name, 'lang');
        } catch (\Throwable $e) {
            return base_path('Modules/'.$this->name.'/lang');
        }
    }

    protected function registerConfig(): void
    {
        try {
            $configPath = app(GetModulePathByGeneratorAction::class)->execute($this->name, 'config');
            $files = File::glob($configPath.'/*.php');

            foreach ($files as $file) {
                if (! is_string($file)) {
                    continue;
                }

                $filename = pathinfo($file, PATHINFO_FILENAME);
                Config::set($this->nameLower.'.'.$filename, require $file);
            }
        } catch (\Throwable $e) {
            // Ignore config registration failures for optional module config.
        }
    }

    protected function registerPublicAssets(): void
    {
        if ('' === $this->name) {
            throw new \Exception('name is empty on ['.static::class.']');
        }

        $sourcePath = module_path($this->name, 'public');

        if (! File::isDirectory($sourcePath)) {
            return;
        }

        $destinationPath = public_path(
            'assets/'.$this->nameLower
        );

        $this->publishes(
            [
                $sourcePath => $destinationPath,
            ],
            [
                'module-assets',
                $this->nameLower.'-assets',
            ],
        );
    }
=======
>>>>>>> laraxot/master
}
