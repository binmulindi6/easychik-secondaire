<?php

namespace App\Http\Controllers;

use App\Models\Logfile;
use App\Models\Periode;
use App\Models\Trimestre;
use Illuminate\Http\Request;
use App\Models\AnneeScolaire;


class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $page_name = "Periodes";

    public function index()
    {
        $periodes = Periode::currents();
        $anneeEncours = AnneeScolaire::current();
        $trimestres = $anneeEncours->trimestres;
        return view('ecole.periodes')
            ->with('page_name', $this->page_name)
            ->with('anneeEncours', $anneeEncours)
            ->with('trimestres', $trimestres)
            ->with('items', $periodes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->page_name = "Periodes/Create";
        return $this->index();
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
            'nom' => ['required', 'string', 'max:255'],
            'trimestre' => ['required', 'string', 'max:255'],
            'date_debut' => ['required', 'string', 'max:255'],
            'date_fin' => ['required', 'string', 'max:255'],
        ]);

        //dd($request->nom);
        $trimestre = Trimestre::find($request->trimestre);
        $periode = Periode::create([
            'nom' => $request->nom,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
        ])->trimestre()->associate($trimestre);;

        //$periode->trimestre()->associate($trimestre);
        $periode->save();
        Logfile::createLog(
            'periodes',
            $periode->id
        );

        //$annee->trimestres()->associate($trimestre);

        return redirect()->route('periodes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        if ($request->_method == 'PUT') {
            $request->validate([
                'nom' => ['required', 'string', 'max:255'],
                'trimestre' => ['required', 'string', 'max:255'],
                'date_debut' => ['required', 'string', 'max:255'],
                'date_fin' => ['required', 'string', 'max:255'],
            ]);
            return  $this->update($request, $id);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $periodes = Periode::currents();
        $periode = Periode::findOrFail($id);
        $anneeEncours = AnneeScolaire::current();
        $trimestres = $anneeEncours->trimestres();
        return view('ecole.periodes')
            ->with('page_name', $this->page_name . "/Edit")
            ->with('anneeEncours', $anneeEncours)
            ->with('trimestres', $trimestres)
            ->with('self', $periode)
            ->with('items', $periodes);
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

        $periode = Periode::find($id);

        $periode->nom = $request->nom;
        $periode->date_debut = $request->date_debut;
        $periode->date_fin = $request->date_fin;

        $trimestre = Trimestre::find($request->trimestre);
        $periode->trimestre()->associate($trimestre);
        $periode->save();

        Logfile::updateLog(
            'periodes',
            $periode->id
        );
        return redirect()->route('periodes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $periode = Periode::find($id);
        $periode->delete();
        Logfile::deleteLog(
            'periodes',
            $periode->id
        );
        return redirect()->route('periodes.index');
    }

    //Search Engine

    public function search(Request $request)
    {
        //dd(10);

        $trimestres = Trimestre::all();
        $anneeEncours = AnneeScolaire::current();
        $items = Periode::where('periodes.nom', 'like', '%' . $request->search . '%')
            //->join('annee_scolaires', 'annee_scolaires.id', '=', 'trimestres.annee_scolaire_id')
            //->where('trimestres.nom', 'like', '%' . $request->search . '%')
            //->orWhere('annee_scolaires.nom', 'like', '%' . $request->search . '%')
            ->get();

        return view('ecole.periodes')
            ->with('search', $request->search)
            ->with('page_name', $this->page_name . ' / Search')
            ->with('anneeEncours', $anneeEncours)
            ->with('trimestres', $trimestres)
            ->with('items', $items);
    }
}