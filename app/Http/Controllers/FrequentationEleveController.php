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
    {   $page = "Frequentations/Create";
        $frequentations = Frequentation::all();
        $eleve = Eleve::findOrFail($id);
        $classes = Classe::orderBy('niveau','asc')->get();
        $annees = AnneeScolaire::all();

        return view('eleve.frequentations')
                    ->with('page_name', $page)
                    ->with('matricule', $eleve->matricule)
                    ->with('items', $frequentations)
                    ->with('classes', $classes)
                    ->with("annees",$annees);
    }

}
