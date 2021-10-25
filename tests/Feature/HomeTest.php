<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Tests\TestCase;

class HomeTest extends TestCase
{
    public function test_home(): void
    {
        $response = $this->get('/');

        $response->assertOk()->assertSee('Mentor');
    }
}
