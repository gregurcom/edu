<?php

declare(strict_types = 1);

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegistrationTest extends DuskTestCase
{
    public function testRegistration(): void
    {
        $user = User::factory()->make([
            'password' => Hash::make('password'),
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/registration')
                ->type('name', $user->name)
                ->type('email', $user->email)
                ->type('password', 'password')
                ->type('password_confirmation', 'password')
                ->press('Register')
                ->assertPathIs('/dashboard');
        });
    }
}
