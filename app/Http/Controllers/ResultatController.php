<?php

namespace App\Http\Controllers;

use App\Models\AnneeScolaire;
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
    public $page_name = 'Resultat';

    //bulletin des resultats de la Peride
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

        // return view('classe.resultats')
        return view('eleve.resultats-periode')
                    ->with('bulletin', $bulletin)
                    ->with('max', $max)
                    ->with('note', $note)
                    ->with('periode', $periode)
                    ->with('eleve', $eleve)
                    ->with('page_name', $this->page_name . ' / Periode')
                    ->with('evaluations', $evaluations);




        //$interro1 = $eleve->evaluations[0];
        //return $interro1->type_evaluation->nom . " ". $interro1->cours->nom . ' ' . 'du' . " " . $interro1->date_evaluation  . 
        //"\n de l'eleve " . $eleve->nom . " qui a la note de " . $interro1->pivot->note_obtenu . "/" . $interro1->note_max;
        //$evaluations = EleveEvaluation::where('eleve_id', $eleve->id)->get();

        //dd($eleve->evaluations[1]->pivot->note_obtenu);
        //dd($eleve->evaluations);

    }


    //bulletin des resultats des examens du Trimestre
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

        // return view('classe.resultats-examens')
        return view('eleve.resultats-examen')
                    ->with('bulletin', $bulletin)
                    ->with('max', $max)
                    ->with('note', $note)
                    ->with('trimestre', $trimestre)
                    ->with('eleve', $eleve)
                    ->with('page_name', $this->page_name . ' / Trimestre')
                    ->with('evaluations', $examens);
    }



    //bulletin des resultats du Trimestre
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
        
        if ($examen != null && $periode1 != null && $periode2 != null) {
            if($examen->count() != $periode1->count() && $examen->count() != $periode2->count() && $periode1->count() != $periode2->count()){
                $examen = null;
                $periode1 = null;
                $periode2 = null;
            }
        }

        //dd($examen, $periode1 ,$periode2);
        

        // return view('classe.trimestres')
        return view('eleve.resultats-trimestres')
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
                    ->with('page_name', 'Bulletin / Trimestre')
                    ->with('eleve', $eleve);
    }





    //bulletin annee scolaire
    public function bulletin($annee_scolaire_id, $eleve_id){

        $eleve = Eleve::find($eleve_id);
        // dd($eleve);
        if($eleve === null || $eleve->classe(true) === null){
            abort(404);
        }
        
        //dd($eleve->classe(true));
        
        $annee = AnneeScolaire::findOrFail($annee_scolaire_id);
        $trimestres = $annee->trimestres;
        if($trimestres->count() != 3){
            abort(404);
        }
        
        foreach ($trimestres as $trimestre) {
            if($trimestre->periodes->count() != 2){
                abort(404);
            }
            if($trimestre->examens->count() <= 0){
                echo(0);
                dd($trimestre->examens->count());
                abort(404);
            }
            
        }
        //trimestres
        $trimestre1 = $trimestres[0];
        $trimestre2 = $trimestres[1];
        $trimestre3 = $trimestres[2];
        
        //periodes
        $p1 = $trimestre1->periodes[0];
        $p2 = $trimestre1->periodes[1];
        $p3 = $trimestre2->periodes[0];
        $p4 = $trimestre2->periodes[1];
        $p5 = $trimestre3->periodes[0];
        $p6 = $trimestre3->periodes[1];
        
        //fiches par Trimestres
        $examenT1 = $eleve->bulletinExamen($trimestre1->id);
        $examenT2 = $eleve->bulletinExamen($trimestre1->id);
        $examenT3 = $eleve->bulletinExamen($trimestre1->id);
        
        //fiches par periodes
        $periode1 = $eleve->bulletinPeriode($p1->id);
        $periode2 = $eleve->bulletinPeriode($p2->id);
        $periode3 = $eleve->bulletinPeriode($p3->id);
        $periode4 = $eleve->bulletinPeriode($p4->id);
        $periode5 = $eleve->bulletinPeriode($p5->id);
        $periode6 = $eleve->bulletinPeriode($p6->id);
        
        //dd("here we go again...");
        
        //variables
        ///Trimestre 1
        $noteP1 = 0;
        $maxP1 = 0;
        $noteP2 = 0;
        $maxP2 = 0;
        $noteExT1 = 0;
        $maxExT1 = 0;
        $noteTri1 = 0;
        $maxTri1 = 0;

        ///Trimestre 2
        $noteP3 = 0;
        $maxP3 = 0;
        $noteP4 = 0;
        $maxP4 = 0;
        $noteExT2 = 0;
        $maxExT2 = 0;
        $noteTri2 = 0;
        $maxTri2 = 0;

        ///Trimestre 1
        $noteP5 = 0;
        $maxP5 = 0;
        $noteP6 = 0;
        $maxP6 = 0;
        $noteExT3 = 0;
        $maxExT3 = 0;
        $noteTri3 = 0;
        $maxTri3 = 0;
        
        if ($examenT1 != null && $periode1 != null && $periode2 != null) {
            //dd($examenT1->count(), $periode1->count() , $examenT1->count() , $periode2->count() , $periode1->count() , $periode2->count());
            if($examenT1->count() != $periode1->count() || $examenT1->count() != $periode2->count() || $periode1->count() != $periode2->count()){
                dd(101);
                $examenT1 = null;
                $periode1 = null;
                $periode2 = null;
            }
            //dd(102);
        }
        

        // return view('classe.bulletin')
        return view('eleve.bulletin')
                    ->with('examenT1', $examenT1)
                    ->with('periode1', $periode1)
                    ->with('periode2', $periode2)
                    ->with('maxP1', $maxP1)
                    ->with('noteP1', $noteP1)
                    ->with('maxP2', $maxP2)
                    ->with('noteP2', $noteP2)
                    ->with('maxExT1', $maxExT1)
                    ->with('noteExT1', $noteExT1)
                    ->with('noteTri1', $noteTri1)
                    ->with('maxTri1', $maxTri1)


                    ->with('examenT2', $examenT2)
                    ->with('periode3', $periode3)
                    ->with('periode4', $periode4)
                    ->with('maxP3', $maxP3)
                    ->with('noteP3', $noteP3)
                    ->with('maxP4', $maxP4)
                    ->with('noteP4', $noteP4)
                    ->with('maxExT2', $maxExT2)
                    ->with('noteExT2', $noteExT2)
                    ->with('noteTri2', $noteTri2)
                    ->with('maxTri2', $maxTri2)


                    ->with('examenT3', $examenT3)
                    ->with('periode5', $periode5)
                    ->with('periode6', $periode6)
                    ->with('maxP5', $maxP5)
                    ->with('noteP5', $noteP5)
                    ->with('maxP6', $maxP6)
                    ->with('noteP6', $noteP6)
                    ->with('maxExT3', $maxExT3)
                    ->with('noteExT3', $noteExT3)
                    ->with('noteTri3', $noteTri3)
                    ->with('maxTri3', $maxTri3)


                    ->with('page_name', 'Bulletin / Scolaire')


                    ->with('annee_scolaire', $annee)
                    ->with('trimestre', $trimestre)
                    ->with('eleve', $eleve);
    }
}
