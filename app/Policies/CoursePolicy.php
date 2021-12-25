<?php

declare(strict_types = 1);

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    public function edit(User $user, Course $course): bool
    {
        return $user->id === $course->user_id;
    }

    public function update(User $user, Course $course): bool
    {
        return $user->id === $course->user_id;
    }

    public function destroy(User $user, Course $course): bool
    {
        return $user->id === $course->user_id;
    }
}
