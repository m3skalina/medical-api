<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\Point;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'point_id' => Point::factory(),
            'invoice_code' => $this->faker->random_int(0, 100),
            'date' => $this->faker->date(),
            'amount' => $this->faker->randomFloat(0, 0, 9999999999.),
        ];
    }
}
