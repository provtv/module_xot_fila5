<?php

declare(strict_types=1);

namespace Modules\Xot\View\Components;

<<<<<<< HEAD
=======
use InvalidArgumentException;
>>>>>>> laraxot/master
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Str;
use Illuminate\View\Component as IlluminateComponent;

/**
 * Class XotBaseComponent.
 */
abstract class XotBaseComponent extends IlluminateComponent
{
    /**
     * Undocumented variable.
     *
     * @var array<mixed>
     */
    public array $attrs = [];

    /**
     * Summary of assets.
     *
     * @var list<string>
     */
    protected static array $assets = [];

    /**
     * Cache for resolved views.
     *
<<<<<<< HEAD
     * @var array<string, string>
=======
     * @var array<string, view-string>
>>>>>>> laraxot/master
     */
    protected static array $viewCache = [];

    /**
     * Summary of assets.
     *
     * @return list<string>
     */
    public static function assets(): array
    {
        return static::$assets;
    }

    /**
<<<<<<< HEAD
     * Get the view name for this component.
=======
     * Summary of getView.
     *
     * @return view-string
>>>>>>> laraxot/master
     */
    public function getView(): string
    {
        $class = static::class;

        if (isset(self::$viewCache[$class])) {
            return self::$viewCache[$class];
        }

<<<<<<< HEAD
        $module_name = Str::between($class, 'Modules\\', '\\Views\\');
        if ('' === $module_name) {
            throw new \InvalidArgumentException("Unable to determine module name from class [{$class}].");
        }

=======
        $module_name = Str::between($class, 'Modules\\', '\Views\\');
>>>>>>> laraxot/master
        $module_name_low = Str::lower($module_name);

        $comp_name = Str::after($class, '\View\Components\\');
        $comp_name = str_replace('\\', '.', $comp_name);
        $comp_name = Str::snake($comp_name);

<<<<<<< HEAD
        $view = $module_name_low.'::components.'.$comp_name;
        $view = str_replace('._', '.', $view);

        if (! view()->exists($view)) {
            throw new \InvalidArgumentException("View [{$view}] does not exist.");
        }

=======
        $view = $module_name_low . '::components.' . $comp_name;
        $view = str_replace('._', '.', $view);

        if (!view()->exists($view)) {
            throw new InvalidArgumentException("View [{$view}] does not exist.");
        }
>>>>>>> laraxot/master
        self::$viewCache[$class] = $view;

        return $view;
    }

    // ret \Closure|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Support\Htmlable|\Illuminate\Contracts\View\Factory|View|string

    public function render(): Renderable
    {
        $view = $this->getView();
<<<<<<< HEAD
        /** @var view-string $view */
=======
>>>>>>> laraxot/master
        $view_params = [
            'view' => $view,
        ];

        return view($view, $view_params);
    }
}
