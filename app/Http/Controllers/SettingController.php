<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnneeScolaire;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Date\DateController;

class SettingController extends Controller
{
    protected $page = "Parametres";
    public function index(Request $request)
    {   
        $annees = AnneeScolaire::orderBy('nom')->get();
        $current = AnneeScolaire::current();
        // dd(Auth::user()->classe());
        
        return view('settings.settings')
                    ->with('page_name', $this->page)
                    ->with('current', $current)
                    ->with("annees",$annees);
                    
    }

     public function store(Request $request)
    {
        $request->validate([
            'annee' => ['string', 'required']
        ]);

        $annee = AnneeScolaire::findOrFail($request->annee);
        $request->session()->put('currentYear', $annee);
        return redirect()->route('settings.index');
    }

    public static function checkYear(){
        // if($request->session()->get('currentYear') !== null){
        //     return DateController::currentAnnee();
        // }
        // return $request->session()->get('currentYear');
    }

}
