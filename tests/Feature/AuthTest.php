<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

final class AuthTest extends TestCase
{
    public function test_login_succeed(): void
    {
        $user = User::factory()->create();

        $this->postJson(route('v1.login'), [
            'email'    => $user->email,
            'password' => '123456789',
        ])->assertOk()->assertSee('token');
    }

    public function test_login_failed(): void
    {
        $this->postJson(route('v1.login'), [
            'email'    => 'notexisting@gmail.com',
            'password' => '1234567891',
        ])->assertUnauthorized()->assertSee('Unauthorized');
    }

    public function test_login_email_validation(): void
    {
        $this->postJson(route('v1.login'), [
            'email'    => 'notexistinggmail.com',
            'password' => '1234567891',
        ])->assertUnprocessable()
            ->assertSee(__('validation.email', ['attribute' => 'email']));
    }

    public function test_login_required_validation(): void
    {
        $this->postJson(route('v1.login'), [
            'email'    => '',
            'password' => '',
        ])->assertUnprocessable()
            ->assertSee(__('validation.required', ['attribute' => 'email']))
            ->assertSee(__('validation.required', ['attribute' => 'password']));
    }

    public function test_register_a_user_succeed(): void
    {
        $user = User::factory()->make();
        $attributes = $user->getAttributes();
        $attributes['password_confirmation'] = $user->getAttributes()['password'];

        $this->postJson(route('v1.register'), $attributes)
            ->assertCreated()
            ->assertSee('token');
    }

    public function test_register_email_validation(): void
    {
        $user = User::factory()->create();

        $this->postJson(route('v1.register'), [
            'name'     => 'Test',
            'email'    => 'notexistinggmail.com',
            'password' => '1234567891',
        ])->assertUnprocessable()
            ->assertSee(__('validation.email', ['attribute' => 'email']));

        $this->postJson(route('v1.register'), [
            'name'     => 'Test',
            'email'    => $user->email,
            'password' => '123456789',
        ])->assertUnprocessable()
            ->assertSee(__('validation.unique', ['attribute' => 'email']));
    }

    public function test_register_password_validation(): void
    {
        $this->postJson(route('v1.register'), [
            'name'     => 'Test',
            'email'    => 'teshbhbbhjhbt@gmail.com',
            'password' => '123',
        ])->assertUnprocessable()
            ->assertSee(__('validation.confirmed', ['attribute' => 'password']))
            ->assertSee(__('validation.min.string', ['attribute' => 'password', 'min' => 6]));
    }

    public function test_register_required_validation(): void
    {
        $this->postJson(route('v1.register'), [
            'name'     => '',
            'email'    => '',
            'password' => '',
        ])->assertUnprocessable()
            ->assertSee(__('validation.required', ['attribute' => 'name']))
            ->assertSee(__('validation.required', ['attribute' => 'email']))
            ->assertSee(__('validation.required', ['attribute' => 'password']));
    }
}
