<?php

namespace App\Http\Controllers;

use App\Models\AnneeScolaire;
use App\Models\Classe;
use App\Models\Eleve;
use App\Models\Frequentation;
use Illuminate\Http\Request;

class FrequentationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $frequentations = Frequentation::all();
        $classes = Classe::all();
        $annees = AnneeScolaire::all();

        return view('eleve.frequentations')
                    ->with('items', $frequentations)
                    ->with('classes', $classes)
                    ->with("annees",$annees);
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

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'eleve_matricule' => ['required','string','max:255'],
            'classe_id' => ['required','string','max:255'],
            'annee_scolaire_id' => ['required','string','max:255'],
        ]);

        $eleve = Eleve::where('matricule',$request->eleve_matricule)->first();

        $classe = Classe::find($request->classe_id);
        $annee  = AnneeScolaire::find($request->annee_scolaire_id);
        
        $frequentation = Frequentation::create();
        
        //links 
        $frequentation->eleve()->associate($eleve);
        $frequentation->classe()->associate($classe);
        $frequentation->anneeScolaire()->associate($annee);
        // save
        $frequentation->save();

        /*$eleve->frequentations()->associate($frequentation);
        $classe->frequentations()->associate($frequentation);
        $annee->frequentations()->associate($frequentation);*/

        return redirect()->route('frequentations.index');

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
        //
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
        //
    }
}
