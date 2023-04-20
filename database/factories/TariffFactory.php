<?php

namespace Database\Factories;

use App\Models\Tariff;
use Illuminate\Database\Eloquent\Factories\Factory;

class TariffFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tariff::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['Drug', 'Hospital Service', 'Procedure', 'Laboratory Test']),
            'category' => $this->faker->word(),
            'name' => $this->faker->sentence(),
            'sub_category' => $this->faker->word(),
            'price' => $this->faker->numberBetween(100, 5000),
            'provider' => $this->faker->company(),
        ];
    }
}
