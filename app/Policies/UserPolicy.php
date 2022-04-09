<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

final class UserPolicy
{
    use HandlesAuthorization;

    public function viewTelescope(User $user): bool
    {
        return $user->email == 'mikhailgregurco@gmail.com';
    }

    public function accessAdminPanel(User $user): bool
    {
        return $user->role === User::ADMIN;
    }
}
