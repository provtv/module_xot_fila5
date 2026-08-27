<?php

declare(strict_types=1);

namespace Modules\Xot\View\Components\Dashboard;

<<<<<<< HEAD
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;
=======
use Illuminate\Contracts\Support\Renderable;
>>>>>>> laraxot/master
use Illuminate\View\Component;

// use Modules\Xot\View\Components\XotBaseComponent;

/**
 * Class Field.
 */
class Item extends Component
{
<<<<<<< HEAD
    public function render(): View
    {
        /** @var string $view */
        $view = 'xot::components.dashboard.item';
        /** @var array<string, string> $view_params */
=======
    public function render(): Renderable
    {
        /**
         * @phpstan-var view-string
         */
        $view = 'xot::components.dashboard.item';
>>>>>>> laraxot/master
        $view_params = [
            'view' => $view,
        ];

<<<<<<< HEAD
        return ViewFacade::make($view, $view_params);
=======
        return view($view, $view_params);
>>>>>>> laraxot/master
    }
}
