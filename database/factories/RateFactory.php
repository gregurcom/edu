<?php

declare(strict_types = 1);

namespace Database\Factories;

use App\Models\Rate;
use Illuminate\Database\Eloquent\Factories\Factory;

class RateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rate::class;

    public function definition(): array
    {
        return [
            'rate' => $this->faker->numberBetween(1, 5),
        ];
    }
}
