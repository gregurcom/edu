<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Task;
use App\Models\User;
use App\Policies\CoursePolicy;
use App\Policies\LessonPolicy;
use App\Policies\TaskPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Course::class => CoursePolicy::class,
        Lesson::class => LessonPolicy::class,
        User::class => UserPolicy::class,
        Task::class => TaskPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-task', function (User $user, Task $task) {
            return $user->id === $task->user_id;
        });

        Gate::define('destroy-task', function (User $user, Task $task) {
            return $user->id === $task->user_id;
        });
    }
}
