<?php

namespace App\Http\Controllers;

use App\Models\Logfile;
use App\Models\Trimestre;
use Illuminate\Http\Request;
use App\Models\AnneeScolaire;

class TrimestreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $page_name = "Trimestres";
    public function index()
    {
        $trimestres = Trimestre::all();
        $annees = AnneeScolaire::orderBy('nom')->get();
        $anneeEncours = AnneeScolaire::current();
        return view('ecole.trimestres')
            ->with('page_name', $this->page_name)
            ->with('anneeEncours', $anneeEncours)
            ->with('annees', $annees)
            ->with('items', $trimestres);
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
            'nom' => ['required', 'string', 'max:255'],
            'annee_scolaire' => ['required', 'string', 'max:255'],
            'date_debut' => ['required', 'string', 'max:255'],
            'date_fin' => ['required', 'string', 'max:255'],
        ]);

        //dd($request->nom);
        $annee = AnneeScolaire::find($request->annee_scolaire);
        $trim = Trimestre::where('annee_scolaire_is',$annee->id)
                        ->where('nom', $request->nom);
        if($trim === null){
            $trimestre = Trimestre::create([
                'nom' => $request->nom,
                'date_debut' => $request->date_debut,
                'date_fin' => $request->date_fin,
            ]);

            $trimestre->annee_scolaire()->associate($annee);
            $trimestre->save();
            Logfile::createLog(
                'trimestres',
                $trimestre->id
            );
            //$annee->trimestres()->associate($trimestre);

            return redirect()->route('trimestres.index');
        }else{
            return redirect('trimestres/create')
                        ->withErrors([
                            'nom' => 'Il existe deja un '. $request->nom . ' pour l\'annee scolaire '. $annee->nom
                        ]);
                        // ->withInput();
        }
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
                'annee_scolaire' => ['required', 'string', 'max:255'],
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
        $trimestres = Trimestre::all();
        $trimestre = Trimestre::find($id);
        $annees = AnneeScolaire::orderBy('nom')->get();
        $anneeEncours = AnneeScolaire::current();
        return view('ecole.trimestres')
            ->with('page_name', $this->page_name . " / Edit")
            ->with('anneeEncours', $anneeEncours)
            ->with('self', $trimestre)
            ->with('annees', $annees)
            ->with('items', $trimestres);
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

        $trimestre = Trimestre::find($id);

        $trimestre->nom = $request->nom;
        $trimestre->date_debut = $request->date_debut;
        $trimestre->date_fin = $request->date_fin;

        $annee = AnneeScolaire::find($request->annee_scolaire);
        $trimestre->annee_scolaire()->associate($annee);
        $trimestre->save();

        Logfile::updateLog(
            'trimestres',
            $trimestre->id
        );
        return redirect()->route('trimestres.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trimestre = Trimestre::find($id);
        $trimestre->delete();

        Logfile::deleteLog(
            'trimestres',
            $trimestre->id
        );
        return redirect()->route('trimestres.index');
    }

    //Search Engine

    public function search(Request $request)
    {

        $annees = AnneeScolaire::orderBy('nom')->get();
        $anneeEncours = AnneeScolaire::current();
        $items = Trimestre::where('trimestres.nom', 'like', '%' . $request->search . '%')
            //->join('annee_scolaires', 'annee_scolaires.id', '=', 'trimestres.annee_scolaire_id')
            //->where('trimestres.nom', 'like', '%' . $request->search . '%')
            //->orWhere('annee_scolaires.nom', 'like', '%' . $request->search . '%')
            ->get();

        return view('ecole.trimestres')
            ->with('search', $request->search)
            ->with('page_name', $this->page_name . ' / Search')
            ->with('anneeEncours', $anneeEncours)
            ->with('annees', $annees)
            ->with('items', $items);
    }
}