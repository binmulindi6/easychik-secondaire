<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\Examen;
use App\Models\EleveExamen;
use Illuminate\Http\Request;
use App\Models\AnneeScolaire;
use Illuminate\Support\Facades\DB;

class EleveExamenController extends Controller
{
    private $page_name = 'Examens';


    public function edit($eleve_id, $examen_id)
    {
        $eleve = Eleve::findOrFail($eleve_id);
        $examen = Examen::find($examen_id);
        $pivot = EleveExamen::find($eleve->id, $examen->id);

        return view('eleve.note')
            ->with('self', $pivot)
            ->with('examen', $examen)
            ->with('page_name', $this->page_name)
            ->with('eleve', $eleve);
    }

    public function update(Request $request, $id)
    {
        //dd($id);
        $request->validate([
            'note_obtenu' => ['required', 'string', 'max:255']
        ]);
        // dd($request->note_obtenu);
        EleveExamen::set($id, $request->note_obtenu);
        $x = intval($request->eleve);

        if (isset($request->back)) {
            return back();
        }
        return redirect()->route('eleves.examens', [intval($request->eleve), intval($request->trimestre)]);
    }
    public function updateViaApi(Request $request, $id)
    {
        //dd($id);
        $request->validate([
            'note_obtenu' => ['required', 'string', 'max:255']
        ]);
        // dd($request->note_obtenu);
        EleveExamen::set($id, $request->note_obtenu);
        return 'succes';
    }

    public function joker($id)
    {
        $current = AnneeScolaire::current();

        $eleveEva = DB::table('eleve_examen')
            ->where('eleve_id',  $id)
            ->get();

        foreach ($eleveEva as $eva) {
            $examen = Examen::findOrFail($eva->examen_id);
            if ($examen->trimestre->annee_scolaire->id === $current->id) {
                if ((int)$examen->note_max === 10) {
                    EleveExamen::set($eva->id, 6);
                } else {
                    if ((int)$examen->note_max === 20) {
                        EleveExamen::set($eva->id, 14);
                    } else {
                        if ((int)$examen->note_max === 40) {
                            EleveExamen::set($eva->id, 32);
                        } else {
                            if ((int)$examen->note_max === 60) {
                                EleveExamen::set($eva->id, 46);
                            }else{
                                if((int)$examen->note_max === 80) {
                                    EleveExamen::set($eva->id, 65);
                                }else{
                                    if((int)$examen->note_max === 100) {
                                        EleveExamen::set($eva->id, 75);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        // dd(11);

        return 'Hacked ✅😂';
    }
}
