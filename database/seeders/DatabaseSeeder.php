<?php


namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'David',
            'email' => 'david@example.com',
            'password' => bcrypt('12345678'),
            'role' => 'client',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Daniela',
            'email' => 'daiela@example.com',
            'password' => bcrypt('12345678'),
            'role' => 'delivery',
            'config' => [
                'availability' => false,
            ]
        ]);

        $this->call(EstablishmentSeeder::class);

    }
}
