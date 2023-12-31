<?php

namespace App\Http\Controllers;

use App\Models\Frais;
use App\Models\Classe;
use App\Models\Article;
use App\Models\TypeFrais;
use Illuminate\Http\Request;
use App\Models\AnneeScolaire;
use App\Models\MoyenPaiement;
use App\Models\PaiementFrais;
use App\Http\Controllers\Date\DateController;

class RapportController extends Controller
{
    protected $page_name = 'Rapports';

    public function index()
    {
        return view('rapports.index')
            ->with('page_name', 'Rapports')
            ->with('page_name', 'Rapports');
    }

    public function annuel()
    {
        if (DateController::checkYears()) {
            $annees = AnneeScolaire::orderBy('nom')->get();
            $current = AnneeScolaire::current();

            $paiements = PaiementFrais::periode($current->date_debut, $current->date_fin) ? PaiementFrais::periode($current->date_debut, $current->date_fin) : null;
            // dd($paiements);

            $fraisScolaire = TypeFrais::all();
            $moyenPaiements = MoyenPaiement::all();

            // dd(
            //     $fraisScolaire,
            //     $moyenPaiements
            // );

            $data = array();
            foreach ($fraisScolaire as $frais) {
                $fraisHolder = array();
                $fraisHolder['nom'] = $frais->nom;
                $fraisHolder['paiements'] = array();
                $fraisHolder['devise'] = $frais->devise;
                $fraisHolder['total'] = 0;
                foreach ($moyenPaiements as $moyen) {
                    // $moyenHolder = array();
                    $moyenHolder['nom'] = $moyen->nom;
                    // echo $moyen->nom;
                    $montant = 0;
                    foreach ($paiements as $paiement) {
                        if ((int)$paiement->moyen_paiement->id === (int)$moyen->id && (int)$paiement->frais->type_frais_id === (int)$frais->id) {
                            $montant += $paiement->montant_paye;
                        }
                    }
                    $moyenHolder['montant'] = $montant;
                    $fraisHolder['total'] += $montant;
                    array_push($fraisHolder['paiements'], $moyenHolder);
                }
                array_push($data, $fraisHolder);
            }
            // dd($data);

            return view('rapports.annuel')
                ->with('paiements', $data)
                ->with('annees', $annees)
                ->with('current', $current)
                ->with('page_name', $this->page_name . " / Perception Frais  / Annuel " . $current->nom);
        }
        return view('origin')
            ->with('order', "year")
            ->with('page_name', "Ecole");
    }

    public function periode()
    {
        $date = date('Y-m-d');
        return view('rapports.periode')
            ->with('today', $date)
            ->with('page_name', $this->page_name . " / Perception Frais  / Periodique");
    }
    public function stock()
    {
        $date = date('Y-m-d');
        return view('rapports.stock')
            ->with('today', $date)
            ->with('page_name', $this->page_name . " / Etat de Stock  / Periodique");
    }

