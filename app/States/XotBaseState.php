<?php

declare(strict_types=1);

namespace Modules\Xot\States;

<<<<<<< HEAD
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Component;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Modules\Xot\Actions\Cast\SafeStringCastAction;
use Modules\Xot\Contracts\StateContract;
use Modules\Xot\Filament\Traits\TransTrait;
=======
use Filament\Schemas\Components\Component;
use Override;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Modules\Xot\Contracts\StateContract;
use Modules\Xot\Filament\Traits\TransTrait;
use Spatie\ModelStates\State;
>>>>>>> laraxot/master

/**
 * Abstract base class for appointment state management.
 *
 * Defines the state machine configuration and required methods
 * that must be implemented by each concrete state class.
 *
 * @property string $name  Il nome dello stato
 * @property string $value Il valore dello stato nel database
 */
<<<<<<< HEAD
abstract class XotBaseState implements StateContract
=======
abstract class XotBaseState extends State implements StateContract
>>>>>>> laraxot/master
{
    use TransTrait;

    public static string $name;

    public static function getName(): string
    {
<<<<<<< HEAD
        return static::$name ?? Str::of(class_basename(static::class))->snake()->toString();
    }

    public function label(): string
    {
        return static::transClass(static::class, 'states.'.static::getName().'.label');
=======
        /* @phpstan-ignore-next-line */
        return static::$name ?? Str::of(class_basename(static::class))->snake()->toString();
    }

    #[Override]
    public function label(): string
    {
        return static::transClass(static::class, 'states.' . static::getName() . '.label');
>>>>>>> laraxot/master

        // return 'Annullato';
    }

<<<<<<< HEAD
    public function color(): string
    {
        return static::transClass(static::class, 'states.'.static::getName().'.color');
    }

    public function bgColor(): string
    {
        return static::transClass(static::class, 'states.'.static::getName().'.bg_color');
=======
    #[Override]
    public function color(): string
    {
        return static::transClass(static::class, 'states.' . static::getName() . '.color');
    }

    #[Override]
    public function bgColor(): string
    {
        return static::transClass(static::class, 'states.' . static::getName() . '.bg_color');
>>>>>>> laraxot/master

        // return 'info';
    }

<<<<<<< HEAD
    public function icon(): string
    {
        return static::transClass(static::class, 'states.'.static::getName().'.icon');
=======
    #[Override]
    public function icon(): string
    {
        return static::transClass(static::class, 'states.' . static::getName() . '.icon');
>>>>>>> laraxot/master

        // return 'heroicon-o-x-circle';
    }

<<<<<<< HEAD
    public function modalHeading(): string
    {
        return static::transClass(static::class, 'states.'.static::getName().'.modal_heading');
=======
    #[Override]
    public function modalHeading(): string
    {
        return static::transClass(static::class, 'states.' . static::getName() . '.modal_heading');
>>>>>>> laraxot/master

        // return 'Annulla Appuntamento';
    }

<<<<<<< HEAD
    public function modalDescription(): string
    {
        // $appointment non utilizzata - rimossa

        return static::transClass(static::class, 'states.'.static::getName().'.modal_description');
=======
    #[Override]
    public function modalDescription(): string
    {
        $appointment = $this->getModel();

        return static::transClass(static::class, 'states.' . static::getName() . '.modal_description');
>>>>>>> laraxot/master

        // return 'Sei sicuro di voler annullare questo appuntamento?';
    }

    /**
     * @return array<string, Component>
     */
<<<<<<< HEAD
=======
    #[Override]
>>>>>>> laraxot/master
    public function modalFormSchema(): array
    {
        return [
            'message' => Textarea::make('message')->required()->maxLength(255),
        ];
    }

    /**
     * Fill form data for modal.
     *
     * @param array<string, mixed> $arguments
     * @param array<string, mixed> $data
     *
     * @return array<string, mixed>
     */
    public function modalFillForm(array $arguments, array $data): array
    {
        return $data;
    }

    /**
     * Fill form data for modal by record.
     *
     * @return array<string, mixed>
     */
<<<<<<< HEAD
=======
    #[Override]
>>>>>>> laraxot/master
    public function modalFillFormByRecord(Model $record): array
    {
        return [];
    }

    /**
     * Execute modal action.
     *
     * @param array<string, mixed> $arguments
     * @param array<string, mixed> $data
     */
    public function modalAction(array $arguments, array $data): void
    {
        $this->processStateAction($arguments, $data);
    }

    /**
     * Process state action.
     *
     * @param array<string, mixed> $arguments
     * @param array<string, mixed> $data
     */
    public function processStateAction(array $arguments, array $data): void
    {
        $message = Arr::get($data, 'message');
        $stateClass = static::class;
        /*
         *
         * $appointmentId = $arguments['appointment'];
         * $appointment = Appointment::firstWhere('id',$appointmentId);
         *
         * $appointment?->state->transitionTo($stateClass,$message);
         */
<<<<<<< HEAD
        // Fallback safe-mode when model-states package is not available.
        // Transition by generic arguments is intentionally a no-op.
=======
        $record = $this->getModel();
        /* @phpstan-ignore-next-line */
        $record->state->transitionTo($stateClass, $message);
>>>>>>> laraxot/master
    }

    /**
     * Execute modal action by record.
     *
     * @param array<string, mixed> $data
     */
<<<<<<< HEAD
=======
    #[Override]
>>>>>>> laraxot/master
    public function modalActionByRecord(Model $record, array $data): void
    {
        $this->processStateActionByRecord($record, $data);
    }

    /**
     * Process state action by record.
     *
     * @param array<string, mixed> $data
     */
    public function processStateActionByRecord(Model $record, array $data): void
    {
        $message = Arr::get($data, 'message');
        $stateClass = static::class;
        /*
         *
         * $appointmentId = $arguments['appointment'];
         * $appointment = Appointment::firstWhere('id',$appointmentId);
         *
         * $appointment?->state->transitionTo($stateClass,$message);
         */
<<<<<<< HEAD
        if (isset($record->state) && \is_object($record->state) && method_exists($record->state, 'transitionTo')) {
            $record->state->transitionTo($stateClass, $message);
        }
=======
        /* @phpstan-ignore-next-line */
        $record->state->transitionTo($stateClass, $message);
>>>>>>> laraxot/master
    }

    public function isMessageRequired(): bool
    {
        return false;
    }

<<<<<<< HEAD
    /**
     * @return array<string, mixed>
     */
    public static function getOptions(): array
    {
        if (! method_exists(static::class, 'getStateMapping')) {
            return [];
        }

        $mapping = static::getStateMapping();
        if (! \is_object($mapping) || ! method_exists($mapping, 'toArray')) {
            return [];
        }
        $states = $mapping->toArray();
        if (! \is_array($states)) {
            return [];
        }

        $result = [];
        foreach (array_keys($states) as $state) {
            $stateName = SafeStringCastAction::cast($state);
            $result[$stateName] = static::transClass(
                static::class,
                'states.'.$stateName.'.label',
            );
        }

        return $result;
=======
    public static function getOptions(): array
    {
        $states = static::getStateMapping()->toArray();

        $states = Arr::map($states, fn($_stateClass, $state) => static::transClass(
            static::class,
            'states.' . $state . '.label',
        ));

        return $states;
>>>>>>> laraxot/master
    }
}
