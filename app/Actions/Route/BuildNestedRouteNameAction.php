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

<<<<<<< .merge_file_VGj39j
        for ($i = 0; $i <= $depth; $i++) {
=======
        for ($i = 0; $i <= $depth; ++$i) {
>>>>>>> .merge_file_ghFAsD
            $parts[] = 'container'.$i;
        }

        $parts[] = $action;

        return implode('.', $parts);
    }
}
