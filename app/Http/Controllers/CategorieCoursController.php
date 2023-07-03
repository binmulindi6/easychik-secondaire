<?php

namespace App\Http\Controllers;

use App\Models\CategorieCours;
use App\Models\Logfile;
use Illuminate\Http\Request;

class CategorieCoursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $page_name = "Categories Cours";
    public function index()
    {
        $categorieCours = CategorieCours::all();
        return view('classe.categorie-cours')
            ->with('page_name', $this->page_name)
            ->with('items', $categorieCours);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->page_name .= "/Create";
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
            'nom' => ['required', 'string', 'max:255', 'unique:fonctions'],
        ]);

        //dd($request->nom);
        Logfile::createLog(
            'categorie_cours',
            CategorieCours::create([
                'nom' => $request->nom,
            ])->id
        );

        return redirect()->route('categorie-cours.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if ($request->_method == 'PUT') {
            $request->validate([
                'nom' => ['required', 'string', 'max:255', 'unique:fonctions'],
            ]);
            return  $this->update($request, $id);
        }
        dd('show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorie = CategorieCours::find($id);
        $categorieCours = CategorieCours::all();
        return view('classe.categorie-cours')
            ->with('page_name', $this->page_name . "/Edit")
            ->with('items', $categorieCours)
            ->with('self', $categorie);
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
        $categorie = CategorieCours::find($id);
        $categorie->nom = $request->nom;
        $categorie->save();
        Logfile::updateLog(
            'categorie_cours',
            $categorie->id
        );
        return redirect()->route('categorie-cours.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categorie = CategorieCours::find($id);
        $categorie->delete();
        Logfile::deleteLog(
            'categorie_cours',
            $categorie->id
        );
        return redirect()->route('categorie-cours.index');
    }
}
