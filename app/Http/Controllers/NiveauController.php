<?php

namespace App\Http\Controllers;

use App\Models\Niveau;
use App\Models\Logfile;
use Illuminate\Http\Request;

class NiveauController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $page_name = "Niveaux";
    public function index()
    {
        $niveaux = Niveau::latest()->get();

        return view('enseignement.niveaux')
                ->with('items', $niveaux)
                ->with('page_name', $this->page_name);

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
            'nom' => ['required', 'string', 'max:255'],
            'numerotation' => ['required', 'string', 'max:255']
        ]);

        Logfile::createLog(
            'niveaux',
            Niveau::create([
                'nom' => $request->nom,
                'numerotation' => $request->numerotation
            ])->id
        );

        return redirect()->route('niveaux.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if ($request->_method === "PUT") {
            $request->validate([
                'nom' => ['required', 'string', 'max:255'],
                'numerotation' => ['required', 'string', 'max:255']
            ]);

            return $this->update($request,$id);
        }

        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $niveaux = Niveau::latest()->get();
        $niveau = Niveau::findOrFail($id);

        return view('enseignement.niveaux')
                ->with('self', $niveau)
                ->with('items', $niveaux)
                ->with('page_name', $this->page_name . ' / Edit');
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
        $niveau = Niveau::findOrFail($id);
        $niveau->nom = $request->nom;
        $niveau->numerotation = $request->numerotation;
        $niveau->save();
        Logfile::updateLog(
            'niveaux',
            $niveau->id
        );

        return redirect()->route('niveaux.index');
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
