<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Route;

use Illuminate\Routing\Route;
use Illuminate\Routing\Router;
use Illuminate\Support\Str;
use Modules\Xot\Datas\RouteParamsData;
use Spatie\QueueableAction\QueueableAction;

class BuildActionUrlAction
{
    use QueueableAction;

    public function execute(RouteParamsData $params): string
    {
        $action = $params->act ?? 'show';
        $row = $params->row ?? (object) [];
        $query = $params->query ?? [];
        $route = request()->route();
<<<<<<< .merge_file_XZboDh
        if (! $route instanceof Route || $route->getName() === null) {
=======
        if (! $route instanceof Route || null === $route->getName()) {
>>>>>>> .merge_file_bl3NLM
            return '#'.$action;
        }

        $target = Str::beforeLast($route->getName(), '.').'.'.$action;
        $routeParams = $route->parameters();
        $router = app(Router::class);

        return $router->has($target) ? route($target, array_merge($routeParams, [$row], $query)) : '#'.$target;
    }
}
