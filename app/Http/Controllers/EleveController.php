<?php

namespace App\Http\Controllers;

use App\Models\Ecole;
// use App\Models\Classe;
use App\Models\Eleve;
// use App\Models\Fonction;
use App\Models\Examen;
use App\Models\Logfile;
// use Illuminate\Support\Arr;
use App\Models\Periode;
use App\Models\Trimestre;
use App\Models\Evaluation;
// use Illuminate\Http\JsonResponse;
use App\Models\FileUpload;
// use App\Http\Middleware\TrimStrings;
use App\Models\EleveExamen;
// use Illuminate\Support\Facades\Date;
// use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Http\Request;
use App\Models\AnneeScolaire;
use App\Models\Frequentation;
use App\Models\TypeEvaluation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        // dd(session()->get('currentYear'));
        // dd($_SESSION['current']);
        $eleves = Eleve::latest()->limit(20)->get();
        if (DateController::checkYears()) {
            if (Auth::user()->isParent()) {
                $eleves = Auth::user()->parrain->eleves;
            } else {
                $eleves = [];
            }

            if (Auth::user()->isEnseignant()) {
                if (Auth::user()->classe() !== null) {
                    $eleves = Auth::user()->classe->eleves();
                } else {
                    $eleves = [];
                }
            }

            if (Auth::user()->isDirecteur() || Auth::user()->isAdmin() || Auth::user()->isSecretaire() || Auth::user()->isManager()) {
                $eleves = Eleve::latest()
                    ->limit(20)
                    ->get();
            }

            $matricule = Eleve::getLastMatricule();

            //return $eleves;
            // return response()->json([
            //     "eleves" => $eleves
            // ]);
            //dd(10);
            return view('eleve.eleves')
                ->with('page_name', $this->page)
                ->with('items', $eleves)
                // ->with('imported', count($eleves))
                ->with('parent', $this->parent)
                ->with('last_matricule', $matricule);
        }
        return view('origin')
            ->with('order', "year")
            ->with('page_name', "Ecole");
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
            'matricule' => ['required', 'string', 'max:255', 'unique:eleves'],
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'sexe' => ['required', 'string', 'max:255'],
            'lieu_naissance' => ['required', 'string', 'max:255'],
            'nationalite' => ['required', 'string', 'max:255'],
            'date_naissance' => ['required', 'string', 'max:255'],
            'nom_pere' => ['required', 'string', 'max:255'],
            'nom_mere' => ['required', 'string', 'max:255'],
            'profession_pere' => ['required', 'string', 'max:255'],
            'profession_mere' => ['required', 'string', 'max:255'],
            'telephone_pere' => ['required', 'string', 'max:255'],
            'telephone_mere' => ['required', 'string', 'max:255'],
            'adresse' => ['required', 'string', 'max:255'],
            'num_permanent' => ['string', 'max:255'],
        ]);


        $eleve = Eleve::create([
            'num_permanent' => $request->num_permanent,
            'matricule' => $request->matricule,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'sexe' => $request->sexe,
            'nationalite' => $request->nationalite,
            'lieu_naissance' => $request->lieu_naissance,
            'date_naissance' => $request->date_naissance,
            'nom_pere' => $request->nom_pere,
            'nom_mere' => $request->nom_mere,
            'profession_pere' => $request->profession_pere,
            'profession_mere' => $request->profession_mere,
            'telephone_pere' => $request->telephone_pere,
            'telephone_mere' => $request->telephone_mere,
            'adresse' => $request->adresse,
        ]);

        Logfile::createLog(
            'eleves',
            $eleve->id
        );

        if(count(Eleve::all()) > 1){
            return redirect()->route('frequentations.link', $eleve->id);
        }
        return redirect()->route('eleves.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        // die(public_path('storage/profiles/eleves'));
        // dd(asset('storage',true));
        if ($request->_method == 'PUT') {
            $request->validate([
                'matricule' => ['required', 'string', 'max:255'],
                'nom' => ['required', 'string', 'max:255'],
                'prenom' => ['required', 'string', 'max:255'],
                'sexe' => ['required', 'string', 'max:255'],
                'lieu_naissance' => ['required', 'string', 'max:255'],
                'date_naissance' => ['required', 'string', 'max:255'],
                'nationalite' => ['string', 'max:255'],
                'nom_pere' => ['required', 'string', 'max:255'],
                'nom_mere' => ['required', 'string', 'max:255'],
                'profession_pere' => ['required', 'string', 'max:255'],
                'profession_mere' => ['required', 'string', 'max:255'],
                'telephone_pere' => ['required', 'string', 'max:255'],
                'telephone_mere' => ['required', 'string', 'max:255'],
                'adresse' => ['required', 'string', 'max:255'],
                'num_permanent' => ['string', 'max:255'],
            ]);
            return  $this->update($request, $id);
        }
        $eleve = Eleve::findOrFail($id);
        // dd($eleve->conduites);

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
            if (Auth::user()->classe() !== null) {
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
    public function ficheIdentite($id)
    {

        $eleve = Eleve::findOrFail($id);

        $eleves = Eleve::all();
        if (Auth::user()->isEnseignant()) {
            if (Auth::user()->classe() !== null) {
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

        return view('eleve.fiche-identite')
            ->with('page_name', $this->page . " / Fiche D'Identité / " . $eleve->id)
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
    public function uploadProfile(Request $request)
    {

        $request->validate([
            'image' => ['required', 'image', 'max:2048'],
            'eleve_id' => ['required', 'string', 'max:255']
        ]);

        $eleve = Eleve::findOrFail($request->eleve_id);
        $file = $request->file('image');

        $upload = new FileUpload('/profiles/eleves/', ['jpg', 'jpeg', 'png']);
        $oldAvatar = $eleve->avatar;
        $eleve->avatar = $upload->uploadFile($file);
        $eleve->save();

        Logfile::updateLog(
            'eleves',
            $eleve->id
        );

        $oldAvatar && Storage::disk('public')->delete($oldAvatar);
        return redirect()->route('eleves.show', $eleve->id);

        //laravel 9 file upload system?
    }


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

        if ($eleve->isActive()) {
            $eleve->num_permanent = $request->num_permanent;
            $eleve->matricule = $request->matricule;
            $eleve->nom = $request->nom;
            $eleve->prenom = $request->prenom;
            $eleve->sexe = $request->sexe;
            $eleve->lieu_naissance = $request->lieu_naissance;
            $eleve->date_naissance = $request->date_naissance;
            $eleve->nationalite = $request->nationalite;
            $eleve->nom_pere = $request->nom_pere;
            $eleve->nom_mere = $request->nom_mere;
            $eleve->profession_pere = $request->profession_pere;
            $eleve->profession_mere = $request->profession_mere;
            $eleve->telephone_pere = $request->telephone_pere;
            $eleve->telephone_mere = $request->telephone_mere;
            $eleve->adresse = $request->adresse;

            $eleve->save();
            Logfile::updateLog(
                'eleves',
                $eleve->id
            );

            if (isset($request->back)) {
                return redirect()->back();
            } else {
                return redirect()->route('eleves.index');
            }
        }
        return redirect()->back()->withErrors([
            "Vous ne pouvez pas effectuer des operations sur les Archives",
        ])->onlyInput('nom');
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
        if ($eleve->isActive()) {
            $eleve->delete();
            Logfile::deleteLog(
                'eleves',
                $eleve->id
            );
            return redirect()->route('eleves.index');
        }
        return redirect()->back()->withErrors([
            "Vous ne pouvez pas effectuer des operations sur les Archives",
        ])->onlyInput('nom');
    }

    public function ficheExamen($eleve, $trimestre)
    {
        $eleve = Eleve::findOrFail($eleve);
        $trimestre = Trimestre::findOrFail($trimestre);


        //hacks
        // $cours = $eleve->classe()->cours;
        // foreach ($cours as $cour) {
        //     // $type_evaluation = TypeEvaluation::findOrFail(1);

        //     $evaluation = Examen::create([
        //         'note_max' => $cour->max_examen,
        //         'date_examen' => '2023-04-30',
        //     ]);

        //     $evaluation->cours()->associate($cour);
        //     $evaluation->trimestre()->associate($trimestre);
        //     // $evaluation->type_evaluation()->associate($type_evaluation);

        //     $evaluation->save();

        //     Logfile::createLog(
        //         'examens',
        //         $evaluation->id
        //     );

        //     $eleve->examens()->attach($evaluation);
        //     $eleve->save();
        // }

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

        //hackeks
        // $cours = $eleve->classe()->cours;
        // foreach($cours as $cour){
        //     $type_evaluation = TypeEvaluation::findOrFail(1);

        //     $evaluation = Evaluation::create([
        //         'note_max' => $cour->max_periode,
        //         'date_evaluation' => '2022-09-30',
        //     ]);

        //     $evaluation->cours()->associate($cour);
        //     $evaluation->periode()->associate($periode);
        //     $evaluation->type_evaluation()->associate($type_evaluation);

        //     $evaluation->save();

        //     Logfile::createLog(
        //         'evaluations',
        //         $evaluation->id
        //     );

        //     $eleve->evaluations()->attach($evaluation);
        //     $eleve->save();

        // }

        $evaluations = $eleve->evaluations;


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
        $matricule = Eleve::getLastMatricule();
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



        if (Auth::user()->isParent()) {
            $eleves = Auth::user()->parrain->eleves;
        } else {
            $eleves = [];
        }

        if (Auth::user()->isEnseignant()) {
            if (Auth::user()->classe() !== null) {
                $eleves = Auth::user()->classe->eleves();
                dd($eleves);
            } else {
                $eleves = [];
            }
        }

        if (Auth::user()->isAdmin() || Auth::user()->isSecretaire() || Auth::user()->isManager()) {
            $items = Eleve::where('nom', 'like', '%' . $request->search . '%')
                ->orWhere('matricule', 'like', '%' . $request->search . '%')
                ->orWhere('lieu_naissance', 'like', '%' . $request->search . '%')
                ->orWhere('prenom', 'like', '%' . $request->search . '%')
                ->get();
        }

        $matricule = Eleve::getLastMatricule();
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

    public function linkParent(Request $request, $parent)
    {
        $this->parent = $parent;
        $this->page = 'Eleve-Parent';

        return $this->index($request);
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

        return redirect()->route('eleves.paiements.show', [$eleve, $request->frequentation]);
    }
    public function showPaiements($eleve, $frequentation)
    {
        $el = Eleve::find($eleve);
        $freq = Frequentation::find($frequentation);
        $paiements = $freq->paiement_frais;
        $annees = $el->frequentations;
        // $curFreq = $el->currentFrequentation();
        $frais = $freq->classe->frais();

        $data = array();
        foreach ($frais as $ff) {
            $partials = array();
            $partials['frais'] = $ff;
            $total = 0;
            foreach ($paiements as $paye) {
                if ($paye->frais->id === $ff->id) {
                    $total +=  (int)$paye->montant_paye;
                }
            }
            $partials['total'] = $total;
            array_push($data, $partials);
        };

        // dd($data[0]['frais']);

        return view('frais.fiche')
            ->with('page_name', 'Eleves / Paiements')
            ->with('paiements', $paiements)
            ->with('annees', $annees)
            ->with('freq', $freq)
            ->with('frais', $frais)
            ->with('data', $data)
            ->with('item', $el);
    }


    ///carte

    public function carte($id)
    {
        $eleve = Eleve::findOrFail($id);
        $ecole = Ecole::first();
        return view('eleve.carte')
            ->with('ecole', $ecole)
            ->with('eleve', $eleve);
    }
}
