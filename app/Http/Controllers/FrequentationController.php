<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\Classe;
use Illuminate\Http\Request;
use App\Models\AnneeScolaire;
use App\Models\Frequentation;
use App\Models\Resultat;
use Illuminate\Support\Facades\Auth;

class FrequentationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $page = 'Frequentations';

    public function index()
    {   
        $frequentations = Frequentation::current();

        $annee = AnneeScolaire::current();
        // dd(Auth::user()->classe);
        if (Auth::user()->isEnseignant()) {
            if(Auth::user()->classe() !== null){
                $frequentations = Frequentation::where('annee_scolaire_id', $annee->id)
                ->where('classe_id', Auth::user()->classe->id)
                ->orderBy('frequentations.id', 'desc')
               ->limit(20)
                ->get();
            }
        }
        
        $classes = Classe::orderBy('niveau_id', 'asc')->get();
        $annees = AnneeScolaire::orderBy('nom')->get();
        // dd(10);
        // dd(Auth::user()->classe);
        return view('eleve.frequentations')
            ->with('page_name', $this->page)
            ->with('items', $frequentations)
            ->with('annee', $annee)
            ->with('classes', $classes)
            ->with('classe', Auth::user()->classe() ? Auth::user()->classe : null)
            ->with("annees", $annees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->page = 'Frequentations/Create';
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
            'eleve_matricule' => ['required', 'string', 'max:255'],
            'classe_id' => ['required', 'string', 'max:255'],
            'annee_scolaire_id' => ['required', 'string', 'max:255'],
        ]);

        $eleve = Eleve::where('matricule', $request->eleve_matricule)->first();

        if(!is_null($eleve)){
            if($eleve->classe()){
                return redirect()->route('frequentations.create')->withErrors([
                    'eleve_matricule' => 'L\'Eleve ' . $eleve->nom . ' est deja inscrit en ' . $eleve->classe()->nomCourt() . " Pour l'Annee Scolaire en cours.",
                    ])->onlyInput('classe_id');
                    
            }


            $classe = Classe::find($request->classe_id);

            $evaluations = $classe->currentEvaluations();
            $examens = $classe->currentExamens();

            
            
            if(count($evaluations) > 0){
                foreach($evaluations as $ev){
                    $eleve->evaluations()->attach($ev);
                    $eleve->save();
                }
            }
            
            if(count($examens) > 0){
                foreach($examens as $ex){
                    $eleve->examens()->attach($ex);
                    $eleve->save();
                }
            }
            // dd(12);

            $annee  = AnneeScolaire::find($request->annee_scolaire_id);

            $frequentation = Frequentation::create();


            //links 
            $frequentation->eleve()->associate($eleve);
            $frequentation->classe()->associate($classe);
            $frequentation->annee_scolaire()->associate($annee);
            // save
            $frequentation->save();

            //create resultat
            $resultat = Resultat::create();
            $resultat->frequentation()->associate($frequentation);
            $resultat->save();

            return redirect()->route('eleves.index');
        }else{
            return redirect()->route('frequentations.create')->withErrors([
                'eleve_matricule' => 'l\'Eleve avec le matricule '. $request->eleve_matricule.' n\'existe pas dans le system',
                ])->onlyInput('eleve_matricule');
                
        }
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
        $frequentation = Frequentation::find($id);
        $frequentations = Frequentation::all();
        $classes = Classe::orderBy('niveau_id', 'asc')->get();
        $annees = AnneeScolaire::orderBy('nom')->get();


        return view('eleve.frequentations')
            ->with('page_name', $this->page . "/Edit")
            ->with('self', $frequentation)
            ->with('items', $frequentations)
            ->with('classes', $classes)
            ->with("annees", $annees);
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
            'eleve_matricule' => ['required', 'string', 'max:255'],
            'classe_id' => ['required', 'string', 'max:255'],
            'annee_scolaire_id' => ['required', 'string', 'max:255'],
        ]);

        $eleve = Eleve::where('matricule', $request->eleve_matricule)->first();
        $classe = Classe::find($request->classe_id);
        $annee  = AnneeScolaire::find($request->annee_scolaire_id);

        $frequentation = Frequentation::find($id);

        //links 
        $frequentation->eleve()->associate($eleve);
        $frequentation->classe()->associate($classe);
        $frequentation->annee_scolaire()->associate($annee);
        // save
        $frequentation->save();
        return redirect()->route('frequentations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $frequentation = Frequentation::find($id);
        $frequentation->delete();
        return redirect()->route('frequentations.index');
    }


    //Search Engine

    public function search(Request $request)
    {


        $items = Frequentation::join('annee_scolaires', 'frequentations.annee_scolaire_id', '=', 'annee_scolaires.id')
            ->join('eleves', 'frequentations.eleve_id', '=', "eleves.id")
            ->join('classes', 'frequentations.classe_id', '=', "classes.id")
            ->where('annee_scolaires.nom', 'like', '%' . $request->search . '%')
            ->orWhere('annee_scolaires.nom', 'like', '%' . $request->search . '%')
            ->orWhere('eleves.matricule', 'like', '%' . $request->search . '%')
            ->orWhere('eleves.nom', 'like', '%' . $request->search . '%')
            ->orWhere('eleves.prenom', 'like', '%' . $request->search . '%')
            ->orWhere('classes.nom', 'like', '%' . $request->search . '%')
            ->orderBy('annee_scolaires.nom', 'desc')

            /*->orWhere('matricule', 'like', '%' . $request->search . '%')
            ->orWhere('lieu_naissance', 'like', '%' . $request->search . '%')
            ->orWhere('prenom', 'like', '%' . $request->search . '%')*/
            ->get();
        //dd($items);
        $classes = Classe::orderBy('niveau_id', 'asc')->get();
        $annees = AnneeScolaire::orderBy('nom')->get();

        return view('eleve.frequentations')
            ->with('page_name', $this->page . " / Search")
            ->with('items', $items)
            ->with('search',  $request->search)
            ->with('classes', $classes)
            ->with("annees", $annees);
    }
}
