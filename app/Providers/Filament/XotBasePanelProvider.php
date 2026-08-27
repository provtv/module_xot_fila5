<?php

declare(strict_types=1);

namespace Modules\Xot\Providers\Filament;

<<<<<<< HEAD
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Str;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Modules\Xot\Actions\Panel\ApplyMetatagToPanelAction;
// Remove if not used elsewhere implicitly
use Modules\Xot\Datas\XotData;
use Webmozart\Assert\Assert;
=======
use Filament\Panel;
use Filament\PanelProvider;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Webmozart\Assert\Assert;
use Modules\Xot\Datas\XotData;
use Filament\Support\Colors\Color;
use Modules\Xot\Datas\MetatagData;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Http\Middleware\AuthenticateSession;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Modules\Xot\Actions\Panel\ApplyMetatagToPanelAction;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Modules\Xot\Actions\Filament\GetModulesNavigationItems;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
>>>>>>> laraxot/master

abstract class XotBasePanelProvider extends PanelProvider
{
    protected string $module;

    protected bool $topNavigation = false;

    protected bool $globalSearch = false;

    protected bool $navigation = true;

    public function panel(Panel $panel): Panel
    {
        $moduleNamespace = $this->getModuleNamespace();
        $moduleLow = Str::lower($this->module);
<<<<<<< HEAD
        $mainModuleLow = Str::lower(XotData::make()->main_module); // Renamed to camelCase
        $default = $mainModuleLow === $moduleLow;

        $panel = $panel
            ->default($default)
            ->login() // UNCOMMENTED
=======
        $metatag = MetatagData::make();

        $main_module = Str::lower(XotData::make()->main_module);
        $default = $main_module === $moduleLow;

        $panel = $panel
            ->default($default)
            // ->login()
>>>>>>> laraxot/master
            // ->registration()
            ->passwordReset()
            // ->emailVerification()
            // ->profile()
            ->sidebarFullyCollapsibleOnDesktop();

<<<<<<< HEAD
        $panel = app(ApplyMetatagToPanelAction::class)->execute(panel: $panel);
        // ---------------------
        $panel->maxContentWidth('full')
=======
        app(ApplyMetatagToPanelAction::class)->execute(panel: $panel);
        // ---------------------
        $panel
            ->maxContentWidth('full')
>>>>>>> laraxot/master
            ->topNavigation($this->topNavigation)
            ->globalSearch($this->globalSearch)
            ->readOnlyRelationManagersOnResourceViewPagesByDefault(false)
            ->navigation($this->navigation)
            // ->tenant($teamClass)
            // ->tenant($teamClass,ownershipRelationship:'users')
            // ->tenant($teamClass)
<<<<<<< HEAD
            ->id($moduleLow.'::admin')
            ->path($moduleLow.'/admin')
            // Configure Filament discovery for module components (unconditional; dirs are expected to exist)
            ->discoverResources(
                base_path('Modules/'.$this->module.'/app/Filament/Resources'),
                sprintf('%s\\Filament\\Resources', $moduleNamespace),
            )
            ->discoverPages(
                base_path('Modules/'.$this->module.'/app/Filament/Pages'),
                sprintf('%s\\Filament\\Pages', $moduleNamespace),
            )
            ->discoverWidgets(
                base_path('Modules/'.$this->module.'/app/Filament/Widgets'),
                sprintf('%s\\Filament\\Widgets', $moduleNamespace),
            )
            ->discoverClusters(
                base_path('Modules/'.$this->module.'/app/Filament/Clusters'),
                sprintf('%s\\Filament\\Clusters', $moduleNamespace),
=======
            ->id($moduleLow . '::admin')
            ->path($moduleLow . '/admin')
            // Configure Filament discovery for module components (unconditional; dirs are expected to exist)
            ->discoverResources(
                in: base_path('Modules/' . $this->module . '/app/Filament/Resources'),
                for: sprintf('%s\\Filament\\Resources', $moduleNamespace),
            )
            ->discoverPages(
                in: base_path('Modules/' . $this->module . '/app/Filament/Pages'),
                for: sprintf('%s\\Filament\\Pages', $moduleNamespace),
            )
            ->discoverWidgets(
                in: base_path('Modules/' . $this->module . '/app/Filament/Widgets'),
                for: sprintf('%s\\Filament\\Widgets', $moduleNamespace),
            )
            ->discoverClusters(
                in: base_path('Modules/' . $this->module . '/app/Filament/Clusters'),
                for: sprintf('%s\\Filament\\Clusters', $moduleNamespace),
>>>>>>> laraxot/master
            )
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
<<<<<<< HEAD
                PreventRequestForgery::class,
=======
                VerifyCsrfToken::class,
>>>>>>> laraxot/master
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);

<<<<<<< HEAD
=======
       

>>>>>>> laraxot/master
        return $panel;
    }

    protected function getModuleNamespace(): string
    {
        Assert::string($ns = config('modules.namespace'));

<<<<<<< HEAD
        return $ns.'\\'.$this->module;
=======
        return $ns . '\\' . $this->module;
>>>>>>> laraxot/master
    }
}
