<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class EleveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eleves = Eleve::all();
        $lastmatricule = Eleve::all()->last()->matricule;
        $initial = explode('/', $lastmatricule, -1)[0];
        $middle = str_replace('E','', $initial);
        $matricule = 'E' . intval($middle) + 1 . '/' . date('Y');
        
        return view('eleve.eleves')
                    ->with('items', $eleves)
                    ->with('last_matricule', $matricule);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return redirect()->route('eleves.index');
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
            'matricule' => ['required','string','max:255', 'unique:employers'],
            'nom' => ['required','string','max:255'],
            'prenom' => ['required','string','max:255'],
            'lieu_naissance' => ['required','string','max:255'],
            'date_naissance' => ['required','string','max:255'],
            'nom_pere' => ['required','string','max:255'],
            'nom_mere' => ['required','string','max:255'],
            'adresse' => ['required','string','max:255'],
        ]);


        $eleve = Eleve::create([
            'matricule' => $request->matricule,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'lieu_naissance' => $request->lieu_naissance,
            'date_naissance' => $request->date_naissance,
            'nom_pere' => $request->nom_pere,
            'nom_mere' => $request->nom_mere,
            'adresse' => $request->adresse,
        ]);

        return redirect()->route('eleves.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $eleves = Eleve::find($id);
        
        return view('eleve.eleves')
                    ->with('item', $eleves);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $eleves = Eleve::all();
        $eleve = Eleve::find($id);
        return view('eleve.eleves')
                    ->with('self', $eleve)
                    ->with('items', $eleves);
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
        $eleve = Eleve::find($id);
        $eleve->delete();

        return redirect()->route('eleves.index');
    }
}
