<?php

declare(strict_types = 1);

namespace App\Policies;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LessonPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Lesson $lesson): bool
    {
        return $user->id === $lesson->course->user_id;
    }

    public function edit(User $user, Lesson $lesson): bool
    {
        return $user->id === $lesson->course->user_id;
    }

    public function delete(User $user, Lesson $lesson): bool
    {
        return $user->id === $lesson->course->user_id;
    }
}