<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\Classe;
use App\Models\Periode;
use App\Models\Fonction;
use App\Models\Trimestre;
use App\Models\EleveExamen;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\AnneeScolaire;
use App\Models\Frequentation;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\TrimStrings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Contracts\Support\Jsonable;
use App\Http\Controllers\Date\DateController;

class EleveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $page = 'Eleves';
    protected $parent;

    public function index() 
    {   
        // dd($_SESSION['current']);
        $eleves = Eleve::latest()
                ->limit(10)
                ->get();
        if (DateController::checkYears()) {
            if (Auth::user()->isParent()) {
               $eleves = Auth::user()->parrain->eleves;
            }

            if (Auth::user()->isEnseignant()) {
                if(Auth::user()->classe() !== null){
                    $eleves = Auth::user()->classe->eleves();
                    // dd($eleves);
                }
            }
            
            if (Auth::user()->isAdmin()){
                $eleves = Eleve::latest()
                ->limit(10)
                ->get();
            }
            $lastmatricule = Eleve::all()->last()->matricule;
            $initial = explode('/', $lastmatricule, -1)[0];
            $middle = str_replace('E', '', $initial);
            $matricule = 'E' . intval($middle) + 1 . '/' . date('Y');
            //return $eleves;
            // return response()->json([
            //     "eleves" => $eleves
            // ]);
            //dd(10);
            return view('eleve.eleves')
                ->with('page_name', $this->page)
                ->with('items', $eleves)
                ->with('parent', $this->parent)
                ->with('last_matricule', $matricule);
        }
        return view('origin')->with('page_name', "Ecole");
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
            'matricule' => ['required', 'string', 'max:255', 'unique:employers'],
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'sexe' => ['required', 'string', 'max:255'],
            'lieu_naissance' => ['required', 'string', 'max:255'],
            'date_naissance' => ['required', 'string', 'max:255'],
            'nom_pere' => ['required', 'string', 'max:255'],
            'nom_mere' => ['required', 'string', 'max:255'],
            'adresse' => ['required', 'string', 'max:255'],
        ]);


        $eleve = Eleve::create([
            'matricule' => $request->matricule,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'sexe' => $request->sexe,
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
        //die(now());

        if ($request->_method == 'PUT') {
            $request->validate([
                'matricule' => ['required', 'string', 'max:255', 'unique:employers'],
                'nom' => ['required', 'string', 'max:255'],
                'prenom' => ['required', 'string', 'max:255'],
                'sexe' => ['required', 'string', 'max:255'],
                'lieu_naissance' => ['required', 'string', 'max:255'],
                'date_naissance' => ['required', 'string', 'max:255'],
                'nom_pere' => ['required', 'string', 'max:255'],
                'nom_mere' => ['required', 'string', 'max:255'],
                'adresse' => ['required', 'string', 'max:255'],
            ]);
            return  $this->update($request, $id);
        }
        $eleve = Eleve::findOrFail($id);
        
        ////JOKER
        // $classe = Classe::find($eleve->classe()->id);

        // $evaluations = $classe->currentEvaluations();
        // $examens = $classe->currentExamens();

        
        
        // if(count($evaluations) > 0){
        //     foreach($evaluations as $ev){
        //         $eleve->evaluations()->attach($ev);
        //         $eleve->save();
        //     }
        // }
        
        // if(count($examens) > 0){
        //     foreach($examens as $ex){
        //         $eleve->examens()->attach($ex);
        //         $eleve->save();
        //     }
        // }
        // // dd(10);
        ///JOKER

        
        $eleves = Eleve::all();
        if (Auth::user()->isEnseignant()) {
            if(Auth::user()->classe() !== null){
                $eleves = Auth::user()->classe->eleves();
                // dd($eleves);
            }
        }
        ///joker
        $index = 0;
        for ($i = 0; $i < $eleves->count(); $i++) {
            if ($eleves[$i]->id === $eleve->id) {
                $index = $i;
                break;
            }
        }



        $annee_scolaire = AnneeScolaire::current();
        $trimestres = $annee_scolaire->trimestres;
        // $periode = 

        return view('eleve.show')
            ->with('page_name', $this->page . " / Show / " . $eleve->id)
            ->with('annee_scolaire', $annee_scolaire)
            ->with('item', $eleve)
            ->with('eleves', $eleves)
            ->with('index', $index)
            ->with('trimestres', $trimestres);
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
        $eleve = Eleve::findOrFail($id);
        return view('eleve.eleves')
            ->with('page_name', $this->page . "/Edit")
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
        $eleve->sexe = $request->sexe;
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

    public function ficheExamen($eleve, $trimestre)
    {
        $eleve = Eleve::findOrFail($eleve);
        $trimestre = Trimestre::findOrFail($trimestre);

        $examens = $eleve->examens->reverse();
        // $examens = $eleve->examens;
        // dd($examens->reverse());
        return view('eleve.evaluations')
            ->with('examens', $examens)
            ->with('trimestre', $trimestre)
            ->with('eleve', $eleve)
            ->with('page_name', $this->page . "/Examens");
    }

    public function ficheEvaluations($eleve, $periode)
    {
        $eleve = Eleve::findOrFail($eleve);
        $periode = Periode::findOrFail($periode);

        // $evaluations = $eleve->evaluations->reverse();
        $evaluations = $eleve->evaluations;
        //dd($evaluations[0]);

        // dd($evaluations[0]->periode->nom);

        return view('eleve.evaluations')
            ->with('evaluations', $evaluations)
            ->with('periode', $periode)
            ->with('eleve', $eleve)
            ->with('page_name', $this->page . "/Evaluations");
    }


    //Search Engine

    public function search(Request $request)
    {


        $items = Eleve::where('nom', 'like', '%' . $request->search . '%')
            ->orWhere('matricule', 'like', '%' . $request->search . '%')
            ->orWhere('lieu_naissance', 'like', '%' . $request->search . '%')
            ->orWhere('prenom', 'like', '%' . $request->search . '%')
            ->get();
        $lastmatricule = Eleve::all()->last()->matricule;
        $initial = explode('/', $lastmatricule, -1)[0];
        $middle = str_replace('E', '', $initial);
        $matricule = 'E' . intval($middle) + 1 . '/' . date('Y');
        //return $eleves;
        // return response()->json([
        //     "eleves" => $eleves
        // ]);
        return view('eleve.eleves')
            ->with('page_name', $this->page . " / Search")
            ->with('search',  $request->search)
            ->with('items', $items)
            ->with('last_matricule', $matricule);
    }

    public function searchEleve(Request $request, $parent)
    {


        $items = Eleve::where('nom', 'like', '%' . $request->search . '%')
            ->orWhere('matricule', 'like', '%' . $request->search . '%')
            ->orWhere('lieu_naissance', 'like', '%' . $request->search . '%')
            ->orWhere('prenom', 'like', '%' . $request->search . '%')
            ->get();
        $lastmatricule = Eleve::all()->last()->matricule;
        $initial = explode('/', $lastmatricule, -1)[0];
        $middle = str_replace('E', '', $initial);
        $matricule = 'E' . intval($middle) + 1 . '/' . date('Y');
        //return $eleves;
        // return response()->json([
        //     "eleves" => $eleves
        // ]);
        return view('eleve.eleves')
            ->with('page_name', 'Eleve-Parent')
            ->with('search',  $request->search)
            ->with('items', $items)
            ->with('parent', $parent)
            ->with('last_matricule', $matricule);
    }

    public function linkParent($parent)
    {
        $this->parent = $parent;
        $this->page = 'Eleve-Parent';

        return $this->index();
    }

    public function fichePaiements($id)
    {   
        $frequentation = Frequentation::findOrFail($id);
        $eleve = Eleve::findOrFail($id);
    }

    public function createPaiements(Request $request, $eleve)
    {
        $request->validate([
            'frequentation' =>  ['required', 'string', 'max:255'],
        ]);

        return redirect()->route('eleves.paiements.show',[$eleve, $request->frequentation]);
    }
    public function showPaiements($eleve, $frequentation)
    {
        $el = Eleve::find($eleve);
        $freq = Frequentation::find($frequentation);
        $paiements = $freq->paiement_frais;
        $annees = $el->frequentations;
        $curFreq = $el->currentFrequentation();
        $frais = $freq->classe->niveau->frais;

        $data = array();
        foreach($frais as $ff){
            $partials = array();
            $partials['frais'] = $ff;
            $total = 0;
            foreach($paiements as $paye) {
                if($paye->frais->id === $ff->id){
                    $total +=  (int)$paye->montant_paye;
                }
            }
            $partials['total'] = $total;
            array_push($data, $partials);
        };

        // dd($data[0]['frais']);

        return view('frais.fiche')
                    ->with('page_name', 'Paiements')
                    ->with('paiements', $paiements)
                    ->with('annees', $annees)
                    ->with('freq', $freq)
                    ->with('frais', $frais)
                    ->with('data', $data)
                    ->with('item', $el);
        dd(10);
    }
}