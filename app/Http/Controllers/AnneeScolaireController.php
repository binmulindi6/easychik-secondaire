<?php

namespace App\Http\Controllers;

use App\Models\AnneeScolaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class AnneeScolaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $page_name = "Annees Scolaires";
    public function index()
    {
        $anneeScolaires = AnneeScolaire::all();
        return view('ecole.annees')
                ->with('page_name', $this->page_name)
                ->with('items', $anneeScolaires);
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
            'nom' => ['required','string','max:255', 'unique:annee_scolaires'],
            'date_debut' => ['required','string','max:255'],
            'date_fin' => ['required','string','max:255'],
        ]);
        
        //dd(10);
        //dd($request->nom);
        AnneeScolaire::create([
            'nom' => $request->nom,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
        ]);

        return redirect()->route('annee-scolaires.index');
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
        $anneeScolaires = AnneeScolaire::all();
        $annee = AnneeScolaire::find($id);
        return view('ecole.annees')
                    ->with('page_name', $this->page_name . "/Edit")
                    ->with('self', $annee)
                    ->with('items', $anneeScolaires);
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
        $annee = AnneeScolaire::find($id);
        $annee->delete();
        return redirect()->route('annee-scolaires.index');

    }
}
