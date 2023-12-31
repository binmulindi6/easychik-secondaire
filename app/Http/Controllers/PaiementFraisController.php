<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\Frais;
use App\Models\Niveau;
use App\Models\Logfile;
use App\Models\TypeFrais;
use App\Models\ModePaiement;
use Illuminate\Http\Request;
use App\Models\AnneeScolaire;
use App\Models\Ecole;
use App\Models\MoyenPaiement;
use App\Models\PaiementFrais;
use Illuminate\Support\Facades\Auth;

class PaiementFraisController extends Controller
{
    protected $page_name = "Paiements";
    protected $error;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $frais = PaiementFrais::current();
        $types = TypeFrais::all();
        $niveaux = Niveau::all();
        $modes = ModePaiement::all();

        return view('frais.paiement')
            ->with('items', $frais)
            ->with('types', $types)
            ->with('niveaux', $niveaux)
            ->with('modes', $modes)
            ->with('page_name', $this->page_name);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $eleves = Eleve::latest()
            ->limit(20)
            ->get();

        return view('frais.eleves')
            ->with('page_name', $this->page_name)
            ->with('joker', '10')
            ->with('error', $this->error)
            ->with('items', $eleves);
    }
    public function linkEleve($id)
    {
        // dd($this->error);
        $eleve = Eleve::findOrFail($id);
        if ($eleve->classe()) {
            $frais = $eleve->classe()->frais();
            $paiementsEleve = $eleve->currentFrequentation()->paiement_frais;
            $fraisNoPaye = []; //total payE
            // $i = 1;
            $total = 0;
            foreach ($frais as $frai) {
                foreach ($paiementsEleve as $paye) {
                    if ($paye->frais->id === $frai->id) {
                        $total +=  (int)$paye->montant_paye;
                    }
                }
                //le montant total a payE est superieur au montant dja payE
                if ((int)$frai->montant > $total) {
                    $fraisNoPaye = $frai->id;
                }
                // $i++;
            }
            // dd($frais);
            // dd($fraisNoPaye);

            $moyens = MoyenPaiement::all();
            $paiements = PaiementFrais::latest()->limit(10)->get();

            return view('frais.paiement')
                ->with('page_name', $this->page_name . ' / Create')
                ->with('eleve', $eleve)
                ->with('frais', $frais)
                ->with('moyens', $moyens)
                ->with('items', $paiements);
        } else {
            $this->error = $eleve->nomComplet();
            return $this->create();
        }
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
            'eleve' => ['required', 'string', 'max:255'],
            'frais' => ['required', 'string', 'max:10'],
            'montant' => ['required', 'string', 'max:255'],
            'moyen_paiement' => ['required', 'string', 'max:255'],
            'date' => ['required', 'string', 'max:255'],
            'deposer_par' => ['required', 'string', 'max:255'],
            // 'reference' => ['string']
        ]);

        if (AnneeScolaire::current()->isActive()) {
            $frais = Frais::find($request->frais);
            $eleve = Eleve::find($request->eleve);
            $moyen = MoyenPaiement::find($request->moyen_paiement);

            //le montant payer est inferieur ou egale au montant attendu(A PAYER pour le frais)
            if ((int)$frais->montant >= (int)$request->montant) {
                $paiements = $eleve->currentFrequentation()->paiement_frais;
                $total = 0; //total payE
                foreach ($paiements as $paye) {
                    if ($paye->frais->id === $frais->id) {
                        $total +=  (int)$paye->montant_paye;
                    }
                }
                if ((int)$frais->montant !== $total) {
                    //le montant restant a payE est superieur ou egal au montant payer
                    if (((int)$frais->montant - $total) >= (int)$request->montant) {

                        if ($request->reference !== null) {
                            $paiement = PaiementFrais::create([
                                'montant_paye' => $request->montant,
                                'reference' => $request->reference,
                                'date' => $request->date,
                                'deposer_par' => $request->deposer_par,
                                
                            ]);
                        } else {
                            $paiement = PaiementFrais::create([
                                'montant_paye' => $request->montant,
                                'deposer_par' => $request->deposer_par,
                                'date' => $request->date,
                            ]);
                        }

                        $paiement->frais()->associate($frais);
                        $paiement->user()->associate(Auth::user());
                        $paiement->frequentation()->associate($eleve->currentFrequentation());
                        $paiement->moyen_paiement()->associate($moyen);
                        $paiement->save();
                        Logfile::createLog(
                            'paiement_frais',
                            $paiement->id
                        );
                        return redirect()->route('paiements.show', $paiement->id);
                    }
                    return redirect()->route('paiements.linkEleve', $eleve->id)->withErrors([
                        'montant' => 'Le Montant saisi de ' . $request->montant . $frais->type_frais->devise . ' est supperieur au montant restant à payer par l\'élève ' . $eleve->nom . ', le montant restant est de : ' . (int)$frais->montant - $total . $frais->type_frais->devise . ' pour \'' . $frais->nom . '',
                    ])->onlyInput('montant');
                }
                return redirect()->route('paiements.linkEleve', $eleve->id)->withErrors([
                    'montant' => 'L\'élève ' . $eleve->nom . ', a déjà payé la totalité attendu pour le(la) ' . $frais->nom . '',
                ])->onlyInput('montant');
            }
            return redirect()->route('paiements.linkEleve', $eleve->id)->withErrors([
                'montant' => 'Le Montant saisi de ' . $request->montant . $frais->type_frais->devise . ' est supperieur au montant total à payer pour \'' . $frais->nom . '\' qui est de ' . $frais->montant . $frais->type_frais->devise . ' ',
            ])->onlyInput('montant');
            // dd(10);
            // redirect()->route('paiements.show', $paiement->id);
        }
        return redirect()->back()->withErrors([
            "Vous ne pouvez pas effectuer des operations sur les Archives",
        ])->onlyInput('nom');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $ecole = Ecole::first();
        $paiement = PaiementFrais::find($id);
        $annee = 'Annee Scolaire ' . $paiement->frequentation->annee_scolaire->nom;
        return view('frais.facture')
            ->with('page_name', $this->page_name . ' / Facture')
            ->with('ecole', $ecole)
            ->with('annee', $annee)
            ->with('self', $paiement);

        // dd($paiement);
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
        if (AnneeScolaire::current()->isActive()) {
            $self = PaiementFrais::find($id);
            $self->delete();

            Logfile::deleteLog(
                'paiement_frais',
                $self->id
            );
            return redirect()->route('paiements.index');
        }
        return redirect()->back()->withErrors([
            "Vous ne pouvez pas effectuer des operations sur les Archives",
        ])->onlyInput('nom');
    }



    public function search(Request $request)
    {
        $items = PaiementFrais::join('frequentations', 'frequentations.id', 'paiement_frais.frequentation_id')
            ->join('eleves', 'eleves.id', 'frequentations.eleve_id')
            ->where('eleves.nom', 'like', '%' . $request->search . '%')
            ->orWhere('eleves.prenom', 'like', '%' . $request->search . '%')
            ->select('paiement_frais.*')
            ->get();

        // dd($items);
        return view('frais.paiement')
            ->with('page_name', 'Paiements / Search')
            ->with('search',  $request->search)
            ->with('joker', '10')
            ->with('items', $items);
    }

    public function searchEleve(Request $request)
    {
        $items = Eleve::where('nom', 'like', '%' . $request->search . '%')
            ->orWhere('matricule', 'like', '%' . $request->search . '%')
            ->orWhere('lieu_naissance', 'like', '%' . $request->search . '%')
            ->orWhere('prenom', 'like', '%' . $request->search . '%')
            ->get();

        return view('frais.eleves')
            ->with('page_name', 'Paiements / Search / Eleve')
            ->with('search',  $request->search)
            ->with('joker', '10')
            ->with('items', $items);
    }
}
