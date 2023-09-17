<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Classe;
use App\Models\Logfile;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use App\Models\AnneeScolaire;
use App\Models\CategorieCours;
use App\Models\EleveExamen;
use App\Models\Niveau;
use Illuminate\Support\Facades\DB;

class CoursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $page_name = "Cours";
    public function index()
    {
        $cours = Cours::latest()->get();
        $niveaux = Niveau::all();
        $categories = CategorieCours::orderBy('nom', 'asc')->get();
        // dd(44);
        return view('ecole.cours')
                    ->with('page_name', $this->page_name)
                    ->with('items', $cours)
                    ->with('niveaux', $niveaux)
                    ->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->page_name .= "/Create";
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
            'nom' => ['required','string','max:255'],
            'categorie_cours' => ['required','string','max:255'],
            'niveau' => ['required','string','max:255'],
            'max_periode' => ['required','string','max:255'],
            'max_examen' => ['required','string','max:255'],
        ]);
        
        // dd(9);

        $niveau = Niveau::findOrFail($request->niveau);
        $categorie_cours = CategorieCours::find($request->categorie_cours);

        // dd($classe, $categorie_cours);

        $cours = Cours::create([
            'nom' => $request->nom,
            'max_periode' => $request->max_periode,
            'max_examen' => $request->max_examen,
        ]);

        $cours->niveau()->associate($niveau);
        $cours->categorie_cours()->associate($categorie_cours);
        $cours->save();
        Logfile::createLog(
            'cours',
            $cours->id
        );
        return redirect()->route('cours.index');
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
                'nom' => ['required','string','max:255'],
                'categorie_cours' => ['required','string','max:255'],
                'niveau' => ['required','string','max:255'],
                'max_periode' => ['required','string','max:255'],
                'max_examen' => ['required','string','max:255'],
            ]);

            return  $this->update($request, $id);
        }
        $cours = Cours::findOrFail($id);

        // $periode1 = Evaluation::fiche($id,AnneeScolaire::current()->trimestre1()->periode1()->id);

        return view('cours.show')
        ->with('self', $cours)
        ->with('page_name', $this->page_name . "/ Show");

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cour = Cours::find($id);
        $cours = Cours::all();
        $classes = Classe::orderBy('niveau_id', 'asc')->get();
        $niveaux = Niveau::orderBy('numerotation', 'asc')->get();
        $categories = CategorieCours::orderBy('nom', 'asc')->get();
        return view('ecole.cours')
                ->with('page_name', $this->page_name . "/Edit")
                ->with('self', $cour)
                ->with('items', $cours)
                ->with('classes', $classes)
                ->with('niveaux', $niveaux)
                ->with('categories', $categories);

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
            'nom' => ['required','string','max:255'],
            'categorie_cours' => ['required','string','max:255'],
            'niveau' => ['required','string','max:255'],
            'max_periode' => ['required','string','max:255'],
            'max_examen' => ['required','string','max:255'],
        ]);

        
        $niveau = Niveau::find($request->niveau);
        $categorie_cours = CategorieCours::find($request->categorie_cours);
        
        $cours = Cours::find($id);
        
        $cours->nom = $request->nom;
        $cours->max_periode = $request->max_periode;
        $cours->max_examen = $request->max_examen;
        
        $cours->niveau()->associate($niveau);
        $cours->categorie_cours()->associate($categorie_cours);
        $cours->save();
        //dd($cours);
        Logfile::updateLog(
            'cours',
            $cours->id
        );
        return redirect()->route('cours.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   $cours = Cours::findOrFail($id);
        $cours->destroy();
        Logfile::deleteLog(
            'cours',
            $cours->id
        );
        return redirect()->route('cours.index');
    }
}
