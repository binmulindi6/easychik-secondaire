<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use App\Models\EleveEvaluation;
use Illuminate\Support\Facades\DB;

class EleveEvaluationController extends Controller
{
    private $page_name = 'Evaluation';

    public function edit($eleve_id, $evaluation_id){
        $eleve = Eleve::findOrFail($eleve_id);
        $evaluation = Evaluation::findOrFail($evaluation_id);
        $pivot = EleveEvaluation::find($eleve->id,$evaluation->id);
        
        return view('eleve.note')
                ->with('evaluation', $evaluation)
                ->with('self', $pivot)
                ->with('page_name', $this->page_name)
                ->with('eleve', $eleve);
    }

    public function update(Request $request, $id){
        $request->validate([
            'note_obtenu' => ['required','string','max:255']
        ]);

        EleveEvaluation::set($id,$request->note_obtenu);
        $x = intval($request->eleve);
        return redirect()->route('eleves.evaluations' ,[intval($request->eleve), intval($request->periode)]);
    }
}
