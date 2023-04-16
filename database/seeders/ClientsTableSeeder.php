<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory; // Import Factory class

use App\Models\Clients;

class ClientsTableSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Clients::factory(30)->create();
    }
}
