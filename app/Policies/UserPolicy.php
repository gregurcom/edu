<?php

declare(strict_types = 1);

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewTelescope(User $user): bool
    {
        return $user->email == 'mikhailgregurco@gmail.com';
    }
}
