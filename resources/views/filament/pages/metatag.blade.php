<?php

declare(strict_types=1);

?>
<x-filament-panels::page>
<<<<<<< HEAD
    <form wire:submit="save">
=======
    <x-filament-schemas::form wire:submit="save">
>>>>>>> laraxot/master
        {{ $this->form }}

        <x-filament::actions
            :actions="$this->getFormActions()"
        />

<<<<<<< HEAD
    </form>
=======
    </x-filament-schemas::form>
>>>>>>> laraxot/master
</x-filament-panels::page>
