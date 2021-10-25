<?php

declare(strict_types = 1);

namespace Tests\Feature;

use Tests\TestCase;

class LocaleTest extends TestCase
{
    public function test_locale_ru(): void
    {
        $response = $this->withSession(['locale' => 'ru'])->get('/');

        $response->assertSee('Курсы');
    }

    public function test_locale_en(): void
    {
        $response = $this->withSession(['locale' => 'en'])->get('/');

        $response->assertSee('Courses');
    }
}
