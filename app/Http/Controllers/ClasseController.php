<?php

namespace App\Http\Controllers;

use App\Models\CategorieCours;
use App\Models\Classe;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $page = "Classes";

    public function index()
    {
        $classes = Classe::orderBy('niveau', 'asc')->get();
        //$user = User::where('id',)

        return view('classe.classes')
                    ->with('page_name', $this->page)
                    ->with('items', $classes);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $this->page = "Classes/Create";
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
            'niveau' => ['required','string','max:255'],
            'nom' => ['required','string','max:255'],
        ]);

        Classe::create([
            'nom' => $request->nom,
            'niveau' => $request->niveau,
        ]);

        return redirect()->route("classes.index");

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
        dd("show");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $classes = Classe::orderBy('niveau', 'asc')->get();
        $classe = Classe::find($id);

        return view('classe.classes')
                    ->with('page_name', $this->page . '/Edit')
                    ->with('self', $classe)
                    ->with('items', $classes);
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
        
        $request->validate([
            'niveau' => ['required','string','max:255'],
            'nom' => ['required','string','max:255'],
        ]);

        $classe = Classe::find($id);
        $classe->niveau = $request->niveau;
        $classe->nom = $request->nom;

        $classe->save();

        return redirect()->route("classes.index");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classe = Classe::find($id);
        $classe->delete();
        return redirect()->route("classes.index");
    }
}
