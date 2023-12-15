<?php

namespace App\Http\Controllers;

use PDO;
use App\Models\Ecole;
use App\Models\Eleve;
use App\Models\Logfile;
use App\Models\Periode;
use App\Models\Conduite;
use App\Models\Resultat;
use App\Models\Trimestre;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use App\Models\AnneeScolaire;
use App\Models\EleveConduite;
use App\Models\Frequentation;
use App\Models\EleveEvaluation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ResultatController extends Controller
{
    public $page_name = 'Resultat';

    //bulletin des resultats de la Peride
    public function periode($periode_id, $eleve_id)
    {
        $eleve = Eleve::findOrFail($eleve_id);
        $ecole = Ecole::first();

        $periode = Periode::findOrFail($periode_id);
        $evs = $eleve->evaluations;
        // dd('dd');
        $conduite = EleveConduite::where('eleve_id', '=', $eleve->id)
            ->where('periode_id', '=', $periode->id)
            ->first();

        $resultat = Frequentation::findByEleveAndAnneeScolaire($eleve->id, $periode->trimestre->annee_scolaire->id)->resultat;

        $data = $this->checkPeriode($resultat, $periode);

        // dd($data);  

        $evaluations = null;
        foreach ($evs as $item) {
            if ($item->periode_id == $periode->id) {
                $evaluations = $evs;
                break;
            } else {
                $evaluations = null;
            }
        }
        $note = 0;
        $max = 0;

        $bulletin = $eleve->bulletinPeriode($periode_id);
        // dd($bulletin);

        return view('eleve.resultats-periode')
            ->with('ecole', $ecole)

            ->with('bulletin', $bulletin)
            ->with('max', $max)
            ->with('note', $note)
            ->with('periode', $periode)
            ->with('eleve', $eleve)
            ->with('page_name', 'Bulletin ' . $periode->nom . ' ' . $eleve->nomComplet() . ' ' . $eleve->classe(false))
            ->with('conduite', $conduite)
            ->with('resultat', $data)
            ->with('evaluations', $evaluations);
    }


    //bulletin des resultats des examens du Trimestre
    public function examen($trimestre_id, $eleve_id)
    {
        $ecole = Ecole::first();

        $eleve = Eleve::findOrFail($eleve_id);
        $trimestre = Trimestre::findOrFail($trimestre_id);
        $exs = $eleve->examens;

        $examens = null;
        foreach ($exs as $item) {
            if ($item->trimestre_id == $trimestre->id) {
                $examens = $exs;
                break;
            } else {
                $examens = null;
            }
        }

        $note = 0;
        $max = 0;
        $bulletin = $eleve->bulletinExamen($trimestre_id);
        // dd($bulletin);

        // return view('classe.resultats-examens')
        return view('eleve.resultats-examen')
            ->with('ecole', $ecole)

            ->with('bulletin', $bulletin)
            ->with('max', $max)
            ->with('note', $note)
            ->with('trimestre', $trimestre)
            ->with('eleve', $eleve)
            ->with('page_name', $this->page_name . ' / Trimestre')
            ->with('evaluations', $examens);
    }



    //bulletin des resultats du Trimestre
    public function trimestre($trimestre_id, $eleve_id)
    {
        $ecole = Ecole::first();

        $eleve = Eleve::findOrFail($eleve_id);
        $trimestre = Trimestre::findOrFail($trimestre_id);
        $periodes = $trimestre->periodes;
        //fiche examen
        $examen = $eleve->bulletinExamen($trimestre_id);
        // dd($examen);

        //fiche periodes
        if (count($periodes) === 2) {
            $periode1 = $eleve->bulletinPeriode($periodes[0]->id);
            $periode2 = $eleve->bulletinPeriode($periodes[1]->id);

            //consuites
            $conduite1 = EleveConduite::where('eleve_id', '=', $eleve->id)
                ->where('periode_id', '=', $periodes[0]->id)
                ->first();
            $conduite2 = EleveConduite::where('eleve_id', '=', $eleve->id)
                ->where('periode_id', '=', $periodes[1]->id)
                ->first();
            // dd($conduite1);

            ///resultat
            $resultat = Frequentation::findByEleveAndAnneeScolaire($eleve->id, $trimestre->annee_scolaire->id)->resultat;
            // dd($resultat);

            $data1 = $this->checkPeriode($resultat, $periodes[0]);
            $data2 = $this->checkPeriode($resultat, $periodes[1]);
            $dataTri = $this->checkTrimestre($resultat, $trimestre);
        } else {
            $periode1 = null;
            $periode2 = null;

            $conduite1 = null;
            $conduite2 = null;

            $resultat = null;
            // dd($resultat);

            $data1 = null;
            $data2 = null;
            $dataTri = null;
        }
        // dd($periode2);




        // dd($dataTri);
        // $data = $this->checkPeriode($resultat, $periode);

        //variables 
        $noteP1 = 0;
        $maxP1 = 0;
        $noteP2 = 0;
        $maxP2 = 0;
        $noteEx = 0;
        $maxEx = 0;
        $noteTri = 0;
        $maxTri = 0;

        // dd($examen, $periode1 ,$periode2);
        // dd($examen,$periode1,$periode2);
        if ($examen != null && $periode1 != null && $periode2 != null) {
            // dd($examen->count() != $periode1->count() || $examen->count() != $periode2->count() || $periode1->count() != $periode2->count());
            if ($examen->count() != $periode1->count() || $examen->count() != $periode2->count() || $periode1->count() != $periode2->count()) {
                $examen = null;
                $periode1 = null;
                $periode2 = null;
            }
        }

        // dd(($resultat1 > 1 || $resultat2 > 1 || $resultatTrim > 1 || $resultatExam > 1));
        // dd($data1,$data2);


        // return view('classe.trimestres')
        return view('eleve.resultats-trimestres')
            ->with('ecole', $ecole)

            ->with('p1', count($periodes) == 2 ? $periodes[0]->id : null)
            ->with('p2', count($periodes) == 2 ? $periodes[1]->id : null)
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
            ->with('page_name', 'Bulletin'  . " " . $trimestre->nom . ' ' . $eleve->nomComplet() . ' ' . $eleve->classe(false))
            ->with('conduite1', $conduite1)
            ->with('conduite2', $conduite2)
            ->with('resultat1', $data1)
            ->with('resultat2', $data2)
            ->with('resultatExam', $dataTri ? $dataTri[0] : null)
            ->with('resultatTrim', $dataTri ? $dataTri[1] : null)
            ->with('eleve', $eleve);
    }





    //bulletin annee scolaire
    public function bulletin($annee_scolaire_id, $eleve_id)
    {

        $eleve = Eleve::find($eleve_id);
        $ecole = Ecole::first();
        // dd($eleve);
        if ($eleve === null || $eleve->classe(true) === null) {
            // abort(404);
        }

        //dd($eleve->classe(true));

        $annee = AnneeScolaire::findOrFail($annee_scolaire_id);

        // dd($annee->trimestre3()->periode5());

        $trimestres = $annee->trimestres;
        if ($trimestres->count() != 2) {
            $examenT1 = null;
            $periode1 = null;
            $periode2 = null;
        }

        foreach ($trimestres as $trimestre) {
            if ($trimestre->periodes->count() != 2) {
                $examenT1 = null;
                $periode1 = null;
                $periode2 = null;
            }
            if ($trimestre->examens->count() <= 0) {
                // echo(0);
                // dd($trimestre->examens->count());
                $examenT1 = null;
                $periode1 = null;
                $periode2 = null;
            }
        }
        //trimestres
        $trimestre1 = $annee->trimestre1();
        $trimestre2 = $annee->trimestre2();
        // $trimestre3 = $annee->trimestre3();

        // dd($trimestre1->periodes);

        //periodes
        $p1 = count($trimestre1->periodes) == 2 ? $trimestre1->periodes[0] : null;
        $p2 = count($trimestre1->periodes) == 2 ? $trimestre1->periodes[1] : null;
        $p3 = count($trimestre2->periodes) == 2 ? $trimestre2->periodes[0] : null;
        $p4 = count($trimestre2->periodes) == 2 ? $trimestre2->periodes[1] : null;
        // $p5 = $trimestre3->periodes[0];
        // $p6 = $trimestre3->periodes[1];

        //fiches par Trimestres
        $examenT1 = $eleve->bulletinExamen($trimestre1->id);
        $examenT2 = $eleve->bulletinExamen($trimestre2->id);
        // dd($examenT2);
        // $examenT3 = $eleve->bulletinExamen($trimestre3->id);

        //fiches par periodes
        $periode1 = $p1 ? $eleve->bulletinPeriode($p1->id) : null;
        $periode2 = $p2 ? $eleve->bulletinPeriode($p2->id) : null;
        $periode3 = $p3 ? $eleve->bulletinPeriode($p3->id) : null;
        $periode4 = $p4 ? $eleve->bulletinPeriode($p4->id) : null;
        // $periode5 = $eleve->bulletinPeriode($p5->id);
        // $periode6 = $eleve->bulletinPeriode($p6->id);

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

        // ///Trimestre 1
        // $noteP5 = 0;
        // $maxP5 = 0;
        // $noteP6 = 0;
        // $maxP6 = 0;
        // $noteExT3 = 0;
        // $maxExT3 = 0;
        // $noteTri3 = 0;
        // $maxTri3 = 0;


        //conduites
        if ($p1 !== null && $p2 !== null && $p3 !== null && $p4 !== null) {
            $cond1 = EleveConduite::where('eleve_id', '=', $eleve->id)
                ->where('periode_id', '=', $p1->id)
                ->first();
            $cond2 = EleveConduite::where('eleve_id', '=', $eleve->id)
                ->where('periode_id', '=', $p2->id)
                ->first();
            $cond3 = EleveConduite::where('eleve_id', '=', $eleve->id)
                ->where('periode_id', '=', $p3->id)
                ->first();
            $cond4 = EleveConduite::where('eleve_id', '=', $eleve->id)
                ->where('periode_id', '=', $p4->id)
                ->first();
        } else {
            $cond1 = null;
            $cond2 = null;
            $cond3 = null;
            $cond4 = null;
        }
        // $cond5 = EleveConduite::where('eleve_id', '=', $eleve->id)
        //     ->where('periode_id', '=', $p5->id)
        //     ->first();
        // $cond6 = EleveConduite::where('eleve_id', '=', $eleve->id)
        //     ->where('periode_id', '=', $p6->id)
        //     ->first();

        ///RESULTATA
        $resultat = Frequentation::findByEleveAndAnneeScolaire($eleve->id, $annee->id)->resultat;



        // dd($resultat);

        if ($examenT1 != null && $periode1 != null && $periode2 != null && $examenT2 != null && $periode3 != null && $periode4 != null) {
            // dd($examenT1->count(), $periode1->count() , $examenT2->count() , $periode2->count() , $periode1->count() , $periode2->count());
            if ($examenT1->count() != $periode1->count() || $examenT1->count() != $periode2->count() || $periode1->count() != $periode2->count() || $examenT2->count() != $periode3->count() || $examenT2->count() != $periode4->count() || $periode3->count() != $periode4->count()) {
                // dd(101);
                $examenT1 = null;
                $periode1 = null;
                $periode2 = null;
            }
            //dd(102);
        }

        $eleves = Eleve::all();
        if (Auth::user()->isEnseignant()) {
            if (Auth::user()->classe() !== null) {
                $eleves = Auth::user()->classe->eleves();
                // dd($eleves);
            }
        }
        ///joker
        $index = 0;
        for ($i = 0; $i < $eleves->count(); $i++) {
            if ($eleves[$i]->id === $eleve->id) {
                $index = $i;
                break;
            }
        }


        // return view('classe.bulletin')
        return view('eleve.bulletin')
            ->with('ecole', $ecole)


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

            ->with('index', $index)
            ->with('eleves', $eleves)


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


            // ->with('examenT3', $examenT3)
            // ->with('periode5', $periode5)
            // ->with('periode6', $periode6)
            // ->with('maxP5', $maxP5)
            // ->with('noteP5', $noteP5)
            // ->with('maxP6', $maxP6)
            // ->with('noteP6', $noteP6)
            // ->with('maxExT3', $maxExT3)
            // ->with('noteExT3', $noteExT3)
            // ->with('noteTri3', $noteTri3)
            // ->with('maxTri3', $maxTri3)


            ->with('page_name', 'Bulletin Annuel' . ' ' . $eleve->nomComplet() . ' ' . $eleve->classe(false) . " " . $annee->nom)

            //conduites
            ->with('cond1', $cond1)
            ->with('cond2', $cond2)
            ->with('cond3', $cond3)
            ->with('cond4', $cond4)
            // ->with('cond5', $cond5)
            // ->with('cond6', $cond6)
            //periodes
            ->with('p1', $p1)
            ->with('p2', $p2)
            ->with('p3', $p3)
            ->with('p4', $p4)
            // ->with('p5', $p5)
            // ->with('p6', $p6)

            //resultats
            //periodes
            ->with('resultatP1', $resultat->periode1)
            ->with('resultatP2', $resultat->periode2)
            ->with('resultatP3', $resultat->periode3)
            ->with('resultatP4', $resultat->periode4)
            // ->with('resultatP5', $resultat->periode5)
            // ->with('resultatP6', $resultat->periode6)

            //exams
            ->with('resultatEx1', $resultat->examen1)
            ->with('resultatEx2', $resultat->examen2)
            // ->with('resultatEx3', $resultat->examen3)

            //trimes
            ->with('resultatTri1', $resultat->trimestre1)
            ->with('resultatTri2', $resultat->trimestre2)
            // ->with('resultatTri3', $resultat->trimestre3)

            // ->

            //annees
            ->with('resultatAnnee', $resultat->annee)
            //decision
            ->with('decision', $resultat->decision)

            ->with('annee_scolaire', $annee)
            ->with('trimestre', $trimestre)
            ->with('eleve', $eleve);
    }


    ///Method Posts

    public function fillPeriode($resultat, $periode, $data)
    {
        switch ($periode->nom) {
            case 'PREMIERE PERIODE':
                $resultat->periode1 = $data;
                break;
            case 'DEUXIEME PERIODE':
                $resultat->periode2 = $data;
                break;
            case 'TROISIEME PERIODE':
                $resultat->periode3 = $data;
                break;
            case 'QUATRIEME PERIODE':
                $resultat->periode4 = $data;
                break;
                // case 'CINQUIME PERIODE':
                //     $resultat->periode5 = $data;
                //     break;
                // case 'SIXIEME PERIODE':
                // $resultat->periode6 = $data;
                // break;
        }
        // dd(10);
        $resultat->save();
    }
    //check periode
    public function checkPeriode($resultat, $periode)
    {
        // $data ;
        switch ($periode->nom) {
            case 'PREMIERE PERIODE':
                $data = $resultat->periode1;
                break;
            case 'DEUXIEME PERIODE':
                $data = $resultat->periode2;
                break;
            case 'TROISIEME PERIODE':
                $data = $resultat->periode3;
                break;
            case 'QUATRIEME PERIODE':
                $data = $resultat->periode4;
                break;
                // case 'CINQUIEME PERIODE':
                //     $data = $resultat->periode5;
                //     break;
                // case 'SIXIEME PERIODE':
                //     $data = $resultat->periode6;
                //     break;
        }

        return $data;
    }
    //check periode
    public function checkTrimestre($resultat, $trimestre)
    {
        // dd($trimestre);
        // $data ;
        switch ($trimestre->nom) {
            case 'PREMIER SEMESTRE':
                $data = $resultat->examen1;
                $trim = $resultat->trimestre1;
                break;
            case 'DEUXIEME SEMESTRE':
                $data = $resultat->examen2;
                $trim = $resultat->trimestre2;
                break;
            default:
                $data = null;
                $trim = null;
                break;
        }

        return [$data, $trim];
    }

    public function fillTrimestre($resultat, $trimestre, $exa, $trim)
    {
        switch ($trimestre->nom) {
            case 'PREMIER SEMESTRE':
                $resultat->examen1 = $exa;
                $resultat->trimestre1 = $trim;
                break;
            case 'DEUXIEME SEMESTRE':
                $resultat->examen2 = $exa;
                $resultat->trimestre2 = $trim;
                break;
                // case 'TROISIEME TRIMESTRE':
                //     $resultat->examen3 = $exa;
                //     $resultat->trimestre3 = $trim;
                //     break;
        }

        $resultat->save();
    }

    public function periodeStore(Request $request, $periode_id, $eleve_id)
    {
        $request->validate([
            "resultat" => ['required', 'string', 'max:255']
        ]);


        $eleve = Eleve::findOrFail($eleve_id);
        $periode = Periode::findOrFail($periode_id);

        $frequentation = Frequentation::findByEleveAndAnneeScolaire($eleve->id, $periode->trimestre->annee_scolaire->id);

        $resultat = $frequentation->resultat;

        $this->fillPeriode($resultat, $periode, $request->resultat);
        Logfile::updateLog(
            'resultats',
            $resultat->id
        );

        return back();
    }



    public function trimestreStore(Request $request, $trimestre_id, $eleve_id)
    {
        $request->validate([
            "periode1" => ['required', 'string', 'max:255'],
            "periode2" => ['required', 'string', 'max:255'],
            "examen" => ['required', 'string', 'max:255'],
            "trimestre" => ['required', 'string', 'max:255']
        ]);

        // dd($request);
        $eleve = Eleve::findOrFail($eleve_id);
        $trimestre = Trimestre::findOrFail($trimestre_id);

        $periode1 = $trimestre->periodes[0];
        $periode2 = $trimestre->periodes[1];

        $frequentation = Frequentation::findByEleveAndAnneeScolaire($eleve->id, $trimestre->annee_scolaire->id);
        $resultat = $frequentation->resultat;

        $this->fillPeriode($resultat, $periode1, $request->periode1);
        $this->fillPeriode($resultat, $periode2, $request->periode2);
        // dd($request->trimestre);
        $this->fillTrimestre($resultat, $trimestre, $request->examen, $request->trimestre);

        Logfile::updateLog(
            'resultats',
            $resultat->id
        );
        return back();
    }


    public function bulletinStore(Request $request, $annee_id, $eleve_id)
    {
        $request->validate([
            "periode1" => ['required', 'string', 'max:255'],
            "periode2" => ['required', 'string', 'max:255'],
            "periode3" => ['required', 'string', 'max:255'],
            "periode4" => ['required', 'string', 'max:255'],
            // "periode5" => ['required', 'string', 'max:255'],
            // "periode6" => ['required', 'string', 'max:255'],
            "examen1" => ['required', 'string', 'max:255'],
            "examen2" => ['required', 'string', 'max:255'],
            // "examen3" => ['required', 'string', 'max:255'],
            "trimestre1" => ['required', 'string', 'max:255'],
            "trimestre2" => ['required', 'string', 'max:255'],
            // "trimestre3" => ['required', 'string', 'max:255'],
            "annee" => ['required', 'string', 'max:255'],
            "decision" => ['required', 'string', 'max:255'],
        ]);

        // dd($request->decision);

        $eleve = Eleve::findOrFail($eleve_id);
        $annee = AnneeScolaire::findOrFail($annee_id);

        $frequentation = Frequentation::findByEleveAndAnneeScolaire($eleve->id, $annee->id);
        $resultat = $frequentation->resultat;
        // dd($request);

        $resultat->periode1 = $request->periode1;
        $resultat->periode2 = $request->periode2;
        $resultat->periode3 = $request->periode3;
        $resultat->periode4 = $request->periode4;
        // $resultat->periode5 = $request->periode5;
        // $resultat->periode6 = $request->periode6;
        // $resultat->periode7 = $request->periode7;
        $resultat->examen1 = $request->examen1;
        $resultat->examen2 = $request->examen2;
        // $resultat->examen3 = $request->examen3;
        $resultat->trimestre1 = $request->trimestre1;
        $resultat->trimestre2 = $request->trimestre2;
        // $resultat->trimestre3 = $request->trimestre3;
        $resultat->annee = $request->annee;
        $resultat->decision = $request->decision;
        // dd($resultat);
        $resultat->save();
        Logfile::updateLog(
            'resultats',
            $resultat->id
        );
        return back();
    }
}
