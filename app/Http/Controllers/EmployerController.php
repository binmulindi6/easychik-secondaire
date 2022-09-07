<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Fonction;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employers = Employer::all();
        $fonctions = Fonction::select([
            'id',
            'nom'
        ])->get();
        return view('employer.show')
                    ->with('items', $employers)
                    ->with('fonctions', $fonctions);
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
    {   dd(10);
        $employer = Employer::create([
            'matricule' => $request->matricule,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'date_naissance' => $request->date_naissance,
            'formation' => $request->formation,
            'diplome' => $request->diplome,
            'niveau_etude' => $request->niveau_etude,
        ]);

        $fonction = Fonction::find($request->fonction);
        $employer->fonctions()->attach($fonction);
        $employer->save();

        return redirect()->route('employers.index');
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
                'matricule' => ['required','string','max:255', 'unique:employers'],
                'nom' => ['required','string','max:255'],
                'prenom' => ['required','string','max:255'],
                'date_naissance' => ['required','string','max:255'],
                'formation' => ['required','string','max:255'],
                'diplome' => ['required','string','max:255'],
                'niveau_etude' => ['required','string','max:255'],
                'fonction' => ['required','integer','max:255'],
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
        $employers = Employer::all();
        $employer = Employer::find($id);
        $fonctions = Fonction::select([
            'id',
            'nom'
        ])->get();
        return view('employer.show')
                    ->with('self', $employer)
                    ->with('items', $employers)
                    ->with('fonctions', $fonctions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   $request->validate([
        'matricule' => ['required','string','max:255', 'unique:employers'],
        'nom' => ['required','string','max:255'],
        'prenom' => ['required','string','max:255'],
        'date_naissance' => ['required','string','max:255'],
        'formation' => ['required','string','max:255'],
        'diplome' => ['required','string','max:255'],
        'niveau_etude' => ['required','string','max:255'],
        'fonction' => ['required','integer','max:255'],
        ]);

        $employer = Employer::find($id);
        $employer->matricule = $request->matricule;
        $employer->nom = $request->nom;
        $employer->prenom = $request->prenom;
        $employer->date_naissance = $request->date_naissance;
        $employer->formation = $request->formation;
        $employer->diplome = $request->diplome;
        $employer->niveau_etude = $request->niveau_etude;
        
        $fonction = Fonction::find($request->fonction);
        $employer->fonctions()->attach($fonction);
        $employer->save();

        return redirect()->route('employers.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employer = Employer::find($id);
        $employer->delete();

        return redirect()->route('employers.index');
    }
}
