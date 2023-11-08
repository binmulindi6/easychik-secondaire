<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\Classe;
use Illuminate\Http\Request;
use App\Models\AnneeScolaire;
use App\Models\Frequentation;
use Illuminate\Support\Facades\Auth;

class FrequentationEleveController extends Controller
{
    //link directly an eleve 

    public static function create($id)
    {   $page = "Frequentations/Create";
        $frequentations = Frequentation::all();
        $eleve = Eleve::findOrFail($id);
        $classes = Classe::orderBy('niveau_id','asc')->get();
        $annees = AnneeScolaire::orderBy('nom')->get();
        $current = AnneeScolaire::current();

        // dd($classes);

        if(Auth::user()->isEnseignant()){
            $classe = Auth::user()->classe;

            return view('eleve.frequentations')
                    ->with('page_name', $page)
                    ->with('matricule', $eleve->matricule)
                    ->with('items', $frequentations)
                    ->with('classe', $classe)
                    ->with('classes', $classes)
                    ->with('current', $current)
                    ->with("annees",$annees);
        }

        return view('eleve.frequentations')
                    ->with('page_name', $page)
                    ->with('matricule', $eleve->matricule)
                    ->with('items', $frequentations)
                    ->with('classes', $classes)
                    ->with('current', $current)
                    ->with("annees",$annees);
                    
    }

}
