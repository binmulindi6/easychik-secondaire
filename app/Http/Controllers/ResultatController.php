<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\Periode;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use App\Models\EleveEvaluation;
use App\Models\Trimestre;
use Illuminate\Support\Facades\DB;
use PDO;

class ResultatController extends Controller
{
    public function periode($periode_id, $eleve_id){
        $eleve = Eleve::findOrFail($eleve_id);
        $periode = Periode::findOrFail($periode_id);
        $evs = $eleve->evaluations;
        
        $evaluations = null;
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

        $bulletin = $eleve->bulletinPeriode($periode_id);
        
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
        //dd($eleve->evaluations);

    }


    //examen
    public function examen($trimestre_id, $eleve_id){
        $eleve = Eleve::findOrFail($eleve_id);
        $trimestre = Trimestre::findOrFail($trimestre_id);
        $exs = $eleve->examens;
        
        $examens = null;
        foreach($exs as $item){
            if($item->trimestre_id == $trimestre->id){
                $examens = $exs;
                break;
            }else{
                $examens = null;
            }
        }

        $note = 0;
        $max = 0;
        $bulletin = $eleve->bulletinExamen($trimestre_id);
        //dd($bulletin);

        return view('classe.examens')
                    ->with('bulletin', $bulletin)
                    ->with('max', $max)
                    ->with('note', $note)
                    ->with('trimestre', $trimestre)
                    ->with('eleve', $eleve)
                    ->with('evaluations', $examens);
    }



    //trimestre
    public function trimestre($trimestre_id, $eleve_id){
        $eleve = Eleve::findOrFail($eleve_id);
        $trimestre = Trimestre::findOrFail($trimestre_id);
        $periodes = $trimestre->periodes;

        //fiche examen
        $examen = $eleve->bulletinExamen($trimestre_id);

        //fiche periodes
        $periode1 = $eleve->bulletinPeriode($periodes[0]->id);
        $periode2 = $eleve->bulletinPeriode($periodes[1]->id);
        
        
        //variables 
        $noteP1 = 0;
        $maxP1 = 0;
        $noteP2 = 0;
        $maxP2 = 0;
        $noteEx = 0;
        $maxEx = 0;
        $noteTri = 0;
        $maxTri = 0;
        
        if ($examen != null && !$periode1 != null && $periode2 != null) {
            if($examen->count() != $periode1->count() && $examen->count() != $periode2->count() && $periode1->count() != $periode2->count()){
                $examen = null;
                $periode1 = null;
                $periode2 = null;
            }
        }
        

        return view('classe.trimestres')
                    ->with('examen', $examen)
                    ->with('periode1', $periode1)
                    ->with('periode2', $periode2)
                    ->with('maxP1', $maxP1)
                    ->with('noteP1', $noteP1)
                    ->with('maxP2', $maxP2)
                    ->with('noteP2', $noteP2)
                    ->with('maxEx', $maxEx)
                    ->with('noteEx', $noteEx)
                    ->with('noteTri', $noteTri)
                    ->with('maxTri', $maxTri)
                    ->with('trimestre', $trimestre)
                    ->with('eleve', $eleve);
    }
}
