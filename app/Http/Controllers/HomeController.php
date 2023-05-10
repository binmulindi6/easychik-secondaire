<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Eleve;
use App\Models\Classe;
use App\Models\Periode;
use App\Models\Employer;
use App\Models\Trimestre;
use Illuminate\Http\Request;
use App\Models\AnneeScolaire;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Date\DateController;
use App\Models\Frequentation;

class HomeController extends Controller
{
    public function index()
    {   
        if(Auth::user()->isAdmin() || Auth::user()->isDirecteur()){
            $eleves = Eleve::count() > 0 ? Eleve::count() : 0;
            $employers = Employer::count() > 0 ? Employer::count() : 0;
            $classes = Classe::count() > 0 ? Classe::count() : 0;
            $users = User::count() > 0 ? User::count() : 0;
            return view('dashboard', [
                'page_name' => 'Dashboard',
                'eleves' => $eleves,
                'employers' => $employers,
                'classes' => $classes,
                'users' => $users,
            ]);
        }

        
        // if(Auth::user()->isEnseignant()){
            
        //     $eleves = Eleve::count() > 0 ? Eleve::count() : 0;
        //     $employers = Employer::count() > 0 ? Employer::count() : 0;
        //     $classes = Classe::count() > 0 ? Classe::count() : 0;
        //     $users = User::count() > 0 ? User::count() : 0;
        //     return view('dashboard', [
        //         'page_name' => 'Dashboard',
        //         'eleves' => $eleves,
        //         'employers' => $employers,
        //         'classes' => $classes,
        //         'users' => $users,
        //     ]);
        // }
        if (DateController::checkYears()) {
            if (DateController::checkTrimestres()) {
                if (DateController::checkPeriodes()) {
                    $annee = AnneeScolaire::current();
                    $trimestre = Trimestre::current();
                    $periode = Periode::current();
                    return view('dashboard')
                        ->with('annee', $annee)
                        ->with('trimestre', $trimestre)
                        ->with('periode', $periode)
                        ->with('page_name', "Dashboard");
                }
                return view('origin')->with('order', "periode");
            }
            return view('origin')->with('order', "trimestre");
        }
        return view('origin')->with('order', "year");

    }

    public function chart()
        {
        
            $annee = AnneeScolaire::orderBy('nom')->get();
            $freq = Frequentation::all();
            $data = array();
            $data['annees'] = array('2020-2021');  
            $data['frequentations'] = array('0');  
            foreach($annee as $year){
                $freqs = count($year->frequentations);
                array_push($data['annees'], $year->nom);
                array_push($data['frequentations'], $freqs);
            }

            // dd($data);
           return $data;
        }
}