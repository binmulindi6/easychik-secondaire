<?php

namespace App\Http\Controllers;

use App\Models\Logfile;
use Illuminate\Http\Request;
use App\Models\AnneeScolaire;
use Illuminate\Support\Facades\Date;

class AnneeScolaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $page_name = "Annees Scolaires";
    public function index()
    {
        $anneeScolaires = AnneeScolaire::orderBy('nom')->get();

        $annee = AnneeScolaire::current();
        if (isset($annee->nom)) {
            $date = explode('-', $annee->nom)[1];
            $annees = [];
            for ($i = 0; $i < 3; $i++) {
                array_push($annees, $date . "-" . (int)$date + 1);
                $date = (int)$date + 1;
            }
        } else {
            $date = date_format(date_create(), 'Y');
            $annees = [];
            for ($i = 0; $i < 3; $i++) {
                array_push($annees, $date . "-" . (int)$date + 1);
                $date = (int)$date + 1;
            }
        }

        return view('ecole.annees')
            ->with('annees', $annees)
            ->with('page_name', $this->page_name)
            ->with('items', $anneeScolaires);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->page_name = $this->page_name . ' / Create';
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
            'nom' => ['required', 'string', 'max:255', 'unique:annee_scolaires'],
            'date_debut' => ['required', 'string', 'max:255'],
            'date_fin' => ['required', 'string', 'max:255'],
        ]);

        //dd(10);
        //dd($request->nom);
        Logfile::createLog(
            'annee_scolaires',
            AnneeScolaire::create([
                'nom' => $request->nom,
                'date_debut' => $request->date_debut,
                'date_fin' => $request->date_fin,
            ])->id
        );

        return redirect()->route('annee-scolaires.index');
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
        $anneeScolaires = AnneeScolaire::orderBy('nom')->get();
        $annee = AnneeScolaire::findOrFail($id);
        if (isset($annee->nom)) {
            $date = explode('-', $annee->nom)[1];
            $annees = [];
            for ($i = 0; $i < 3; $i++) {
                array_push($annees, $date . "-" . (int)$date + 1);
                $date = (int)$date + 1;
            }
        } else {
            $date = date_format(date_create(), 'Y');
            $annees = [];
            for ($i = 0; $i < 3; $i++) {
                array_push($annees, $date . "-" . (int)$date + 1);
                $date = (int)$date + 1;
            }
        }
        return view('ecole.annees')
            ->with('page_name', $this->page_name . " / Edit")
            ->with('annees', $annees)
            ->with('self', $annee)
            ->with('items', $anneeScolaires);
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
        //dd(10);
        $annee = AnneeScolaire::find($id);

        $annee->nom = $request->nom;
        $annee->date_debut = $request->date_debut;
        $annee->date_fin = $request->date_fin;

        $annee->save();
        Logfile::updateLog(
            'annee_scolaires',
            $annee->id
        );
        return redirect()->route('annee-scolaires.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $annee = AnneeScolaire::find($id);
        $annee->delete();
        Logfile::deleteLog(
            'annee_scolaires',
            $annee->id
        );
        return redirect()->route('annee-scolaires.index');
    }


    //Search Engine

    public function search(Request $request)
    {

        $items = AnneeScolaire::where('nom', 'like', '%' . $request->search . '%')
            ->get();
        return view('ecole.annees')
            ->with('search', $request->search)
            ->with('page_name', $this->page_name . ' / Search')
            ->with('items', $items);
    }
}
