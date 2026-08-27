<?php

declare(strict_types=1);

/**
 * ----------------------------------------------------------------.
 */

namespace Modules\Xot\Models\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
<<<<<<< HEAD
use Illuminate\Auth\Access\Response;
=======
>>>>>>> laraxot/master
use Modules\Xot\Contracts\UserContract;

// use Modules\Xot\Datas\XotData;

abstract class XotBasePolicy
{
    use HandlesAuthorization;

<<<<<<< HEAD
    public function before(UserContract $user, string $_ability): ?bool
=======
    public function before(UserContract $user, string $_ability): null|bool
>>>>>>> laraxot/master
    {
        return once(function () use ($user) {
            if ($user->hasRole('super-admin')) {
                return true;
            }
<<<<<<< HEAD
        });
    }

    public function viewAny(UserContract $user): Response|bool
=======

            return null;
        });
    }

    public function viewAny(UserContract $userContract): bool
>>>>>>> laraxot/master
    {
        return false;
    }
}
