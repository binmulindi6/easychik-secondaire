<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\Logfile;
use App\Models\Periode;
use App\Models\Conduite;
use Illuminate\Http\Request;
use App\Models\EleveConduite;

class EleveConduiteController extends Controller
{
    public function create($eleve_id,$periode_id, $from = 1)
    {   $page = "EleveConduite / Create";
        // $frequentations = Frequentation::all();
        $eleve = Eleve::findOrFail($eleve_id);
        $periode = Periode::findOrFail($periode_id);
        $conduites = Conduite::all();

        return view('eleve.conduites')
                    ->with('page_name', $page)
                    ->with('conduites', $conduites)
                    ->with('periode', $periode)
                    ->with('eleve', $eleve);
                    
    }

    public function edit($eleve_id,$periode_id)
    {   $page = "EleveConduite / Create";
        // $frequentations = Frequentation::all();
        $eleve = Eleve::findOrFail($eleve_id);
        $periode = Periode::findOrFail($periode_id);
        $conduite = EleveConduite::where('eleve_id', $eleve_id)
                                    ->where('periode_id', $periode_id)
                                    ->first();
        $conduites = Conduite::all();

        // dd($conduite->id);

        return view('eleve.conduites')
                    ->with('page_name', $page)
                    ->with('self', $conduite)
                    ->with('conduites', $conduites)
                    ->with('periode', $periode)
                    ->with('eleve', $eleve);
                    
    }

    public function store(Request $request){
        $request->validate([
            'eleve_matricule' => ['required', 'string', 'max:255'],
            'id_conduite' => ['required', 'string', 'max:255'],
            'id_periode' => ['required', 'string', 'max:255'],
        ]);

        
        $eleve = Eleve::where('matricule', $request->eleve_matricule)->first();
        $periode = Periode::find($request->id_periode);
        $conduite = Conduite::find($request->id_conduite);
        
        $eleveConduite = EleveConduite::create();
        
        $eleveConduite->eleve()->associate($eleve);
        $eleveConduite->periode()->associate($periode);
        $eleveConduite->conduite()->associate($conduite);
        
        
        $eleveConduite->save();
        Logfile::createLog(
            'eleve_conduites',
            $eleveConduite->id
        );
        
        return redirect()->route('resultat.periode', [$periode->id, $eleve->id]);
        // dd($eleve);
        
    }
    
    
    public function update(Request $request){
        $request->validate([
            'eleve_matricule' => ['required', 'string', 'max:255'],
            'id_conduite' => ['required', 'string', 'max:255'],
            'id_periode' => ['required', 'string', 'max:255'],
        ]);

        
        
        $eleve = Eleve::where('matricule', $request->eleve_matricule)->first();
        $periode = Periode::find($request->id_periode);
        $conduite = Conduite::find($request->id_conduite);
        $eleveConduite = EleveConduite::where('eleve_id', $eleve->id)
                                    ->where('periode_id', $periode->id)
                                    ->first();

        // $eleveConduite = EleveConduite::create();

        // $eleveConduite->eleve()->associate($eleve);
        // $eleveConduite->periode()->associate($periode);
        $eleveConduite->conduite()->associate($conduite);


        $eleveConduite->save();
        Logfile::updateLog(
            'eleve_conduites',
            $eleveConduite->id
        );
        return redirect()->route('resultat.periode', [$periode->id, $eleve->id]);
        // dd($eleve);
    }
}
