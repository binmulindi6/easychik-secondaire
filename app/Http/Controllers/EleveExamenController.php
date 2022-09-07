<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\EleveExamen;
use App\Models\Examen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EleveExamenController extends Controller
{
    public function edit($eleve_id, $examen_id){
        $eleve = Eleve::findOrFail($eleve_id);
        $examen = Examen::find($examen_id);
        $pivot = EleveExamen::find($eleve->id,$examen->id);
        
        return view('eleve.note')
                ->with('self', $pivot)
                ->with('examen', $examen)
                ->with('eleve', $eleve);
    }

    public function update(Request $request,$id){
        //dd($id);
        $request->validate([
            'note_obtenu' => ['required','string','max:255']
        ]);

        EleveExamen::set($id,$request->note_obtenu);
        $x = intval($request->eleve);
        return redirect()->route('eleves.examens' ,[intval($request->eleve), intval($request->trimestre)]);


    }
}
