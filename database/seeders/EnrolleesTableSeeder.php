<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class EnrolleesTableSeeder extends Seeder
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
            ['id' => 1, 'name' => 'Eko Hospital'], 
            ['id' => 2, 'name' => 'Reddington Hospital'], 
            ['id' => 3, 'name' => 'St. Nicholas Hospital'], 
            ['id' => 4, 'name' => 'Lagoon Hospital'], 
            ['id' => 5, 'name' => 'First Consultant Hospital']
        ];

        for ($i = 0; $i < 100; $i++) {
            $hcp = $faker->randomElement($hcps);

            DB::table('enrollees')->insert([
                'code' => 'ENR-' . Str::random(8),
                'surname' => $faker->lastName,
                'first_name' => $faker->firstName,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'email' => $faker->unique()->safeEmail,
                'hcp_id' => $hcp['id'],
                'sex' => $faker->randomElement(['M', 'F']),
                'age' => $faker->numberBetween(18, 65),
                'dob' => $faker->date(),
                'relationship' => $faker->randomElement(['self', 'spouse', 'child']),
                'enrollee_category' => $faker->randomElement(['individual', 'family']),
                'plan' => $faker->randomElement(['gold', 'silver', 'bronze']),
                'religion' => $faker->randomElement(['Christianity', 'Islam', 'Traditional']),
                'marital_status' => $faker->randomElement(['single', 'married']),
                'start_date' => $faker->date(),
                'end_date' => $faker->date(),
                'suspended_date' => null,
                'suspension_reason' => null,
                'status' => 'active',
                'occupation' => $faker->jobTitle,
                'company_name' => $faker->company,
                'company_phone' => $faker->phoneNumber,
                'company_address' => $faker->address,
                'company_id_number' => Str::random(8),
                'designation' => $faker->jobTitle,
                'next_of_kin' => $faker->name,
                'nk_relationship' => $faker->randomElement(['parent', 'sibling', 'friend']),
                'nk_phone' => $faker->phoneNumber,
                'nk_email' => $faker->unique()->safeEmail,
                'nk_address' => $faker->address,
                'blood_group' => $faker->randomElement(['A+', 'B+', 'O+', 'AB+', 'A-', 'B-', 'O-', 'AB-']),
                'genotype' => $faker->randomElement(['AA', 'AS', 'SS', 'AC']),
                'have_diabetes' => $faker->boolean(),
                'have_epilepsy' => $faker->boolean(),
                'have_hypertension' => $faker->boolean(),
                'have_sickle_cell' => $faker->boolean(),

                'have_asthma' => $faker->boolean(),
                'have_obesity' => $faker->boolean(),
                'have_allegies' => $faker->boolean(),
                'have_ulcer' => $faker->boolean(),
                'have_mental' => $faker->boolean(),
                'had_surgery' => $faker->boolean(),
                'been_hospitalized' => $faker->boolean(),
                'have_cancer' => $faker->boolean(),
                'have_heart_issues' => $faker->boolean(),
                'have_ecg' => $faker->boolean(),
                'have_hiv' => $faker->boolean(),
                'have_urinary_disease' => $faker->boolean(),
                'have_blood_disease' => $faker->boolean(),
                'password' => Hash::make('password'),
                'created_by' => 1,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
