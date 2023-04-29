<?php

namespace Database\Seeders;

use App\Models\Establishment;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstablishmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Establishment::factory()
        ->count(50)
        ->create();
    }
}
