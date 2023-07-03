<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Eleve;
use App\Models\Examen;
use App\Models\Logfile;
use App\Models\trimestre;
use Illuminate\Http\Request;
use App\Models\TypeEvaluation;
use Illuminate\Support\Facades\Auth;

class ExamenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $page_name = 'Examens';
    public function index()
    {
        $examens = Examen::latest()
           ->limit(20)
            ->get();
        $cours = Cours::orderBy('nom', 'asc')->get();

        if(Auth::user()->isEnseignant()){
            if(Auth::user()->classe()){
                $cours = Cours::where('classe_id', Auth::user()->classe->id)
                        ->orderBy('nom', 'asc')->get();
            }else{
                $cours = null;
            }
            // $cours = [];
        }
        
        $trimestres = Trimestre::all();
        return view('travails.examens')
            ->with('trimestres', $trimestres)
            ->with('cours', $cours)
            ->with('page_name', $this->page_name)
            ->with('items', $examens);
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
            'cours' => ['required', 'string', 'max:255'],
            'note_max' => ['required', 'integer', 'max:255'],
            'trimestre' => ['required', 'string', 'max:255'],
            'date_examen' => ['required', 'string', 'max:255'],
        ]);

        $cours = Cours::findOrFail($request->cours);
        $trimestre = Trimestre::findOrFail($request->trimestre);
        //dd($periode->isCurrent());

        $examen = Examen::create([
            'note_max' => $request->note_max,
            'date_examen' => $request->date_examen,
        ]);

        $examen->cours()->associate($cours);
        $examen->trimestre()->associate($trimestre);

        $examen->save();

        Logfile::createLog(
            'examens',
            $examen->id
        );


        //la classe de l'examen
        $classe = $cours->classe;
        //eleves de la classe
        $eleves = $classe->eleves();

        foreach ($eleves as $eleve) {
            $currentEleve = Eleve::find($eleve->id);
            $currentEleve->examens()->attach($examen);
            $currentEleve->save();
        }


        return redirect()->route('examens.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $request->validate([
            'cours' => ['required', 'string', 'max:255'],
            'note_max' => ['required', 'integer', 'max:255'],
            'trimestre' => ['required', 'string', 'max:255'],
            'date_examen' => ['required', 'string', 'max:255'],
        ]);
        return  $this->update($request, $id);

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
        $examen = Examen::find($id);
        $examens = Examen::all();
        $cours = Cours::orderBy('nom', 'asc')->get();
            if(Auth::user()->isEnseignant()){
                $cours = Cours::where('classe_id', Auth::user()->classe->id)
                            ->orderBy('nom', 'asc')->get();
            }
        $trimestres = Trimestre::all();
        return view('travails.examens')
            ->with('trimestres', $trimestres)
            ->with('cours', $cours)
            ->with('self', $examen)
            ->with('page_name', $this->page_name . ' / Edit')
            ->with('items', $examens);
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
            'cours' => ['required', 'string', 'max:255'],
            'note_max' => ['required', 'integer', 'max:255'],
            'trimestre' => ['required', 'string', 'max:255'],
            'date_examen' => ['required', 'string', 'max:255'],
        ]);

        $cours = Cours::findOrFail($request->cours);
        $trimestre = Trimestre::findOrFail($request->trimestre);
        //dd($periode->isCurrent());

        $examen = Examen::find($id);
        $examen->note_max = $request->note_max;
        $examen->date_examen = $request->date_examen;

        $examen->cours()->associate($cours);
        $examen->trimestre()->associate($trimestre);

        $examen->save();

        Logfile::updateLog(
            'examens',
            $examen->id
        );

        return redirect()->route('examens.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $examen = Examen::find($id);
        $examen->delete();

        Logfile::deleteLog(
            'examens',
            $examen->id
        );

        return redirect()->route('examens.index');
    }

    public function search(Request $request)
    {
        $items = Examen::join('cours', 'cours.id', '=', 'examens.cours_id')
            ->where('cours.nom', 'like', '%' . $request->search . '%')
            // ->join('trimestres', 'trimestres.id', '=', 'examens.cours_id')
            // ->where('trimestres.nom', 'like', '%' . $request->search . '%')
            ->get();

        $cours = Cours::orderBy('nom', 'asc')->get();

        if(Auth::user()->isEnseignant()){
            $cours = Cours::where('classe_id', Auth::user()->classe->id)
                        ->orderBy('nom', 'asc')->get();
        }

        $trimestres = Trimestre::all();
        return view('travails.examens')
            ->with('page_name', $this->page_name . " / Search")
            ->with('search',  $request->search)
            ->with('trimestres', $trimestres)
            ->with('cours', $cours)
            ->with('page_name', $this->page_name)
            ->with('items', $items);
    }
}