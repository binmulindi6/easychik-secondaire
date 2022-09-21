<?php

namespace App\Http\Controllers;

use App\Models\Fonction;
use Illuminate\Http\Request;

class FonctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     protected $page_name = 'Fonctions';
    public function index()
    {
        $fonctions = Fonction::all();
        return view('employer.fonctions')
                    ->with('page_name', $this->page_name)
                    ->with('items', $fonctions);
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
            'nom' => ['required','string','max:255', 'unique:fonctions'],
        ]);

        //dd($request->nom);

        Fonction::create([
            'nom' => $request->nom,
        ]);

        return redirect()->route('fonctions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {   
        if($request->_method == 'PUT'){
            return  $this->update($request, $id);
        }
        $fonction = Fonction::find($id);
        return view('employer.fonctions')
                    ->with('item', $fonction);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fonction = Fonction::find($id);
        $fonctions = Fonction::all();
        return view('employer.fonctions')
                    ->with('page_name', $this->page_name . "/Edit")
                    ->with('items', $fonctions)
                    ->with('self', $fonction);


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
        $fonction = Fonction::find($id);
        $fonction->nom = $request->nom;
        $fonction->save();
        return redirect()->route('fonctions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $fonction = Fonction::find($id);
        $fonction->delete();

        return redirect()->route('fonctions.index');
    }
}
