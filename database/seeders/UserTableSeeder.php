<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => $faker->randomElement(['admin', 'user']),
                'last_page_visited' => $faker->url,
                'last_visit_time' =>$faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now'),
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'two_factor_confirmed_at' => now(),
                'remember_token' => Str::random(10),
                'current_team_id' => 1,
                'profile_photo_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
