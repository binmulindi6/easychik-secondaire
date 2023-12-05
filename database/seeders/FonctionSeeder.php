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
            'Comptable',
            'Enseignant',
            'Directeur',
            'Directeur de Discipline',
            'Gestionnaire',
            'Système Admin',
            'Secretaire',
            'Proviseur',
            'Ouvrier',
        ];


        foreach($fonctions as $fn){
            Fonction::create([
                'nom' => $fn
            ]);
        }
    }
}
