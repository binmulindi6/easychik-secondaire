<?php

namespace App\Http\Controllers;

use App\Models\AnneeScolaire;
use App\Models\Classe;
use App\Models\Cours;
use App\Models\Eleve;
use App\Models\Logfile;
use App\Models\Periode;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use App\Models\TypeEvaluation;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $page_name = 'Evaluations';
    public function index()
    {
        abort(404);
        $evaluations = Evaluation::currents();
        $cours = Cours::orderBy('nom', 'asc')->get();

        if (Auth::user()->isEnseignant()) {
            if (Auth::user()->classe()) {
                $evaluations = Evaluation::currents(Auth::user()->classe->id);
                $cours = Cours::where('niveau_id', Auth::user()->classe->niveau->id)
                    ->where('section_id', Auth::user()->classe->section->id)
                    ->orderBy('nom', 'asc')->get();
                // dd('d');
            } else {
                $cours = Auth::user()->cours();
                // dd($cours);
            }
            // $cours = [];
        } else {
            abort(401);
        }
        // dd($evaluations);

        $periodes = Periode::currents();
        $type_evaluations = TypeEvaluation::orderBy('nom', 'asc')->get();
        return view('travails.evaluations')
            ->with('type_evaluations', $type_evaluations)
            ->with('periodes', $periodes)
            ->with('cours', $cours)
            ->with('items', $evaluations)
            ->with('page_name', $this->page_name);
    }
    public function classe($id)
    {

        $classe = Classe::findOrFail($id);
        // dd($id);
        if (Auth::user()->isEnseignant()) {
            if (Auth::user()->classe() && (Auth::user()->classe->id === $classe->id)) {
                $evaluations = Evaluation::currents($id);
                // $cours = Cours::where('niveau_id', $classe->niveau->id)
                //     ->where('section_id', $classe->section->id)
                //     ->orderBy('nom', 'asc')->get();
                $cours = Auth::user()->cours($classe);
                // dd($cours);
            } else {
                $cours = Auth::user()->cours($classe);
                $evaluations = Evaluation::currents($id);
                // dd($evaluations);
            }
            // $cours = [];
        } else {
            abort(401);
        }
        // dd($evaluations);

        $periodes = Periode::currents();
        $type_evaluations = TypeEvaluation::orderBy('nom', 'asc')->get();
        return view('travails.evaluations')
            ->with('type_evaluations', $type_evaluations)
            ->with('periodes', $periodes)
            ->with('cours', $cours)
            ->with('classe', $classe)
            ->with('items', $evaluations)
            // ->with('page_name', $this->page_name . ' / ' . $classe->nomCourt());
            ->with('page_name', $this->page_name);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'type_evaluation' => ['required', 'string', 'max:255'],
            'cours' => ['required', 'string', 'max:255'],
            'note_max' => ['required', 'integer', 'max:255'],
            'periode' => ['required', 'string', 'max:255'],
            'date_evaluation' => ['required', 'string', 'max:255'],
        ]);

        if (Auth::user()->isEnseignant()) {
        } else {
            abort(401);
        }

        if (AnneeScolaire::current()->isActive()) {

            $cours = Cours::findOrFail($request->cours);
            $periode = Periode::findOrFail($request->periode);


            if (isset($request->classe_id)) {
                $classe = Classe::findOrFail($request->classe_id);
            } else {
                $classe = Classe::findOrFail(Auth::user()->classe->id);
            }

            //dd($periode->isCurrent());
            $type_evaluation = TypeEvaluation::findOrFail($request->type_evaluation);

            $evaluation = Evaluation::create([
                'note_max' => $request->note_max,
                'date_evaluation' => $request->date_evaluation,
            ]);

            $evaluation->cours()->associate($cours);
            $evaluation->classe()->associate($classe);
            $evaluation->periode()->associate($periode);
            $evaluation->type_evaluation()->associate($type_evaluation);

            $evaluation->save();

            Logfile::createLog(
                'evaluations',
                $evaluation->id
            );

            //la classe de l'evaluation
            // $classe = $cours->classe;
            //eleves de la classe
            $eleves = $classe->eleves();
            // dd($eleves[0]->id);

            foreach ($eleves as $eleve) {
                if ($eleve->evaluations() !== null) {
                    $currentEleve = Eleve::find($eleve->id);
                    // dd($currentEleve);
                    if ($currentEleve !== null) {
                        $currentEleve->evaluations()->attach($evaluation);
                        $currentEleve->save();
                    }
                }
            }


            if (isset($request->classe_id)) {
                return redirect()->route('evaluations.classe', $request->classe_id);
            } else {
                return redirect()->route('evaluations');
            }
        }
        return redirect()->back()->withErrors([
            "Vous ne pouvez pas effectuer des operations sur les Archives",
        ])->onlyInput('nom');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if ($request->_method == 'PUT') {
            $request->validate([
                'type_evaluation' => ['required', 'string', 'max:255'],
                'cours' => ['required', 'string', 'max:255'],
                'note_max' => ['required', 'integer', 'max:255'],
                'periode' => ['required', 'string', 'max:255'],
                'date_evaluation' => ['required', 'string', 'max:255'],
            ]);
            return  $this->update($request, $id);
        }
        dd("show");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $evaluation = Evaluation::findOrFail($id);
        $classe = $evaluation->classe;
        $evaluations = Evaluation::currents();
        $cours = Cours::orderBy('nom', 'asc')->get();

        if (Auth::user()->isEnseignant()) {
            $evaluations = Evaluation::currents($classe->id);
            $cours = Cours::where('niveau_id', $classe->niveau->id)
                ->where('section_id', $classe->section->id)
                ->orderBy('nom', 'asc')->get();
        }

        $periodes = Periode::currents();
        $type_evaluations = TypeEvaluation::orderBy('nom', 'asc')->get();
        return view('travails.evaluations')
            ->with('type_evaluations', $type_evaluations)
            ->with('periodes', $periodes)
            ->with('cours', $cours)
            ->with('classe', $classe)
            ->with('self', $evaluation)
            ->with('page_name', $this->page_name . ' / Edit')
            ->with('items', $evaluations);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'type_evaluation' => ['required', 'string', 'max:255'],
            'cours' => ['required', 'string', 'max:255'],
            'note_max' => ['required', 'integer', 'max:255'],
            'periode' => ['required', 'string', 'max:255'],
            'date_evaluation' => ['required', 'string', 'max:255'],
        ]);

        if (AnneeScolaire::current()->isActive()) {

            $cours = Cours::find($request->cours);
            $periode = Cours::find($request->periode);
            $type_evaluation = Cours::find($request->type_evaluation);

            $evaluation = Evaluation::find($id);
            $evaluation->note_max = $request->note_max;
            $evaluation->date_evaluation = $request->date_evaluation;

            $evaluation->cours()->associate($cours);
            $evaluation->periode()->associate($periode);
            $evaluation->type_evaluation()->associate($type_evaluation);

            $evaluation->save();

            Logfile::updateLog(
                'evaluations',
                $evaluation->id
            );


            if (isset($request->classe_id)) {
                return redirect()->route('evaluations.classe', $request->classe_id);
            } else {
                return redirect()->route('evaluations');
            }
        }
        return redirect()->back()->withErrors([
            "Vous ne pouvez pas effectuer des operations sur les Archives",
        ])->onlyInput('nom');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $evaluation = Evaluation::find($id);
        $evaluation->delete();
        Classe::findOrFail($evaluation->classe->id);

        if (AnneeScolaire::current()->isActive()) {
            Logfile::deleteLog(
                'evaluations',
                $evaluation->id
            );

            return redirect()->route('evaluations.classe', $evaluation->classe->id);
        }
        return redirect()->back()->withErrors([
            "Vous ne pouvez pas effectuer des operations sur les Archives",
        ])->onlyInput('nom');
    }


    //Search Engine

    public function search(Request $request)
    {
        $items = Evaluation::join('cours', 'cours.id', '=', 'evaluations.cours_id')
            ->where('cours.nom', 'like', '%' . $request->search . '%')
            ->join('periodes', 'evaluations.periode_id', '=', 'periodes.id')
            ->join('trimestres', 'trimestres.id', '=', 'periodes.trimestre_id')
            ->where('trimestres.annee_scolaire_id', AnneeScolaire::current()->id)
            ->select('evaluations.*')
            ->get();


        $cours = Cours::orderBy('nom', 'asc')->get();
        $classe = Classe::findOrFail($request->classe);
        if (Auth::user()->isEnseignant()) {
            $cours = Auth::user()->cours($classe);
        } else {
            abort(401);
        }

        $periodes = Periode::currents();
        $type_evaluations = TypeEvaluation::orderBy('nom', 'asc')->get();
        return view('travails.evaluations')
            ->with('page_name', $this->page_name . " / Search")
            ->with('search',  $request->search)
            ->with('type_evaluations', $type_evaluations)
            ->with('periodes', $periodes)
            ->with('classe', $classe)
            ->with('cours', $cours)
            ->with('items', $items);
    }
}
