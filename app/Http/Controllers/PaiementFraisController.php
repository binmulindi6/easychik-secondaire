<?php

namespace App\Http\Controllers;

use App\Models\AnneeScolaire;
use App\Models\Eleve;
use App\Models\Frais;
use App\Models\Niveau;
use App\Models\TypeFrais;
use App\Models\ModePaiement;
use App\Models\MoyenPaiement;
use App\Models\PaiementFrais;
use Illuminate\Http\Request;

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
        $frais = PaiementFrais::latest()->get();
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
                ->limit(10)
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
            $frais = $eleve->classe()->niveau->frais;
            $moyens = MoyenPaiement::all();
            $paiements = PaiementFrais::latest()->limit(10)->get();

            return view('frais.paiement')
                    ->with('page_name', $this->page_name . ' / Create')
                    ->with('eleve', $eleve)
                    ->with('frais', $frais)
                    ->with('moyens', $moyens)
                    ->with('items', $paiements);
        }else{
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
            'reference' => ['string']
        ]);

        $frais = Frais::find($request->frais);
        $eleve = Eleve::find($request->eleve);
        $moyen = MoyenPaiement::find($request->moyen_paiement);
        
        //le montant est inferieur au montant attendu
        if((int)$frais->montant >= (int)$request->montant){
            $paiements = $eleve->currentFrequentation()->paiement_frais;
                $total = 0;
                foreach($paiements as $paye) {
                    if($paye->frais->id === $frais->id){
                        $total +=  (int)$paye->montant_paye;
                    }
                }
            //le montant attendu est inferieur au montant restant a payer
            if(((int)$frais->montant - $total) >= (int)$request->montant){
                $paiement = PaiementFrais::create([
                    'montant_paye' => $request->montant,
                    'reference' => $request->reference,
                    'date' => $request->date,
                ]);
    
                $paiement->frais()->associate($frais);
                $paiement->frequentation()->associate($eleve->currentFrequentation());
                $paiement->moyen_paiement()->associate($moyen);
                $paiement->save();
                return redirect()->route('paiements.show', $paiement->id);
            }
            return redirect()->route('paiements.linkEleve', $eleve->id)->withErrors([
                'montant' => 'Le Montant saisi de ' . $request->montant .' est supperieure au montant restant à payer par l\'élève '. $eleve->nom. '' ,
                ])->onlyInput('montant');
        }        
        return redirect()->route('paiements.linkEleve', $eleve->id)->withErrors([
            'montant' => 'Le Montant saisi de ' . $request->montant .' est supperieure au montant total à payer pour \''. $frais->nom. '\'' ,
            ])->onlyInput('montant');
        // dd(10);
        // redirect()->route('paiements.show', $paiement->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paiement = PaiementFrais::find($id);
        $annee = 'Annee Scolaire ' . $paiement->frequentation->annee_scolaire->nom;
        return view('frais.facture')
                    ->with('page_name', $this->page_name . ' / Facture')
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
        $self = PaiementFrais::find($id);
        $self->delete();
        return redirect()->route('paiements.index');
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
            ->with('page_name', 'Paiements')
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
            ->with('page_name', 'Paiements')
            ->with('search',  $request->search)
            ->with('joker', '10')
            ->with('items', $items);
    }
}
