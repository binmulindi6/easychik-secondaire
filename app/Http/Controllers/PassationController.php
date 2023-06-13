<?php

namespace App\Http\Controllers;

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
        $resultats = $classe->resultatsTries();

        // dd($resultats);

        return view('passation.classe')
                    ->with('page_name', 'Passations')
                    ->with('classe', $classe)
                    ->with('resultats', $resultats);
    }

}