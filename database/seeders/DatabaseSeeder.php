<?php

declare(strict_types = 1);

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(3)->create();

        Course::factory()->count(3)->hasLessons(10)->create(['user_id' => 1]);
    }
}
