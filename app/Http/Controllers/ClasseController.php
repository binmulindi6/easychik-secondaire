<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Frais;
use App\Models\Classe;
use App\Models\Niveau;
use App\Models\Logfile;
use App\Models\Periode;
use App\Models\Trimestre;
use Illuminate\Http\Request;
use App\Models\AnneeScolaire;
use App\Models\CategorieCours;
use App\Models\Section;
use Illuminate\Support\Facades\DB;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $page = "Classes";

    public function index()
    {


        $classes = Classe::orderBy('niveau_id', 'asc')->get();
        $niveaux = Niveau::all();
        $sections = Section::all();
        //$user = User::where('id',)
        // dd($classes[2]);
        // dd($classes[2]->encadrements);
        return view('classe.classes')
            ->with('page_name', $this->page)
            ->with('niveaux', $niveaux)
            ->with('sections', $sections)
            ->with('items', $classes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->page = "Classes / Create";
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
            'niveau' => ['required', 'string', 'max:255'],
            'section' => ['required', 'string', 'max:255'],
            'nom' => ['required', 'string', 'max:255'],
        ]);

        $classes = Classe::all();

        if (count($classes) < env('SUBSCRIPTION_CLASSES') || env('SUBSCRIPTION') === "GOLD" || env('SUBSCRIPTION') === "GOLD PREMIUM") {

            $niveau = Niveau::findOrFail($request->niveau);
            $section = Section::findOrFail($request->section);
            if(!Classe::where('niveau_id', $request->niveau)->where('section_id', $request->section)->where('nom', $request->nom)->first()){
            // dd($request->nom , $request->niveau);
            $classe = Classe::create([
                'nom' => $request->nom,
            ]);

            $classe->niveau()->associate($niveau);
            $classe->section()->associate($section);

            $classe->save();
            Logfile::createLog(
                'classes',
                $classe->id
            );

            return redirect()->route("classes.index");
            }
            return redirect()->route('classes.create')->withErrors([
                'Classe' => 'La Classe de '. $niveau->nom .' ' . $request->nom . ' existe déja!',
            ])->onlyInput('matricule');
        }
        return redirect()->route('classes.create')->withErrors([
            'Classe' => 'Vous ne pouvez pas ajouter plus de ' . env('SUBSCRIPTION_CLASSES'). ' Classes, veuillez changer de souscrition pour pouvoir en ajouter plus.',
        ])->onlyInput('matricule');
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
        $classe = Classe::findOrFail($id);
        $annee = AnneeScolaire::current();
        $annees = AnneeScolaire::orderBy('nom', 'desc')->get();
        // $annees = AnneeScolaire::orderBy('nom', 'desc')->get();
        // dd($annees);

        return view('classe.profile')
            ->with('page_name', "Classes / " . $classe->nomComplet())
            ->with('annee_scolaire', $annee)
            ->with('annees', $annees)
            ->with('classe', $classe);
    }

    public function Eleves($id)
    {
        $classe = Classe::findOrFail($id);
        $eleves = $classe->eleves();

        return view('classe.eleves')
            ->with('page_name', "Classes / " . $classe->nomCourt() . " / Liste des Eleves")
            ->with('items', $eleves)
            ->with('classe', $classe);
    }

    public function cours($id)
    {
        $classe = Classe::findOrFail($id);
        $cours = $classe->cours();
        // dd($cours);

        return view('classe.cours')
            ->with('page_name', "Classes / " . $classe->nomCourt() . " / Liste des Cours")
            ->with('items', $cours)
            ->with('classe', $classe);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $classes = Classe::orderBy('niveau_id', 'asc')->get();
        $classes = Classe::all();
        $classe = Classe::findOrFail($id);
        $niveaux = Niveau::all();
        $sections = Section::all();

        $users = User::all()->except(['email', 'admin@easychik.com']);
        $currentEncadrement = $classe->currentEncadrement();
        // dd($currentEncadrement);

        return view('classe.classes')
            ->with('page_name', $this->page . ' / Edit')
            ->with('self', $classe)
            ->with('niveaux', $niveaux)
            ->with('sections', $sections)
            ->with('users', $users)
            ->with('encadrement', $currentEncadrement)
            ->with('items', $classes);
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
            'niveau' => ['required', 'string', 'max:255'],
            'nom' => ['required', 'string', 'max:255'],
            'section' => ['required', 'string', 'max:255'],
        ]);

        $classe = Classe::find($id);
        $classe->nom = $request->nom;
        
        $section = Section::findOrFail($request->section);
        $niveau = Niveau::findOrFail($request->niveau);
        
        $classe->niveau()->associate($niveau);
        $classe->section()->associate($section);

        $classe->save();
        Logfile::updateLog(
            'classes',
            $classe->id
        );

        return redirect()->route("classes.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classe = Classe::find($id);
        $classe->delete();
        Logfile::deleteLog(
            'classes',
            $classe->id
        );
        return redirect()->route("classes.index");
    }

    public function resultatPeriode($id, $periode_id, $annee_scolaire_id)
    {
        $classe = Classe::findOrFail($id);
        $periode = Periode::findOrFail($periode_id);
        $annee = AnneeScolaire::findOrFail($annee_scolaire_id);
        // $eleves = $classe->elevesAnnee($annee);

        $classResults = $classe->resultats();
        $res = array();
        // dd($classResults);
        foreach ($classResults as $resultat) {
            if ($resultat->frequentation->eleve !== null) {
                $data = array();
                $data['resultat'] = $this->checkPeriode($resultat, $periode);
                $data['eleve'] = $resultat->frequentation->eleve->nomComplet();
                $data['id'] = $resultat->frequentation->eleve->id;
                array_push($res, $data);
            }
        }
        arsort($res);
        $resultats = array();
        foreach ($res as $final) {
            array_push($resultats, $final);
        }
        // dd($resultats);  

        return view('classe.resultats')
            ->with('page_name', "Classes / " . $classe->nomCourt() . "  / Resultat / Periode")
            ->with('annee_scolaire', $annee)
            ->with('periode', $periode)
            ->with('data', $resultats)
            ->with('classe', $classe);
    }
    public function resultatTrimestre($id, $trimestre_id, $annee_scolaire_id)
    {
        $classe = Classe::findOrFail($id);
        $trimestre = Trimestre::findOrFail($trimestre_id);
        $annee = AnneeScolaire::findOrFail($annee_scolaire_id);
        // $eleves = $classe->elevesAnnee($annee);

        $classResults = $classe->resultats();
        $res = array();
        // dd($trimestre);
        // dd($classResults);
        foreach ($classResults as $resultat) {
            if ($resultat->frequentation->eleve !== null) {
                $data = array();
                $data['resultat'] = $this->checkTrimestre($resultat, $trimestre);
                $data['eleve'] = $resultat->frequentation->eleve->nomComplet();
                $data['id'] = $resultat->frequentation->eleve->id;
                array_push($res, $data);
            }
        }
        arsort($res);
        $resultats = array();
        foreach ($res as $final) {
            array_push($resultats, $final);
        }

        return view('classe.resultats')
            // ->with('page_name', "Resultats / Classe")
            ->with('page_name', "Classes / " . $classe->nomCourt() . "  / Resultat / Trimestre")
            ->with('annee_scolaire', $annee)
            ->with('trimestre', $trimestre)
            ->with('data', $resultats)
            ->with('classe', $classe);
    }
    public function resultatAnnee($id, $annee_scolaire_id)
    {
        $classe = Classe::findOrFail($id);
        $annee = AnneeScolaire::findOrFail($annee_scolaire_id);

        $classResults = $classe->resultats();
        $res = array();
        // dd($trimestre);
        // arsort($classResults);
        foreach ($classResults as $resultat) {
            // dd($resultat);
            if ($resultat->frequentation->eleve !== null) {
                $data = array();
                $data['resultat'] = $resultat->annee;
                $data['eleve'] = $resultat->frequentation->eleve->nomComplet();
                $data['id'] = $resultat->frequentation->eleve->id;
                array_push($res, $data);
            }
        }
        arsort($res);
        $resultats = array();
        foreach ($res as $final) {
            array_push($resultats, $final);
        }

        return view('classe.resultats')
            // ->with('page_name', "Resultats / Classe")
            ->with('page_name', "Classes / " . $classe->nomCourt() . "  / Resultat / Annee")
            ->with('annee_scolaire', $annee)
            ->with('data', $resultats)
            ->with('classe', $classe);
    }


    //methods
    public function checkPeriode($resultat, $periode)
    {
        // $data ;
        switch ($periode->nom) {
            case 'PREMIERE PERIODE':
                $data = $resultat->periode1;
                break;
            case 'DEUXIEME PERIODE':
                $data = $resultat->periode2;
                break;
            case 'TROISIEME PERIODE':
                $data = $resultat->periode3;
                break;
            case 'QUATRIEME PERIODE':
                $data = $resultat->periode4;
                break;
        }

        return $data;
    }

    public function checkTrimestre($resultat, $trimestre)
    {
        // dd($trimestre);
        $trim = 0.00;
        switch ($trimestre->nom) {
            case 'PREMIER SEMESTRE':
                $trim = $resultat->trimestre1;
                break;
            case 'DEUXIEME SEMESTRE':
                $trim = $resultat->trimestre2;
                break;
        }

        return $trim;
    }

    ///paiemnts
    public function fichePaiements($id)
    {
        $classe = Classe::findOrFail($id);
        $eleves = $classe->eleves();
        $frais = $classe->frais();

        $datas = [];

        foreach ($frais as $frai) {
            $data['frais'] = $frai;
            $data["solde"] = [];
            $data["non-solde"] = [];
            $totalFrais = (int)$frai->montant;
            foreach ($eleves as $eleve) {
                $paid = 0;
                $paiements = $eleve->currentFrequentation()->paiement_frais;
                foreach ($paiements as $paiement) {
                    if ($frai->id === $paiement->frais->id) {
                        $paid += (int)$paiement->montant_paye;
                    }
                }
                $holder = [];
                // dd($paid);
                if ($totalFrais === $paid) {
                    $holder['eleve'] = $eleve;
                    $holder['montant'] = $paid;
                    $data["solde"][] = $holder;
                } else {
                    $holder['eleve'] = $eleve;
                    $holder['montant'] = $paid;
                    $data["non-solde"][] = $holder;
                }
            }
            $datas[] = $data;
        }
        // dd($datas);
        return view('classe.fiche')
            ->with('page_name', "Classes / " . $classe->nomCourt() . " / Fiche des Paies")
            ->with('items', $datas)
            ->with('classe', $classe);
    }

    public function fichePaiementsFraisSolde($id_classe, $id_frais)
    {
        $classe = Classe::findOrFail($id_classe);
        $frais = Frais::findOrFail($id_frais);
        $eleves = $classe->eleves();
        $annee = AnneeScolaire::current();


        $datas = [];

        $data = [];
        $totalFrais = (int)$frais->montant;
        foreach ($eleves as $eleve) {
            $paid = 0;
            $paiements = $eleve->currentFrequentation()->paiement_frais;
            foreach ($paiements as $paiement) {
                if ($frais->id === $paiement->frais->id) {
                    $paid += (int)$paiement->montant_paye;
                }
            }
            $holder = [];
            // dd($paid);
            if ($totalFrais === $paid) {
                $holder['eleve'] = $eleve;
                $holder['montant'] = $paid;
                $datas[] = $holder;
            }
        }
        // $datas[] = $holder;

        // dd($datas);

        return view('classe.solde')
            ->with('page_name', "Classes / " . $classe->nomCourt() . " / $frais->nom")
            ->with('items', $datas)
            ->with('frais', $frais)
            ->with('annee', $annee)
            ->with('classe', $classe);
    }

    public function fichePaiementsFraisNonSolde($id_classe, $id_frais)
    {
        $classe = Classe::findOrFail($id_classe);
        $frais = Frais::findOrFail($id_frais);
        $eleves = $classe->eleves();
        $annee = AnneeScolaire::current();

        $datas = [];

        $data = [];
        $totalFrais = (int)$frais->montant;
        foreach ($eleves as $eleve) {
            $paid = 0;
            $paiements = $eleve->currentFrequentation()->paiement_frais;
            foreach ($paiements as $paiement) {
                if ($frais->id === $paiement->frais->id) {
                    $paid += (int)$paiement->montant_paye;
                }
            }
            $holder = [];
            // dd($paid);
            if ($totalFrais > $paid) {
                $holder['eleve'] = $eleve;
                $holder['montant'] = $paid;
                $datas[] = $holder;
            }
        }
        // $datas[] = $data;

        // dd($datas);

        return view('classe.non-solde')
            ->with('page_name', "Classes / " . $classe->nomCourt() . " / $frais->nom")
            ->with('items', $datas)
            ->with('frais', $frais)
            ->with('annee', $annee)
            ->with('classe', $classe);
    }
}
