<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Eleve;
use App\Models\Periode;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use App\Models\TypeEvaluation;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $evaluations = Evaluation::all();
        $cours = Cours::orderBy('nom', 'asc')->get();
        $periodes = Periode::all();
        $type_evaluations = TypeEvaluation::orderBy('nom', 'asc')->get();
        return view('classe.evaluations')
                    ->with('type_evaluations', $type_evaluations)
                    ->with('periodes', $periodes)
                    ->with('cours', $cours)
                    ->with('items', $evaluations);
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

        $cours = Cours::findOrFail($request->cours);
        $periode = Periode::findOrFail($request->periode);
        //dd($periode->isCurrent());
        $type_evaluation = TypeEvaluation::findOrFail($request->type_evaluation);
        
        $evaluation = Evaluation::create([
            'note_max' => $request->note_max,
            'date_evaluation' => $request->date_evaluation,
        ]);
        
        $evaluation->cours()->associate($cours);
        $evaluation->periode()->associate($periode);
        $evaluation->type_evaluation()->associate($type_evaluation);
        
        $evaluation->save();
        
        //la classe de l'evaluation
        $classe = $cours->classe;
        //eleves de la classe
        $eleves = $classe->eleves();

        foreach ($eleves as $eleve) {
            $currentEleve = Eleve::find($eleve->eleve_id);
            $currentEleve->evaluations()->attach($evaluation);
            $currentEleve->save();
        }


        return redirect()->route('evaluations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if($request->_method == 'PUT'){
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
        $evaluation = Evaluation::find($id);
        $evaluations = Evaluation::all();
        $cours = Cours::orderBy('nom', 'asc')->get();
        $periodes = Periode::all();
        $type_evaluations = TypeEvaluation::orderBy('nom', 'asc')->get();
        return view('classe.evaluations')
                    ->with('type_evaluations', $type_evaluations)
                    ->with('periodes', $periodes)
                    ->with('cours', $cours)
                    ->with('self', $evaluation)
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

        return redirect()->route('evaluations.index');
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
        return redirect()->route('evaluations.index');

    }
}
