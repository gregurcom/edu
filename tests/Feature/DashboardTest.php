<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

final class DashboardTest extends TestCase
{
    public function test_visit_dashboard_unauthorized(): void
    {
        $response = $this->get('dashboard');

        $response->assertStatus(302);
    }

    public function test_visit_dashboard_authorized(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('dashboard');

        $response->assertStatus(200);
    }
}
