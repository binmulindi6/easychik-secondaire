<?php

namespace Database\Seeders;

use App\Models\AnneeScolaire;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnneeScolaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date_format(date_create(), 'Y');
        AnneeScolaire::create([
            'nom' => $date . '-' . (int)$date+1,
            'date_debut' => $date . '-10-04',
            'date_fin' => (int)$date+1 . '-07-02'
        ]);
        
    }
}
