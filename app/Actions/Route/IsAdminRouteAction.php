<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Route;

use Modules\Xot\Datas\RouteParamsData;
use Spatie\QueueableAction\QueueableAction;

class IsAdminRouteAction
{
    use QueueableAction;

    public function execute(RouteParamsData $params = new RouteParamsData()): bool
    {
        if (null !== $params->in_admin) {
            return $params->in_admin;
        }

        if ('admin' === request()->segment(1)) {
            return true;
        }

        $segments = request()->segments();

        return [] !== $segments && 'livewire' === $segments[0] && true === session('in_admin', false);
    }
}