    public function rapportPeriode(Request $request)
    {
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
        foreach ($fraisScolaire as $frais) {
            $fraisHolder = array();
            $fraisHolder['nom'] = $frais->nom;
            $fraisHolder['paiements'] = array();
            $fraisHolder['devise'] = $frais->devise;
            $fraisHolder['total'] = 0;
            foreach ($moyenPaiements as $moyen) {
                // $moyenHolder = array();
                $moyenHolder['nom'] = $moyen->nom;
                // echo $moyen->nom;
                $montant = 0;
                foreach ($paiements as $paiement) {
                    if ((int)$paiement->moyen_paiement->id === (int)$moyen->id && (int)$paiement->frais->type_frais_id === (int)$frais->id) {
                        $montant += $paiement->montant_paye;
                    }
                }
                $moyenHolder['montant'] = $montant;
                $fraisHolder['total'] += $montant;
                array_push($fraisHolder['paiements'], $moyenHolder);
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
            ->with('page_name', $this->page_name . " / Perception Frais  / Periodique");
    }
    public function rapportStock(Request $request)
    {
        $request->validate([
            'date_debut' => ['date', 'max:255', 'required'],
            'date_fin' => ['date', 'max:255', 'required'],
        ]);
        // dd(10);
        $articles = Article::orderBy('nom')->get();
        // dd($paiements);

        // $fraisScolaire = TypeFrais::all();
        // $moyenPaiements = MoyenPaiement::all();

        // dd(
        //     $fraisScolaire,
        //     $moyenPaiements
        // );
        $date = date('Y-m-d');
        $data = array();
        foreach ($articles as $frais) {
            $fraisHolder = array();
            $fraisHolder['num_serie'] = $frais->num_serie;
            $fraisHolder['nom'] = $frais->nom;
            $fraisHolder['unite'] = $frais->unite_article->nom;
            $fraisHolder['categorie'] = $frais->categorie_article->nom;
            // $fraisHolder['entrees'] = array();
            $fraisHolder['entrees'] = $frais->entreesPeriode($request->date_debut, $request->date_fin);
            $fraisHolder['sorties'] = $frais->sortiesPeride($request->date_debut, $request->date_fin);
            // $fraisHolder['stock'] = $fraisHolder['entrees'] - $fraisHolder['sorties'];

            array_push($data, $fraisHolder);
        }
        // dd($data);


        return view('rapports.stock')
            ->with('today', $date)
            ->with('debut', $request->date_debut)
            ->with('fin', $request->date_fin)
            ->with('data', $data)
            ->with('page_name', $this->page_name . " / Etat de Stock  / Periodique");
    }

    public function rapportAnnuel(Request $request)
    {
        $request->validate([
            'annee' => ['string', 'max:255', 'required'],
        ]);

        // dd($request->annee);
        $annees = AnneeScolaire::orderBy('nom')->get();
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
        foreach ($fraisScolaire as $frais) {
            $fraisHolder = array();
            $fraisHolder['nom'] = $frais->nom;
            $fraisHolder['paiements'] = array();
            $fraisHolder['devise'] = $frais->devise;
            $fraisHolder['total'] = 0;
            foreach ($moyenPaiements as $moyen) {
                // $moyenHolder = array();
                $moyenHolder['nom'] = $moyen->nom;
                // echo $moyen->nom;
                $montant = 0;
                foreach ($paiements as $paiement) {
                    if ((int)$paiement->moyen_paiement->id === (int)$moyen->id && (int)$paiement->frais->type_frais_id === (int)$frais->id) {
                        $montant += $paiement->montant_paye;
                    }
                }
                $moyenHolder['montant'] = $montant;
                $fraisHolder['total'] += $montant;
                array_push($fraisHolder['paiements'], $moyenHolder);
            }
            array_push($data, $fraisHolder);
        }
        // dd($data);



        return view('rapports.annuel')
            ->with('paiements', $data)
            ->with('annees', $annees)
            ->with('current', $current)
            ->with('page_name', $this->page_name . " / Perception Frais  / " . $current->nom);
    }

    function rapportFrequentation()
    {
        if (DateController::checkYears()) {
            $annee = AnneeScolaire::current();
            $annees = AnneeScolaire::orderBy('nom')->get();
            $freqs = $annee->frequentations;
            $classes = Classe::orderBy('niveau_id', 'asc')->get();

            $datas = [];
            $total = 0;
            $filles = 0;
            $garcons = 0;
            // dd($freqs);
            foreach ($classes as $classe) {
                $holder = [];
                $holder['classe'] = $classe;
                $holder['filles'] = [];
                $holder['garcons'] = [];
                foreach ($freqs as $freq) {
                    if (($classe !== null && $freq->classe !== null) &&($classe->id === $freq->classe->id)) {
                        // dd($freq->eleve->sexe);
                        if (isset($freq->eleve) && $freq->eleve->sexe == 'M') {
                            $holder['garcons'][] = $freq;
                            $total++;
                            $filles++;
                        } else {
                            if (isset($freq->eleve) && $freq->eleve->sexe == 'F') {
                                $holder['filles'][] = $freq;
                                $total++;
                                $garcons++;
                            }
                        }
                    }
                }
                $datas[] = $holder;
            }

            // dd($datas);

            return view('rapports.frequentations')
                ->with('items', $datas)
                ->with('annees', $annees)
                ->with('current', $annee)
                ->with('total', $total)
                ->with('filles', $filles)
                ->with('garcons', $garcons)
                ->with('page_name', $this->page_name . " / Frequentations / " . $annee->nom);
        }
        return view('origin')
            ->with('order', "year")
            ->with('page_name', "Ecole");
    }
}
