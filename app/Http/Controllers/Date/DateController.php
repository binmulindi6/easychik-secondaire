<?php

namespace App\Http\Controllers\Date;

use App\Models\Periode;
use App\Models\Trimestre;
use Illuminate\Http\Request;
use App\Models\AnneeScolaire;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Date;

use function Termwind\render;

class DateController extends Controller
{
    //check if the dB has atleast one AnneeScolaires record

    public static function checkYears()
    {
        $years = AnneeScolaire::count();
        // dd($years);
        if ($years > 0) {
            return true;
        }
        return false;
    }

    //check if the current year 3 Trimestres record associated

    public static function checkTrimestres()
    {
        $year = AnneeScolaire::current();
        // dd($year);
        if ($year->trimestres()->count() === 3) {
            return true;
        }
        return false;
    }

    //check if every Trimestres of  the current year has 2 Periodes  record associated

    public static function checkPeriodes()
    {
        $year = AnneeScolaire::current();
        $trimestres = $year->trimestres;
        //dd($trimestres[2]->periodes()->count());

        foreach ($trimestres as $trimestre) {
            if ($trimestre->periodes()->count() === 2) {
                return true;
            }
        }
        return false;
    }

    public static function currentAnnee()
    {

        //$x = strtotime(date("Y-m-d"));

        $today = strtotime(date("Y-m-d"));

        //$currentAnneeScolaire = AnneeScolaire::where('is_current', 1)->first();
        $anneeScolaires = AnneeScolaire::orderBy('nom')->get();

        // dd($anneeScolaires);

        foreach ($anneeScolaires as $anneeScolaire) {
            $debut = strtotime($anneeScolaire->date_debut);
            $fin = strtotime($anneeScolaire->date_fin);

            if ($today > $debut && $today < $fin) {
                return $anneeScolaire;
            }
        }
        if (AnneeScolaire::where('selected', 1)->first()) {
            //dd(10);
            return AnneeScolaire::where('selected', 1)->first();
        }
        //dd(11);
        return AnneeScolaire::orderBy('nom', 'desc')->first();
    }


    public static function currentTrimestre()
    {

        $today = strtotime(date("Y-m-d"));
        $currentAnneeScolaire = AnneeScolaire::current();
        $trimestres = Trimestre::where('annee_scolaire_id', $currentAnneeScolaire->id)->get();
        // if ($trimestres->count() < 3) {
            //     dd(11);
            // }
            // dd($trimestres);
            foreach ($trimestres as $trimestre) {
            $debut = strtotime($trimestre->date_debut);
            $fin = strtotime($trimestre->date_fin);
            if ($today > $debut && $today < $fin) {
                return $trimestre;
            }
        }
        $lastIndex = $trimestres->count() - 1;
        return $trimestres[$lastIndex];
    }


    public static function currentPeriode()
    {

        $today = strtotime(date("Y-m-d"));
        $currentPeriode = AnneeScolaire::current();


        $periodes = Periode::where('trimestre_id', $currentPeriode->id)->get();
        //dd($periodes);
        foreach ($periodes as $periode) {
            $debut = strtotime($periode->date_debut);
            $fin = strtotime($periode->date_fin);
            if ($today > $debut && $today < $fin) {
                return $periode;
            }
        }
        $lastIndex = $periodes->count() - 1;
        //dd($periodes[$lastIndex]);
        return $periodes[$lastIndex];
    }

    public function test()
    {
        $periode = Periode::current();
        if ($periode->isCurrent()) {
            dd(true);
        }
        dd(false);
    }


    public function _current()
    {
        ///
        //$date = date("Y-m-d");
        $x = strtotime(date("Y-m-d"));

        $now = Date::createfromformat("Y-m-d", date("Y-m-d"));
        $today = date_timestamp_get($now);

        $currentAnneeScolaire = AnneeScolaire::where('is_current', 1)->first();
        $date_debut = Date::createfromformat("Y-m-d", $currentAnneeScolaire->date_debut);
        $debut = date_timestamp_get($date_debut);

        $date_fin = Date::createfromformat("Y-m-d", $currentAnneeScolaire->date_fin);
        $fin = date_timestamp_get($date_fin);

        if ($today > $date_debut && $today < $date_fin) {
            dd(true);
        }
        dd(false);
    }
}