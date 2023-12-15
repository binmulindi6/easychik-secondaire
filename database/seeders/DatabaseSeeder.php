<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Employer;
use App\Models\Fonction;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AnneeScolaireSeeder::class,
            FonctionSeeder::class,
            EmployerSeeder::class,
            UserSeeder::class,
            SettingsSeeder::class
        ]);
    }
}
