<?php

namespace Database\Factories;

use App\Models\Point;
use App\Models\Sale;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sale::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'point_id' => Point::factory(),
            'service_id' => Service::factory(),
            'date' => $this->faker->date(),
            'amount' => $this->faker->randomFloat(0, 0, 3000.),
        ];
    }
}
