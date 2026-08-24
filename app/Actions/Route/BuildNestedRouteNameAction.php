<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Route;

use Modules\Xot\Datas\RouteParamsData;
use Spatie\QueueableAction\QueueableAction;

class BuildNestedRouteNameAction
{
    use QueueableAction;

    public function execute(RouteParamsData $params): string
    {
        $depth = $params->n ?? 0;
        $action = $params->act ?? 'show';
        $parts = inAdmin(['in_admin' => $params->in_admin]) ? ['admin'] : [];

        for ($i = 0; $i <= $depth; $i++) {
            $parts[] = 'container'.$i;
        }

        $parts[] = $action;

        return implode('.', $parts);
    }
}
