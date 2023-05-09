<?php

namespace App\Http\Controllers;

use App\Models\AnneeScolaire;
use App\Models\Frais;
use App\Models\MoyenPaiement;
use App\Models\PaiementFrais;
use App\Models\TypeFrais;
use Illuminate\Http\Request;

class RapportController extends Controller
{
    protected $page_name = 'Rapports';

    public function annuel()
    {   $annees = AnneeScolaire::all();
        $current = AnneeScolaire::current();

        $paiements = PaiementFrais::periode($current->date_debut, $current->date_fin);
        // dd($paiements);

        $fraisScolaire = TypeFrais::all();
        $moyenPaiements = MoyenPaiement::all();

        // dd(
        //     $fraisScolaire,
        //     $moyenPaiements
        // );

        $data = array();
        foreach($fraisScolaire as $frais){
            $fraisHolder = array();
            $fraisHolder['nom'] = $frais->nom;
            $fraisHolder['paiements'] = array();
            $fraisHolder['devise'] = $frais->devise;
            $fraisHolder['total'] = 0;
            foreach($moyenPaiements as $moyen){
                // $moyenHolder = array();
                $moyenHolder['nom'] = $moyen->nom;
                // echo $moyen->nom;
                $montant = 0;
                foreach($paiements as $paiement){
                    if($paiement->moyen_paiement->id === $moyen->id && $paiement->frais->type_frais_id === $frais->id){
                        $montant += $paiement->montant_paye;
                    }
                }
                $moyenHolder['montant'] = $montant;
                $fraisHolder['total'] += $montant;
                array_push($fraisHolder['paiements'],$moyenHolder);
            }
            array_push($data, $fraisHolder);
        }
        // dd($data);

        return view('rapports.annuel')
            ->with('paiements', $data)
            ->with('annees', $annees)
            ->with('current', $current)
            ->with('page_name', $this->page_name . " / Annuel ". $current->nom);
    }

    public function periode()
    {   
        $date = date('Y-m-d');
        return view('rapports.periode')
            ->with('today', $date)
            ->with('page_name', $this->page_name . " / Periodique");
    }

    public function rapportPeriode(Request $request){
        $request->validate([
            'date_debut' => ['date', 'max:255', 'required'],
            'date_fin' => ['date', 'max:255', 'required'],
        ]);
        // dd(10);
        $paiements = PaiementFrais::periode($request->date_debut, $request->date_fin);
        // dd($paiements);

        $fraisScolaire = TypeFrais::all();
        $moyenPaiements = MoyenPaiement::all();

        // dd(
        //     $fraisScolaire,
        //     $moyenPaiements
        // );
        $date = date('Y-m-d');
        $data = array();
        foreach($fraisScolaire as $frais){
            $fraisHolder = array();
            $fraisHolder['nom'] = $frais->nom;
            $fraisHolder['paiements'] = array();
            $fraisHolder['devise'] = $frais->devise;
            $fraisHolder['total'] = 0;
            foreach($moyenPaiements as $moyen){
                // $moyenHolder = array();
                $moyenHolder['nom'] = $moyen->nom;
                // echo $moyen->nom;
                $montant = 0;
                foreach($paiements as $paiement){
                    if($paiement->moyen_paiement->id === $moyen->id && $paiement->frais->type_frais_id === $frais->id){
                        $montant += $paiement->montant_paye;
                    }
                }
                $moyenHolder['montant'] = $montant;
                $fraisHolder['total'] += $montant;
                array_push($fraisHolder['paiements'],$moyenHolder);
            }
            array_push($data, $fraisHolder);
        }
        // dd($data);


        return view('rapports.periode')
            ->with('paiements', $data)
            ->with('today', $date)
            ->with('debut', $request->date_debut)
            ->with('fin', $request->date_fin)
            ->with('data', $data)
            ->with('page_name', $this->page_name . " / Periodique" );

    }
    public function rapportAnnuel(Request $request){
        $request->validate([
            'annee' => ['string', 'max:255', 'required'],
        ]);
        // dd($request->annee);
        $annees = AnneeScolaire::all();
        $current = AnneeScolaire::findOrFail($request->annee);
        $paiements = PaiementFrais::periode($current->date_debut, $current->date_fin);
        // dd($paiements);

        $fraisScolaire = TypeFrais::all();
        $moyenPaiements = MoyenPaiement::all();

        // dd(
        //     $fraisScolaire,
        //     $moyenPaiements
        // );

        $data = array();
        foreach($fraisScolaire as $frais){
            $fraisHolder = array();
            $fraisHolder['nom'] = $frais->nom;
            $fraisHolder['paiements'] = array();
            $fraisHolder['devise'] = $frais->devise;
            $fraisHolder['total'] = 0;
            foreach($moyenPaiements as $moyen){
                // $moyenHolder = array();
                $moyenHolder['nom'] = $moyen->nom;
                // echo $moyen->nom;
                $montant = 0;
                foreach($paiements as $paiement){
                    if($paiement->moyen_paiement->id === $moyen->id && $paiement->frais->type_frais_id === $frais->id){
                        $montant += $paiement->montant_paye;
                    }
                }
                $moyenHolder['montant'] = $montant;
                $fraisHolder['total'] += $montant;
                array_push($fraisHolder['paiements'],$moyenHolder);
            }
            array_push($data, $fraisHolder);
        }
        // dd($data);


       
        return view('rapports.annuel')
            ->with('paiements', $data)
            ->with('annees', $annees)
            ->with('current', $current)
            ->with('page_name', $this->page_name . " / Annuel ". $current->nom);

    }
}
