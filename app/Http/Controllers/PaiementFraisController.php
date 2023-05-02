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

        $paiement = PaiementFrais::create([
            'montant_paye' => $request->montant,
            'reference' => $request->reference,
            'date' => $request->date,
        ]);

        $frais = Frais::find($request->frais);
        $eleve = Eleve::find($request->eleve);
        $moyen = MoyenPaiement::find($request->moyen_paiement);

        $paiement->frais()->associate($frais);
        $paiement->frequentation()->associate($eleve->currentFrequentation());
        $paiement->moyen_paiement()->associate($moyen);
        $paiement->save();
        return redirect()->route('paiements.index');
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
