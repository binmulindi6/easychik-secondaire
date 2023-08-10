<?php

namespace App\Http\Controllers;

use App\Models\Jour;
use App\Models\Cours;
use App\Models\Heure;
use App\Models\Classe;
use App\Models\Horaire;
use App\Models\Logfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HoraireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Classe::orderBy('niveau_id')->get();

        // if(Auth::user()->isParent()){
        //     $eleves = Auth::user()->parrain->eleves;
        //     // dd($eleves);
        // }

        return view('horaires.index')
            ->with('page_name', 'Horaires')
            ->with('classes', $classes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'cours' => ['required', 'string', 'max:255'],
            'jour' => ['required', 'string', 'max:255'],
            'heure' => ['required', 'string', 'max:255'],
            'classe' => ['required', 'string', 'max:255']
        ]);

        if ($request->cours === 'RECREATION') {
            $jour = Jour::findOrFail($request->jour);
            $heure = Heure::findOrFail($request->heure);
            $classe = Classe::findOrfail($request->classe);

            $horaire = Horaire::where('classe_id', $classe->id)
                ->where('jour_id', $jour->id)
                ->where('heure_id', $heure->id)
                ->first();

            if ($horaire) {
                $horaire->classe()->associate($classe);
                $horaire->isRecreation = 1;
                $horaire->heure()->associate($heure);
                $horaire->jour()->associate($jour);


                $horaire->save();

                Logfile::updateLog(
                    'horaires',
                    $horaire->id
                );
            } else {
                $horaire = Horaire::create();

                $horaire->classe()->associate($classe);
                $horaire->isRecreation = 1;
                $horaire->heure()->associate($heure);
                $horaire->jour()->associate($jour);


                $horaire->save();

                Logfile::createLog(
                    'horaires',
                    $horaire->id
                );
            }
        } else {
            $cours = Cours::findOrFail($request->cours);

            $jour = Jour::findOrFail($request->jour);
            $heure = Heure::findOrFail($request->heure);
            $classe = Classe::findOrfail($request->classe);

            $horaire = Horaire::where('classe_id', $classe->id)
                ->where('jour_id', $jour->id)
                ->where('heure_id', $heure->id)
                ->first();

            if ($horaire) {
                $horaire->classe()->associate($classe);
                $horaire->cours()->associate($cours);
                $horaire->heure()->associate($heure);
                $horaire->jour()->associate($jour);


                $horaire->save();

                Logfile::updateLog(
                    'horaires',
                    $horaire->id
                );
            } else {
                $horaire = Horaire::create();

                $horaire->classe()->associate($classe);
                $horaire->cours()->associate($cours);
                $horaire->heure()->associate($heure);
                $horaire->jour()->associate($jour);


                $horaire->save();

                Logfile::createLog(
                    'horaires',
                    $horaire->id
                );
            }
        }

        return back();
    }
    public function storeApi(Request $request)
    {
        $request->validate([
            'cours' => ['required', 'string', 'max:255'],
            'jour' => ['required', 'string', 'max:255'],
            'heure' => ['required', 'string', 'max:255'],
            'classe' => ['required', 'string', 'max:255'],
            'user' => ['required', 'string', 'max:255']
        ]);

        if ($request->cours === 'RECREATION') {
            $jour = Jour::findOrFail($request->jour);
            $heure = Heure::findOrFail($request->heure);
            $classe = Classe::findOrfail($request->classe);

            $horaire = Horaire::where('classe_id', $classe->id)
                ->where('jour_id', $jour->id)
                ->where('heure_id', $heure->id)
                ->first();

            if ($horaire) {
                $horaire->classe()->associate($classe);
                $horaire->isRecreation = 1;
                // $horaire->cours = null;
                $horaire->heure()->associate($heure);
                $horaire->jour()->associate($jour);


                $horaire->save();

                Logfile::updateLog(
                    'horaires',
                    $horaire->id,
                    $request->user
                );
            } else {
                $horaire = Horaire::create();

                $horaire->classe()->associate($classe);
                $horaire->isRecreation = 1;
                $horaire->heure()->associate($heure);
                $horaire->jour()->associate($jour);


                $horaire->save();

                Logfile::createLog(
                    'horaires',
                    $horaire->id,
                    $request->user
                );
            }
        } else {
            $cours = Cours::findOrFail($request->cours);

            $jour = Jour::findOrFail($request->jour);
            $heure = Heure::findOrFail($request->heure);
            $classe = Classe::findOrfail($request->classe);

            $horaire = Horaire::where('classe_id', $classe->id)
                ->where('jour_id', $jour->id)
                ->where('heure_id', $heure->id)
                ->first();

            if ($horaire) {
                $horaire->classe()->associate($classe);
                $horaire->cours()->associate($cours);
                $horaire->heure()->associate($heure);
                $horaire->jour()->associate($jour);


                $horaire->save();

                Logfile::updateLog(
                    'horaires',
                    $horaire->id,
                    $request->user
                );
            } else {
                $horaire = Horaire::create();

                $horaire->classe()->associate($classe);
                $horaire->cours()->associate($cours);
                $horaire->heure()->associate($heure);
                $horaire->jour()->associate($jour);


                $horaire->save();

                Logfile::createLog(
                    'horaires',
                    $horaire->id,
                    $request->user
                );
            }
        }

        return 'succes';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $classe = Classe::findOrfail($id);
        $horaires = $classe->horaires;
        $heures = Heure::orderBy('numerotation')->get();
        $jours = Jour::orderBy('numerotation')->get();
        $cours = $classe->cours();
        // dd($horaires);
        return view('horaires.classe')
            ->with('page_name', 'Horaire / ' . $classe->nomCourt())
            ->with('classe', $classe)
            ->with('heures', $heures)
            ->with('horaires', $horaires)
            ->with('jours', $jours)
            ->with('cours', $cours)
            ->with('data', $horaires);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
