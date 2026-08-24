<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Route;

use Modules\Xot\Datas\RouteParamsData;
use Spatie\QueueableAction\QueueableAction;

class IsAdminRouteAction
{
    use QueueableAction;

    public function execute(RouteParamsData $params = new RouteParamsData): bool
    {
        if ($params->in_admin !== null) {
            return $params->in_admin;
        }

        if (request()->segment(1) === 'admin') {
            return true;
        }

        $segments = request()->segments();

        return $segments !== [] && $segments[0] === 'livewire' && session('in_admin', false) === true;
    }
}
