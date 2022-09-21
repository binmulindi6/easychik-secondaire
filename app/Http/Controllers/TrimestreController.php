<?php

namespace App\Http\Controllers;

use App\Models\AnneeScolaire;
use App\Models\Trimestre;
use Illuminate\Http\Request;

class TrimestreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $page_name = "Trimestres";
    public function index()
    {
        $trimestres = Trimestre::all();
        $annees = AnneeScolaire::all();
        $anneeEncours = AnneeScolaire::current();
        return view('ecole.trimestres')
                    ->with('page_name', $this->page_name)
                    ->with('anneeEncours', $anneeEncours)
                    ->with('annees', $annees)
                    ->with('items', $trimestres);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    
    public function current(){
        ///
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
            'annee_scolaire' => ['required','string','max:255'],
            'date_debut' => ['required','string','max:255'],
            'date_fin' => ['required','string','max:255'],
        ]);

        //dd($request->nom);
        $trimestre = Trimestre::create([
            'nom' => $request->nom,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
        ]);

        $annee = AnneeScolaire::find($request->annee_scolaire);
        $trimestre->annee_scolaire()->associate($annee);
        $trimestre->save();

        //$annee->trimestres()->associate($trimestre);

        return redirect()->route('trimestres.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trimestres = Trimestre::all();
        $trimestre = Trimestre::find($id);
        $annees = AnneeScolaire::all();
        $anneeEncours = AnneeScolaire::current();
        return view('ecole.trimestres')
                    ->with('page_name', $this->page_name . "/Edit")
                    ->with('anneeEncours', $anneeEncours)
                    ->with('self', $trimestre)
                    ->with('annees', $annees)
                    ->with('items', $trimestres);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trimestre = Trimestre::find($id);
        $trimestre->delete();
        return redirect()->route('trimestres.index');
    }
}
