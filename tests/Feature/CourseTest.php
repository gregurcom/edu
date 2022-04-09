<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

final class CourseTest extends TestCase
{
    public function test_course(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $course = Course::factory()->create(['user_id' => $user->id, 'category_id' => $category->id]);

        $response = $this->get('courses/' . $course->slug);

        $response->assertStatus(200)->assertSee($course->title);
    }
}
