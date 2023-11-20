<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\Logfile;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use App\Models\AnneeScolaire;
use App\Models\TypeEvaluation;
use App\Models\EleveEvaluation;
use App\Models\EleveExamen;
use App\Models\Examen;
use App\Models\Periode;
use App\Models\Trimestre;
use Illuminate\Support\Facades\DB;

class EleveEvaluationController extends Controller
{
    private $page_name = 'Evaluation';

    public function edit($eleve_id, $evaluation_id)
    {
        $eleve = Eleve::findOrFail($eleve_id);
        $evaluation = Evaluation::findOrFail($evaluation_id);
        $pivot = EleveEvaluation::find($eleve->id, $evaluation->id);

        // dd(10);

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
        if (AnneeScolaire::current()->isActive()) {

            $ev = EleveEvaluation::set($id, $request->note_obtenu);
            $x = intval($request->eleve);

            Logfile::updateLog(
                'eleve_Evaluation',
                $id
            );
            if (isset($request->back)) {
                return back();
            }
            return redirect()->route('eleves.evaluations', [intval($request->eleve), intval($request->periode)]);
        }
        return redirect()->back()->withErrors([
            "Vous ne pouvez pas effectuer des operations sur les Archives",
        ])->onlyInput('nom');
    }
    public function updateViaApi(Request $request, $id)
    {
        $request->validate([
            'note_obtenu' => ['required', 'string', 'max:255'],
        ]);
        if (AnneeScolaire::current()->isActive()) {
            EleveEvaluation::set($id, $request->note_obtenu);
            Logfile::updateLog(
                'eleve_Evaluation',
                $id
            );
            return 'succes';
        }
        return abort(500);
    }
    public function joker($id)
    {
        $current = AnneeScolaire::current();
        $eleve = Eleve::findOrFail($id);

        ///ceation
        $classe = $eleve->classe();
        $cours = $classe->cours();
        $periodes = Trimestre::currents();
        $type_evaluation = TypeEvaluation::findOrFail(1);
        $eleves = $classe->eleves();
        $evaluations = $classe->examens;
        // dd($evaluations);
        // dd($classe, $cours, $periodes, $type_evaluation);

        foreach ($evaluations as $evaluation) {
        // foreach ($periodes as $periode) {
        //     foreach ($cours as $item) {
        //         $evaluation = Examen::create([
        //             'note_max' => $item->max_examen,
        //             'date_examen' => date('Y-m-d'),
        //         ]);

        //         $evaluation->cours()->associate($item);
        //         $evaluation->classe()->associate($classe);
        //         $evaluation->trimestre()->associate($periode);
        //         // $evaluation->type_evaluation()->associate($type_evaluation);

        //         $evaluation->save();

        //         // dd($eleves[0]->id);

                // foreach ($eleves as $eleve) {
                if ($eleve->evaluations() !== null) {
                    $currentEleve = Eleve::find($eleve->id);
                    // dd($currentEleve);
                    if ($currentEleve !== null) {
                        $currentEleve->examens()->attach($evaluation);
                        $currentEleve->save();

                        EleveExamen::set($evaluation->id, ((int)$evaluation->note_max * 6 / 10));
                    }
            //     }
            // }
        }
        }
        // }
        // foreach ($eleveEva as $eva) {
        //     $evaluation = Evaluation::findOrFail($eva->evaluation_id);
        //     if ($evaluation->periode->trimestre->annee_scolaire->id === $current->id) {
        //         if ((int)$evaluation->note_max === 5) {
        //             EleveEvaluation::set($eva->id, 3);
        //         } else {
        //             if ((int)$evaluation->note_max === 10) {
        //                 EleveEvaluation::set($eva->id, 6);
        //             } else {
        //                 if ((int)$evaluation->note_max === 20) {
        //                     EleveEvaluation::set($eva->id, 14);
        //                 } else
        //                     if ((int)$evaluation->note_max === 40) {
        //                     EleveEvaluation::set($eva->id, 32);
        //                 }
        //             }
        //         }
        //     }
        // }

        // dd(11);

        return 'Hacked ✅😂';
    }
}
