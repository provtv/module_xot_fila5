<?php

declare(strict_types=1);

use Illuminate\Database\Eloquent\Model;
use Modules\User\Database\Factories\UserFactory;
use Modules\User\Models\User;
use Modules\Xot\Actions\Cast\SafeEloquentCastAction;
use Modules\Xot\States\Transitions\XotBaseTransition;

/**
 * Fixture condivisa per i test di SafeEloquentCastAction.
 *
 * @return array{0: SafeEloquentCastAction, 1: Model}
 */
function safeEloquentCastFixture(): array
{
    $model = new class extends Model
    {
        /** @var array<string, mixed> */
        protected $attributes = [
            'name' => 'Mario',
            'age' => 42,
            'score' => 12.5,
            'active' => true,
            'meta' => ['k' => 'v'],
            'empty' => '',
        ];

        protected $guarded = [];
    };

    return [app(SafeEloquentCastAction::class), $model];
}

/**
 * Fixture condivisa per i test di XotBaseTransition.
 *
 * @return array{0: User, 1: XotBaseTransition}
 */
function xotBaseTransitionFixture(): array
{
    /** @var User $record */
    $record = UserFactory::new()->make();

    $transition = new class($record) extends XotBaseTransition
    {
        public static string $name = 'test_transition';
    };

    return [$record, $transition];
}
