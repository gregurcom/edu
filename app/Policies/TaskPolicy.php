<?php

declare(strict_types = 1);

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Task $task): bool
    {
        return $user->id === $task->user_id;
    }

    public function destroy(User $user, Task $task): bool
    {
        return $user->id === $task->user_id;
    }
}
