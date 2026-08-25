<?php

declare(strict_types=1);

namespace Modules\Xot\Filament\Pages;

use Filament\Pages\Dashboard as FilamentDashboard;
use Filament\Widgets\Widget;
use Filament\Widgets\WidgetConfiguration;

abstract class XotBaseDashboard extends FilamentDashboard
{
    /**
     * @return array<class-string<Widget>|WidgetConfiguration>
     */
    public function getWidgets(): array
    {
        return [
            // Override if needed
        ];
    }

    public function getColumns(): int|array
    {
        return 2;
    }
}
