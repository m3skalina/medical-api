<?php

namespace Database\Factories;

use App\Models\Point;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'point_id' => Point::factory(),
            'name' => $this->faker->name,
            'price' => $this->faker->randomFloat(0, 0, 500.),
            'is_active' => $this->faker->boolean,
        ];
    }
}
