<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\EleveExamen;
use App\Models\Examen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EleveExamenController extends Controller
{
    private $page_name = 'Examens';


    public function edit($eleve_id, $examen_id){
        $eleve = Eleve::findOrFail($eleve_id);
        $examen = Examen::find($examen_id);
        $pivot = EleveExamen::find($eleve->id,$examen->id);
        
        return view('eleve.note')
                ->with('self', $pivot)
                ->with('examen', $examen)
                ->with('page_name', $this->page_name)
                ->with('eleve', $eleve);
    }

    public function update(Request $request,$id){
        //dd($id);
        $request->validate([
            'note_obtenu' => ['required','string','max:255']
        ]);
        // dd($request->note_obtenu);
        EleveExamen::set($id,$request->note_obtenu);
        $x = intval($request->eleve);

        if(isset($request->back)){
            return back();
        }
        return redirect()->route('eleves.examens' ,[intval($request->eleve), intval($request->trimestre)]);


    }
    public function updateViaApi(Request $request,$id){
        //dd($id);
        $request->validate([
            'note_obtenu' => ['required','string','max:255']
        ]);
        // dd($request->note_obtenu);
        EleveExamen::set($id,$request->note_obtenu);
        return 'succes';


    }
}
