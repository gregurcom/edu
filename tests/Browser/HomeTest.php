<?php

declare(strict_types = 1);

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class HomeTest extends DuskTestCase
{
    public function testHomeGuest(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Mentor')
                    ->assertSee('Courses');
        });
    }

    public function testHomeAuth(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::first())
                ->visit('/')
                ->assertSee('Mentor')
                ->assertSee('Courses')
                ->assertSee('Subscriptions')
                ->assertSee(User::first()->name);
        });
    }
}
