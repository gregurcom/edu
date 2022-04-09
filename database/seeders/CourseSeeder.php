<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;

final class CourseSeeder extends Seeder
{
    public function run(): void
    {
        Course::factory()->count(30)->hasLessons(2)->hasRates(4, ['user_id' => $this->getRandomUserId()])->forCategory()->create(['user_id' => $this->getRandomUserId()]);
        Course::factory()->count(25)->hasLessons(2)->hasRates(4, ['user_id' => $this->getRandomUserId()])->forCategory()->create(['user_id' => $this->getRandomUserId()]);
        Course::factory()->count(1)->hasLessons(2)->hasRates(4, ['user_id' => $this->getRandomUserId()])->forCategory()->create(['user_id' => $this->getRandomUserId()]);
    }

    private function getRandomUserId(): int
    {
        $user = User::inRandomOrder()->first();

        return $user->id;
    }
}
