<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Cours;
use App\Models\Eleve;
use App\Models\EleveEvaluation;
use App\Models\EleveExamen;
use App\Models\Examen;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CotationController extends Controller
{
    protected $page_name = 'Cotations';

    public function __construct()
    {
        // if(!Auth::user()->isEnseignant()){
        //     return redirect(404);
        // }
    }

    public function index()
    {
        $classes = Auth::user()->classes();
        // $evaluations =  $classe->currentEvaluations();
        // rsort($evaluations);

        return view('cotation.classe')
            // ->with('items', $evaluations)
            ->with('classes', $classes)
            ->with('page_name', $this->page_name . " Evaluations");
    }
    public function classeEvaluation($id)
    {
        $classe = Classe::findOrFail($id);
        $evaluations =  $classe->currentEvaluations();
        // dd($evaluations);

        return view('cotation.evaluations')
            ->with('items', $evaluations)
            ->with('classe', $classe)
            ->with('page_name', $this->page_name . " Evaluations");
    }
    public function classeExamen($id)
    {
        $classe = Classe::findOrFail($id);
        $examens = $classe->currentExamens();
        // rsort($examens);

        return view('cotation.examens')
            // ->with('items', $evaluations)
            ->with('items', $examens)
            ->with('classe', $classe)
            ->with('page_name', $this->page_name . " Examens");
    }
    public function examens()
    {
        $classe = Auth::user()->classe;
        $examens = $classe->currentExamens();
        // rsort($examens);

        return view('cotation.examens')
            // ->with('items', $evaluations)
            ->with('items', $examens)
            ->with('classe', $classe)
            ->with('page_name', $this->page_name . " Examens");
    }

    public function searchEvaluation(Request $request)
    {
        $items = Evaluation::join('cours', 'cours.id', '=', 'evaluations.cours_id')
            ->where('cours.nom', 'like', '%' . $request->search . '%')
            // ->join('type_evaluations', 'type_evaluations.id', '=', 'evaluations.type_evaluation_id')
            // ->where('type_evaluations.nom', 'like', '%' . $request->search . '%')
            ->get();
        $classe = Classe::findOrFail($request->classe_id);
        return view('cotation.evaluations')
            ->with('page_name', $this->page_name . " Evaluations / Search")
            ->with('search',  $request->search)
            ->with('classe', $classe)
            ->with('items', $items);
    }

    public function showEvaluation($id)
    {
        $evaluation = Evaluation::findOrFail($id);
        $classe = $evaluation->classe;
        $eleveEvaluations = EleveEvaluation::getByEvaluation($evaluation->id);

        // dd($eleveEvaluations[0]);

        return view('cotation.showEvaluation')
            ->with('evaluation', $evaluation)
            ->with('items', $eleveEvaluations)
            ->with('classe', $classe)
            ->with('page_name', $this->page_name . " Evaluations " . $evaluation->cours->nom);
    }
    public function showExamen($id)
    {
        $examen = Examen::findOrFail($id);
        $classe = $examen->classe;
        $eleveExamens = EleveExamen::getByExamen($examen->id);

        return view('cotation.showExamen')
            ->with('examen', $examen)
            ->with('items', $eleveExamens)
            ->with('classe', $classe)
            ->with('page_name', $this->page_name . " Examen " . $examen->cours->nom);
    }




    public function searchExamen(Request $request)
    {
        $items = Examen::join('cours', 'cours.id', '=', 'examens.cours_id')
            ->where('cours.nom', 'like', '%' . $request->search . '%')
            // ->join('trimestres', 'trimestres.id', '=', 'examens.cours_id')
            // ->where('trimestres.nom', 'like', '%' . $request->search . '%')
            ->get();

        $classe = Classe::findOrFail($request->classe_id);
        return view('cotation.examens')
            ->with('page_name', $this->page_name . " Examens / Search")
            ->with('search',  $request->search)
            ->with('classe', $classe)
            ->with('page_name', $this->page_name)
            ->with('items', $items);
    }

    public function searchEvaluationEleve(Request $request, $id)
    {


        $items = Eleve::where('nom', 'like', '%' . $request->search . '%')
            ->orWhere('matricule', 'like', '%' . $request->search . '%')
            ->orWhere('lieu_naissance', 'like', '%' . $request->search . '%')
            ->orWhere('prenom', 'like', '%' . $request->search . '%')
            ->get();
        $evaluation = Evaluation::findOrFail($id);
        $eleveEvaluations = EleveEvaluation::getByEvaluation($evaluation->id);

        $data = [];
        foreach ($eleveEvaluations as $eleveEvaluation) {
            foreach ($items as $eleve) {
                if ($eleveEvaluation->eleve_id === $eleve->id) {
                    $data[] = $eleveEvaluation;
                }
            }
        }

        // dd($data);
        $classe = Classe::findOrFail($request->classe_id);
        // dd($eleveEvaluations[0]);

        return view('cotation.showEvaluation')
            ->with('evaluation', $evaluation)
            ->with('items', $data)
            ->with('classe', $classe)
            ->with('search',  $request->search)
            ->with('page_name', $this->page_name . " Evaluations " . $evaluation->cours->nom);
    }
    public function searchExamenEleve(Request $request, $id)
    {


        $items = Eleve::where('nom', 'like', '%' . $request->search . '%')
            ->orWhere('matricule', 'like', '%' . $request->search . '%')
            ->orWhere('lieu_naissance', 'like', '%' . $request->search . '%')
            ->orWhere('prenom', 'like', '%' . $request->search . '%')
            ->get();
        $examen = Examen::findOrFail($id);
        $eleveExamens = EleveExamen::getByExamen($examen->id);

        $data = [];
        $classe = Classe::findOrFail($request->classe_id);
        $classe = Classe::findOrFail($request->classe_id);
        // dd($eleveExamens[0]);
        foreach ($eleveExamens as $eleveExamen) {
            foreach ($items as $eleve) {
                if ($eleveExamen->eleve_id === $eleve->id) {
                    $data[] = $eleveExamen;
                }
            }
        }

        // dd($data);

        // dd($eleveEvaluations[0]);

        return view('cotation.showExamen')
            ->with('examen', $examen)
            ->with('items', $data)
            ->with('classe', $classe)
            ->with('search',  $request->search)
            ->with('page_name', $this->page_name . " Evaluations " . $examen->cours->nom);
    }
}
