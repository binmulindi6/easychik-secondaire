<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Models\Fonction;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employer = Employer::create([
            'matricule' => 'P00/2022',
            'nom' => 'System',
            'prenom' => 'Admin',
            'date_naissance' => '2022-09-10',
            'sexe' => 'M',
            'formation' => 'unknown',
            'diplome' => 'unknown',
            'niveau_etude' => 'unknown',
        ]);

        $fonction = Fonction::where('nom', 'Admin')->first();
        $employer->fonctions()->attach($fonction);
        $employer->save();
    }
}
