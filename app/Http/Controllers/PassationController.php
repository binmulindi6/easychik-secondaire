<?php

namespace App\Http\Controllers;

use App\Models\AnneeScolaire;
use App\Models\Classe;
use Illuminate\Support\Facades\Auth;

class PassationController extends Controller
{
    
    public function __construct()
    {
    //  if (!Auth::user()->isSecretaire()) {
        // abort(404);
    //  }   
    }

    public function index()
    {
        $classes = Classe::orderBy('niveau_id','asc')->get();
        $datas = [];

        foreach($classes as $classe){
            $datas[] = $classe->resultatsTries();
        }

        return view('passation.index')
                    ->with('page_name', 'Passations')
                    ->with('classes', $datas);
    }

    public function classe($id)
    {
        $classe = Classe::findOrFail($id);
        // dd(csrf_token());
        $resultats = $classe->resultatsTries();
        $classeNiveauSup = $classe->classesDeNiveauSuperieur();
        $classeMemeNiveau = $classe->classesDeMemeNiveau();
        $annee = AnneeScolaire::next();

        // dd($annee);

        return view('passation.classe')
                    ->with('page_name', 'Passations')
                    ->with('classe', $classe)
                    ->with('annee', $annee)
                    ->with('classeMemeNiveau', $classeMemeNiveau)
                    ->with('classeNiveauSup', $classeNiveauSup)
                    ->with('resultats', $resultats);
    }

    // public function () {
        
    // }

}