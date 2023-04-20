<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ProvidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $hcps = [
            'Eko Hospital', 'Reddington Hospital', 'St. Nicholas Hospital', 'Lagoon Hospital', 'First Consultant Hospital'
        ];

        for ($i = 0; $i < 5; $i++) {
            DB::table('providers')->insert([
                'code' => 'PROV-' . Str::random(8),
                'name' => $faker->company,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'email' => $faker->unique()->safeEmail,
                'location' => $faker->city,
                'bank_name' => $faker->randomElement(['Zenith Bank', 'GTBank', 'Access Bank', 'First Bank']),
                'bank_account_number' => $faker->bankAccountNumber,
                'contact_person' => $faker->name,
                'status' => $faker->randomElement(['active', 'inactive']),
                'provider_type' => $faker->randomElement(['hospital', 'clinic', 'lab']),
                'service_type' => $faker->randomElement(['general', 'specialized']),
                'tariff_name' => $faker->word,
                'password' => Hash::make('password'),
                'created_by' => 1,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
