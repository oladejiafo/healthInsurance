<?php

namespace Database\Factories;

use App\Models\Clients;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientsFactory extends Factory
{
    protected $model = Clients::class;

    public function definition()
    {
        return [
            'code' => $this->faker->unique()->numberBetween(1000, 9999),
            'name' => $this->faker->company,
            'address' => $this->faker->address,
            'location' => $this->faker->city,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'contact_person' => $this->faker->name,
            'contact_phone' => $this->faker->phoneNumber,
            'status' => $this->faker->randomElement(['active', 'suspended', 'inactive']),
            'date_joined' => $this->faker->dateTimeBetween('-10 years', 'now'),
            'date_exited' => $this->faker->optional()->dateTimeBetween('-10 years', 'now'),
            'date_suspended' => $this->faker->optional()->dateTimeBetween('-10 years', 'now'),
            'created_by' => $this->faker->name,
        ];
    }
}
