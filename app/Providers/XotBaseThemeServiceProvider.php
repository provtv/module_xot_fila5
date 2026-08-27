<?php

declare(strict_types=1);

namespace Modules\Xot\Providers;

use Illuminate\Support\Facades\Blade;
<<<<<<< HEAD
use Illuminate\Support\ServiceProvider;
use Modules\Xot\Actions\Blade\RegisterBladeComponentsAction;
=======
use Modules\Xot\Actions\Blade\RegisterBladeComponentsAction;
use Illuminate\Support\ServiceProvider;
>>>>>>> laraxot/master

abstract class XotBaseThemeServiceProvider extends ServiceProvider
{
    public string $name = '';
<<<<<<< HEAD

    public string $nameLower = '';

    protected string $module_dir = __DIR__;

=======
    public string $nameLower = '';
    protected string $module_dir = __DIR__;
>>>>>>> laraxot/master
    protected string $module_ns = __NAMESPACE__;

    public function boot(): void
    {
<<<<<<< HEAD
        $this->loadViewsFrom($this->module_dir.'/../resources/views', $this->nameLower);
        $this->loadTranslationsFrom($this->module_dir.'/../resources/lang', $this->nameLower);
        $this->loadJsonTranslationsFrom($this->module_dir.'/../resources/lang');
=======
        $this->loadViewsFrom($this->module_dir . '/../resources/views', $this->nameLower);
        $this->loadTranslationsFrom($this->module_dir . '/../resources/lang', $this->nameLower);
        $this->loadJsonTranslationsFrom($this->module_dir . '/../resources/lang');
>>>>>>> laraxot/master
        $this->registerBladeComponents();
    }

    public function register(): void
    {
<<<<<<< HEAD
        $this->app->register($this->module_ns.'\Providers\RouteServiceProvider');
        $this->app->register($this->module_ns.'\Providers\EventServiceProvider');
=======
        $this->app->register($this->module_ns . '\Providers\RouteServiceProvider');
        $this->app->register($this->module_ns . '\Providers\EventServiceProvider');
>>>>>>> laraxot/master
    }

    protected function registerBladeComponents(): void
    {
<<<<<<< HEAD
        $componentNamespace = $this->module_ns.'\View\Components';
        Blade::componentNamespace($componentNamespace, $this->nameLower);

        app(RegisterBladeComponentsAction::class)
            ->execute($this->module_dir.'/../View/Components', $this->module_ns);
=======
        $componentNamespace = $this->module_ns . '\View\Components';
        Blade::componentNamespace($componentNamespace, $this->nameLower);

        app(RegisterBladeComponentsAction::class)
            ->execute($this->module_dir . '/../View/Components', $this->module_ns);
>>>>>>> laraxot/master
    }
}
