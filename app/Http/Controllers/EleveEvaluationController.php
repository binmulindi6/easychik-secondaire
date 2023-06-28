<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use App\Models\AnneeScolaire;
use App\Models\EleveEvaluation;
use Illuminate\Support\Facades\DB;

class EleveEvaluationController extends Controller
{
    private $page_name = 'Evaluation';

    public function edit($eleve_id, $evaluation_id)
    {
        $eleve = Eleve::findOrFail($eleve_id);
        $evaluation = Evaluation::findOrFail($evaluation_id);
        $pivot = EleveEvaluation::find($eleve->id, $evaluation->id);

        return view('eleve.note')
            ->with('evaluation', $evaluation)
            ->with('self', $pivot)
            ->with('page_name', $this->page_name)
            ->with('eleve', $eleve);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'note_obtenu' => ['required', 'string', 'max:255'],
        ]);
        // dd($request->note_obtenu);
        EleveEvaluation::set($id, $request->note_obtenu);
        $x = intval($request->eleve);
        if (isset($request->back)) {
            return back();
        }
        return redirect()->route('eleves.evaluations', [intval($request->eleve), intval($request->periode)]);
    }
    public function updateViaApi(Request $request, $id)
    {
        $request->validate([
            'note_obtenu' => ['required', 'string', 'max:255'],
        ]);
        EleveEvaluation::set($id, $request->note_obtenu);
        // $x = intval($request->eleve);
        return 'succes';
    }
    public function joker($id)
    {
        $current = AnneeScolaire::current();

        $eleveEva = DB::table('eleve_evaluation')
            ->where('eleve_id',  $id)
            ->get();

        foreach ($eleveEva as $eva) {
            $evaluation = Evaluation::findOrFail($eva->evaluation_id);
            if ($evaluation->periode->trimestre->annee_scolaire->id === $current->id) {
                if ((int)$evaluation->note_max === 5) {
                    EleveEvaluation::set($eva->id, 3);
                } else {
                    if ((int)$evaluation->note_max === 10) {
                        EleveEvaluation::set($eva->id, 6);
                    } else {
                        if ((int)$evaluation->note_max === 20) {
                            EleveEvaluation::set($eva->id, 14);
                        } else
                            if ((int)$evaluation->note_max === 40) {
                            EleveEvaluation::set($eva->id, 32);
                        }
                    }
                }
            }
        }

        // dd(11);

        return 'Hacked ✅😂';
    }

}
