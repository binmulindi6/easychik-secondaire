<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Date\DateController;
use App\Models\AnneeScolaire;
use App\Models\Periode;
use App\Models\Trimestre;
use Illuminate\Http\Request;
use PHPUnit\Framework\Test;

class EcoleController extends Controller
{
    public function index()
    {
        // abort(888);
        if (DateController::checkYears()) {
            if (DateController::checkTrimestres()) {
                if (DateController::checkPeriodes()) {
                    $annee = AnneeScolaire::current();
                    $trimestre = Trimestre::current();
                    $periode = Periode::current();
                    return view('ecole.index')
                        ->with('annee', $annee)
                        ->with('trimestre', $trimestre)
                        ->with('periode', $periode)
                        ->with('page_name', "Ecole");
                }
                return view('origin')->with('order', "periode");
            }
            return view('origin')->with('order', "trimestre");
        }
        return view('origin')->with('order', "year");
    }
}