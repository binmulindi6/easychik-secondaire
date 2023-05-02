<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Classe;
use Illuminate\Http\Request;
use App\Models\CategorieCours;
use App\Models\Niveau;
use Illuminate\Support\Facades\DB;

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


        $classes = Classe::orderBy('niveau_id','asc')->get();
        $niveaux = Niveau::all();
        //$user = User::where('id',)
        // dd($classes[2]);
        // dd($classes[2]->encadrements);
        return view('classe.classes')
            ->with('page_name', $this->page)
            ->with('niveaux', $niveaux)
            ->with('items', $classes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->page = "Classes / Create";
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
            'niveau' => ['required', 'string', 'max:255'],
            'nom' => ['required', 'string', 'max:255'],
        ]);

        // dd($request->nom , $request->niveau);
        $niveau = Niveau::find($request->niveau);
        $classe = Classe::create([
            'nom' => $request->nom,
        ]);

        $classe->niveau()->associate($niveau);

        $classe->save();

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
        if ($request->_method == 'PUT') {
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
        // $classes = Classe::orderBy('niveau_id', 'asc')->get();
        $classes = Classe::all();
        $classe = Classe::find($id);
        $niveaux = Niveau::all();
        // $users = User::crossJoin('classes', 'classes.user_id', '=', 'users.id')->get();
        // $users = User::whereNotExists(function ($query) {
        //     $query->select(DB::raw(1))
        //         ->from('classes')
        //         ->whereColumn('classes.user_id', 'users.id');
        // })->get();

        // dd($users);
        // $users = User::join('classes', 'users.id', '!=' , 'classes.user_id')
        //             ->get();
                        // ->where('user.fonction');


        // ('classes', 'classes.user_id', '=', 'users.id')->get();
        //dd($users);

        return view('classe.classes')
            ->with('page_name', $this->page . ' / Edit')
            ->with('self', $classe)
            ->with('niveaux', $niveaux)
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
            'niveau' => ['required', 'string', 'max:255'],
            'nom' => ['required', 'string', 'max:255'],
            'user' => ['required', 'string', 'max:255'],
        ]);

        $classe = Classe::find($id);
        $classe->niveau = $request->niveau;
        $classe->nom = $request->nom;

        $user = User::find($request->user);
        $classe->user()->associate($user);

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