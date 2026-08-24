<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Route;

use Modules\Xot\Datas\RouteParamsData;
use Spatie\QueueableAction\QueueableAction;

class IsAdminRouteAction
{
    use QueueableAction;

<<<<<<< .merge_file_6bx9VY
    public function execute(RouteParamsData $params = new RouteParamsData): bool
    {
        if ($params->in_admin !== null) {
            return $params->in_admin;
        }

        if (request()->segment(1) === 'admin') {
=======
    public function execute(RouteParamsData $params = new RouteParamsData()): bool
    {
        if (null !== $params->in_admin) {
            return $params->in_admin;
        }

        if ('admin' === request()->segment(1)) {
>>>>>>> .merge_file_BW1E0U
            return true;
        }

        $segments = request()->segments();

<<<<<<< .merge_file_6bx9VY
        return $segments !== [] && $segments[0] === 'livewire' && session('in_admin', false) === true;
=======
        return [] !== $segments && 'livewire' === $segments[0] && true === session('in_admin', false);
>>>>>>> .merge_file_BW1E0U
    }
}
