<?php

namespace Database\Seeders;

use App\Models\Fonction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FonctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fonctions = [
            'Enseignant',
            'Secretaire',
            'Comptable',
            'Proviseur',
            'Directeur',
            'Directeur de Discipline',
            'Gestionnaire',
        ];


        foreach($fonctions as $fn){
            Fonction::create([
                'nom' => $fn
            ]);
        }
    }
}
