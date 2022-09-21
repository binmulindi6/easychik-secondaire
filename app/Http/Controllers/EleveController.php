<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\Fonction;
use App\Models\Trimestre;
use App\Models\EleveExamen;
use Illuminate\Http\Request;
use App\Http\Middleware\TrimStrings;
use App\Models\Periode;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class EleveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     protected $page = 'Eleves';

    public function index()
    {
        $eleves = Eleve::latest()
                    ->limit(10)    
                    ->get();
        $lastmatricule = Eleve::all()->last()->matricule;
        $initial = explode('/', $lastmatricule, -1)[0];
        $middle = str_replace('E','', $initial);
        $matricule = 'E' . intval($middle) + 1 . '/' . date('Y');
        
        return view('eleve.eleves')
                    ->with('page_name', $this->page)
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
        $this->page = "Eleves/Create";
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

        return redirect()->route('frequentations.link', $eleve->id);
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
                'lieu_naissance' => ['required','string','max:255'],
                'date_naissance' => ['required','string','max:255'],
                'nom_pere' => ['required','string','max:255'],
                'nom_mere' => ['required','string','max:255'],
                'adresse' => ['required','string','max:255'],
            ]);
            return  $this->update($request, $id);
        }
        $eleve = Eleve::find($id);
        
        return view('eleve.eleves')
                    ->with('page_name', $this->page)
                    ->with('item', $eleve);
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
                    ->with('page_name', $this->page. "/Edit")
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
        $eleve = Eleve::find($id);

        $eleve->matricule = $request->matricule;
        $eleve->nom = $request->nom;
        $eleve->prenom = $request->prenom;
        $eleve->lieu_naissance = $request->lieu_naissance;
        $eleve->date_naissance = $request->date_naissance;
        $eleve->nom_pere = $request->nom_pere;
        $eleve->nom_mere = $request->nom_mere;
        $eleve->adresse = $request->adresse;

        $eleve->save();

        return redirect()->route('eleves.index');
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

    public function ficheExamen($eleve, $trimestre){
        $eleve = Eleve::findOrFail($eleve);
        $trimestre = Trimestre::findOrFail($trimestre);

        $examens = $eleve->examens;

        return view('eleve.show')
                    ->with('examens', $examens)
                    ->with('trimestre', $trimestre)
                    ->with('eleve', $eleve);
    }

    public function ficheEvaluations($eleve, $periode){
        $eleve = Eleve::findOrFail($eleve);
        $periode = Periode::findOrFail($periode);

        $evaluations = $eleve->evaluations;
        //dd($evaluations[0]);

        return view('eleve.show')
                    ->with('evaluations', $evaluations)
                    ->with('periode', $periode)
                    ->with('eleve', $eleve);
    }
}
