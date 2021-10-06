<?php

declare(strict_types = 1);

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CourseTest extends DuskTestCase
{
    public function testCourse(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::first())
                ->visit('/courses/1')
                ->assertSee('Lessons:')
                ->assertSee('About this course:');
        });
    }
}
