<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnneeScolaire;
use App\Models\Periode;
use App\Models\Trimestre;
use Illuminate\Http\Request;

class EcoleController extends Controller
{
    public function index (){
        $annee = AnneeScolaire::current();
        $trimestre = Trimestre::current();
        $periode = Periode::current();
        return view('admin.ecole')
                    ->with('annee', $annee)
                    ->with('trimestre', $trimestre)
                    ->with('periode', $periode)
                    ->with('page_name', "Ecole");
    }
}
