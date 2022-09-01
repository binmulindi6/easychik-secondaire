<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\Periode;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use App\Models\EleveEvaluation;
use Illuminate\Support\Facades\DB;
use PDO;

class ResultatController extends Controller
{
    public function periode($periode_id, $eleve_id){
        $eleve = Eleve::findOrFail($eleve_id);
        $periode = Periode::findOrFail($periode_id);
        $evs = $eleve->evaluations;

        foreach($evs as $item){
            if($item->periode_id == $periode->id){
                $evaluations = $evs;
                break;
            }else{
                $evaluations = null;
            }
        }
        $note = 0;
        $max = 0;
        
        /*$item = DB::table('eleve_evaluation')
                    ->where('eleve_id', '=', $eleve->id)
                    ->select(DB::raw('SUM("note_obtenu") as note'), 'eleve_id')
                    ->groupBy('id')
                    ->get();
        dd($item);*/

        $bulletin = Evaluation::where('evaluations.periode_id', '=', $periode_id)
                            ->join('eleve_evaluation', 'evaluation_id', '=', "evaluations.id")
                            ->where('eleve_evaluation.eleve_id', '=', $eleve->id)
                            ->join('cours', 'cours.id', '=', 'evaluations.cours_id')
                            ->select('cours.nom as nom',DB::raw('SUM(eleve_evaluation.note_obtenu) as note'),DB::raw('SUM(evaluations.note_max) as max'), 'cours.max_periode as total')
                            ->groupBy('cours_id')
                            ->get();
        $bulletin->isEmpty() ? $bulletin = null : "" ;
        
        //return($bulletin);

        /*->where('periode_id', '=', $periode->id)
            ->select('items.id', 'items.name', \DB::raw('count(*)'))
            ->groupBy('items.id', 'items.name')
            ->get();*/

        return view('classe.evaluations')
                    ->with('bulletin', $bulletin)
                    ->with('max', $max)
                    ->with('note', $note)
                    ->with('periode', $periode)
                    ->with('eleve', $eleve)
                    ->with('evaluations', $evaluations);




        //$interro1 = $eleve->evaluations[0];
        //return $interro1->type_evaluation->nom . " ". $interro1->cours->nom . ' ' . 'du' . " " . $interro1->date_evaluation  . 
        //"\n de l'eleve " . $eleve->nom . " qui a la note de " . $interro1->pivot->note_obtenu . "/" . $interro1->note_max;
        //$evaluations = EleveEvaluation::where('eleve_id', $eleve->id)->get();

        //dd($eleve->evaluations[1]->pivot->note_obtenu);
        dd($eleve->evaluations);

    }
}
