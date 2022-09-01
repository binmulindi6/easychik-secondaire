<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\Classe;
use Illuminate\Http\Request;
use App\Models\AnneeScolaire;
use App\Models\Frequentation;

class FrequentationEleveController extends Controller
{
    //link directly an eleve 
    public static function create($id)
    {
        $frequentations = Frequentation::all();
        $eleve = Eleve::findOrFail($id);
        $classes = Classe::all();
        $annees = AnneeScolaire::all();

        return view('eleve.frequentations')
                    ->with('matricule', $eleve->matricule)
                    ->with('items', $frequentations)
                    ->with('classes', $classes)
                    ->with("annees",$annees);
    }

}
