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
        $annee = AnneeScolaire::current();
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
                if ($classe->id === $freq->classe->id) {
                    // dd($freq->eleve->sexe);
                    if (isset($freq->eleve) && $freq->eleve->sexe === 'M') {
                        $holder['garcons'][] = $freq;
                        $total++;
                        $filles++;
                    } else {
                        if (isset($freq->eleve) && $freq->eleve->sexe === 'F') {
                            $holder['filles'][] = $freq;
                            $total++;
                            $garcons++;
                        }
                    }
                }
            }
            $datas[] = $holder;
        }




            $employers = Employer::count() > 0 ? Employer::count() : 0;
            $hommes = count(Employer::where('sexe','M')->get()) > 0 ? count(Employer::where('sexe','M')->get()) : 0;
            $classes = Classe::count() > 0 ? Classe::count() : 0;

            $classesEncadrees = [];
            foreach(Classe::all() as $classe){
                if($classe->user() !== null){
                    $classesEncadrees[] = $classe;
                }
            }

            $users = User::where('employer_id','=',null)->count() > 0 ? User::where('employer_id','=',null)->count() : 0;
            $usersActifs = count(User::where('isActive','1')->where('employer_id','=',null)->get()) > 0 ? count(User::where('isActive','1')->where('employer_id','=',null)->get()) : 0;
            return view('dashboard', [
                'page_name' => 'Dashboard',
                'eleves' => $total,
                'employers' => $employers,
                'hommes' => $hommes,
                'classes' => $classes,
                'filles' => $filles,
                'garcons' =>$garcons,
                'classesEncadrees' =>count($classesEncadrees),
                'users' => $users,
                'usersActifs' => $usersActifs,
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