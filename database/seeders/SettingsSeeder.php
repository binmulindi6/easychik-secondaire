<?php

namespace Database\Seeders;

use App\Models\Jour;
use App\Models\Heure;
use App\Models\Niveau;
use App\Models\Section;
use App\Models\Conduite;
use App\Models\MoyenPaiement;
use App\Models\TypePresence;
use App\Models\UniteArticle;
use App\Models\TypeEvaluation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $jours = [
            'LUNDI' => 1,
            'MARDI' => 2,
            'MERCREDI' => 3,
            'JEUDI' => 4,
            'VENDREDI' => 5,
            'SAMEDI' =>  6
        ];

        foreach ($jours as $index => $item) {
            Jour::create([
                "nom" => $index,
                "numerotation" => $item,
            ]);
        }

        $type_presences = [
            'PRESENT' => 'P',
            'ABSENT' => 'A',
            'MALADE' => 'M'
        ];

        foreach ($type_presences as $key => $value) {
            TypePresence::create([
                'nom' => $key,
                'abbreviation' => $value
            ]);
        }

        $type_evaluation = [
            'INTERROGATION',
            'DEVOIR'
        ];

        foreach ($type_evaluation as $item) {
            TypeEvaluation::create([
                "nom" => $item,
            ]);
        }

        $unite_articles = [
            'PIECES' => 'PCS',
            'BOITES' => 'BTS',
            'LITRES' => 'L'
        ];

        foreach ($unite_articles as $key => $value) {
            UniteArticle::create([
                'nom' => $key,
                'abbreviation' => $value
            ]);
        }

        $niveaux = [
            'PREMIER ANNEE' => 1,
            'DEUXIEME ANNEE' => 2,
            'TROISIEME ANNEE' => 3,
            'QUATRIEME ANNEE' => 4,
            'CINQUIEME ANNEE'  => 5,
            'SIXIEME ANNEE' => 6,
            'SEPTIEME ANNEE' => 7,
            'HUITIEME ANNEE' => 8,
        ];

        foreach ($niveaux as $key => $value) {
            Niveau::create([
                'nom' => $key,
                'numerotation' => $value
            ]);
        }

        $sections = [
            'EDUCATION DE BASE' => 'EB'
        ];

        foreach ($sections as $index => $value) {
            Section::create([
                'nom' => $index,
                'abbreviation' => $value
            ]);
        }

        $conduites = [
            'ASSEZ BONNE' => 'AB',
            'BONNE' => 'B',
            'EXCELLENTE' => 'E',
            'MAUVAISE' => 'M',
        ];

        foreach ($conduites as $key => $value) {
            Conduite::create([
                'nom' => $key,
                'abbreviation' => $value
            ]);
        }

        $heures = [
            '07:30:00' => '08:20:00', 
            '08:20:00' => '09:10:00', 
            '09:10:00' => '10:00:00', 
            '10:10:00' => '10:15:03', 
            '10:00:00' => '10:20:00', 
            '10:20:00' => '11:10:00', 
            '12:00:00' => '12:20:00', 
            '12:20:00' => '13:10:00', 
            '13:10:00' => '14:00:03', 
        ];

        $num = 0;
        foreach ($heures as $key => $value) {
            Heure::create([
                'debut' => $key,
                'fin' => $value,
                'numerotation' => $num
            ]);

            $num++;
        }

        $moyen_paiements = [
            'CAISSE',
            'BANQUE'
        ];

        foreach ($moyen_paiements as $value) {
            MoyenPaiement::create([
                'nom' => $value,
            ]);
        }
    }
}
