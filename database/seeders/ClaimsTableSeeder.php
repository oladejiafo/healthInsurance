<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Claims;

class ClaimsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        
        for ($i = 0; $i < 50; $i++) {
            $claim = new Claims([
                'hcp_code' => $faker->unique()->numberBetween(1000, 9999),
                'hcp_name' => $faker->company,
                'enrollee_code' => $faker->unique()->numberBetween(1000, 9999),
                'enrollee_name' => $faker->name,
                'enrollee_phone' => $faker->phoneNumber,
                'enrollee_address' => $faker->address,
                'pay_date' => $faker->dateTimeThisMonth(),
                'authorization_code' => $faker->unique()->numberBetween(1000, 9999),
                'claim_amount' => $faker->randomFloat(2, 100, 1000),
                'paid_amount' => $faker->randomFloat(2, 50, 500),
                'deduction_amount' => $faker->randomFloat(2, 0, 50),
                'deduction_reason' => $faker->text,
                'status' => $faker->randomElement(['Pending', 'Approved', 'Rejected','Vetted', 'Paid']),
                'diagnosis' => $faker->text,
                'diagnosis2' => $faker->text,
                'diagnosis3' => $faker->text,
                'diagnosis4' => $faker->text,
                'treatment' => $faker->text,
                'words' => $faker->text,
                'month' => $faker->numberBetween(1, 12),
                'year' => $faker->numberBetween(2010, 2023),
                'location' => $faker->city,
                'sex' => $faker->randomElement(['Male', 'Female']),
                'age' => $faker->numberBetween(18, 65),
                'company' => $faker->company,
                'requested_date' => $faker->dateTimeThisMonth(),
                'approved_date' => $faker->dateTimeThisMonth(),
                'claim_date' => $faker->dateTimeThisMonth(),
                'attendance_date' => $faker->dateTimeThisMonth(),
                'admission_date' => $faker->dateTimeThisMonth(),
                'discharge_date' => $faker->dateTimeThisMonth(),
                'entry_date' => $faker->dateTimeThisMonth(),
                'remarks' => $faker->text,
                'created_by' => $faker->name,
            ]);
            
            $claim->save();
        }
    }
}

