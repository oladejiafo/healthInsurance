<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tariff;

class TariffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed the tariff table with fake data
        Tariff::factory()->count(100)->create();
    }
}
