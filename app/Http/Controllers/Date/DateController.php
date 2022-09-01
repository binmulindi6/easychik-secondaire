<?php

namespace App\Http\Controllers\Date;

use App\Models\Periode;
use App\Models\Trimestre;
use Illuminate\Http\Request;
use App\Models\AnneeScolaire;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Date;


class DateController extends Controller
{


    public static function currentAnnee(){

        $x = strtotime(date("Y-m-d"));

        $today = strtotime(date("Y-m-d"));
        
        //$currentAnneeScolaire = AnneeScolaire::where('is_current', 1)->first();
        $anneeScolaires = AnneeScolaire::all();
        foreach($anneeScolaires as $anneeScolaire){
            $debut = strtotime($anneeScolaire->date_debut);
            $fin = strtotime($anneeScolaire->date_fin);
            
            if($today > $debut && $today < $fin){
                return $anneeScolaire;
            }
        }
        return false;
    }


    public static function currentTrimestre(){

        $today = strtotime(date("Y-m-d"));
        $currentAnneeScolaire = DateController::currentAnnee();
        
        $trimestres = Trimestre::where('annee_scolaire_id', $currentAnneeScolaire->id)->get();
        foreach($trimestres as $trimestre){
            $debut = strtotime($trimestre->date_debut);
            $fin = strtotime($trimestre->date_fin);
            if($today > $debut && $today < $fin){
                return $trimestre;
            }

        }
        dd(false);
        
    }

    
    public static function currentPeriode(){
        
        $today = strtotime(date("Y-m-d"));
        $currentPeriode = DateController::currentTrimestre();
        
        $periodes = Periode::where('trimestre_id', $currentPeriode->id)->get();
        foreach($periodes as $periode){
            $debut = strtotime($periode->date_debut);
            $fin = strtotime($periode->date_fin);
            if($today > $debut && $today < $fin){
                return $periode;
            }
            
        }
        dd(false);
        
    }
    
    public function test(){
        $periode = Periode::current();
        if($periode->isCurrent()){
            dd(true);
        }
        dd(false);
    }


    public function _current(){
        ///
        //$date = date("Y-m-d");
        $x = strtotime(date("Y-m-d"));
        
        $now = Date::createfromformat("Y-m-d",date("Y-m-d"));
        $today = date_timestamp_get($now);
        
        $currentAnneeScolaire = AnneeScolaire::where('is_current', 1)->first();
        $date_debut = Date::createfromformat("Y-m-d",$currentAnneeScolaire->date_debut);
        $debut = date_timestamp_get($date_debut);

        $date_fin = Date::createfromformat("Y-m-d",$currentAnneeScolaire->date_fin);
        $fin = date_timestamp_get($date_fin);
        
        if($today > $date_debut && $today < $date_fin){
            dd(true);
        }
        dd(false);


    
    }
}
