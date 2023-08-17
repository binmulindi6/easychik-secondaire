<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Classe;
use App\Models\Logfile;
use App\Models\Presence;
use App\Models\TypePresence;
use Illuminate\Http\Request;
use App\Models\AnneeScolaire;
use App\Models\Frequentation;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class PresenceController extends Controller
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

        return view('presences.index')
            ->with('page_name', 'Presences')
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
            'freq_id' => ['required', 'int'],
            'freq_id' => ['required', 'int'],
            'user_id' => ['required', 'int'],
        ]);


        $fre = Frequentation::findOrFail($request->freq_id);
        $type = TypePresence::findOrFail($request->freq_id);

        $presence = Presence::create([
            'date' => date('Y-m-d')
        ]);

        $presence->type_presence()->associate($type);
        $presence->frequentation()->associate($fre);

        Logfile::createLog('presences', $presence->id, $request->user_id);

        return 'succes';
    }

    public function setDate(Request $req, $classe){
        $req->validate([
            'date' => ['required' , 'date']
        ]);

        return $this->classe($classe,$req->date);
    }

    public function storeApi(Request $request)
    {
        $request->validate([
            'freq_id' => ['required', 'int'],
            'type_id' => ['required', 'int'],
            'user_id' => ['required', 'int'],
        ]);

        $fre = Frequentation::findOrFail($request->freq_id);
        $type = TypePresence::findOrFail($request->type_id);
        $user = User::findOrFail($request->user_id);

        $presence = Presence::create([
            'date' => date('Y-m-d')
        ]);

        $presence->type_presence()->associate($type);
        $presence->frequentation()->associate($fre);

        $presence->save();

        Logfile::createLog('presences', $presence->id, $user->id);

        return 'succes';
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function classe($id, $date = null)
    {
        $classe = Classe::findOrFail($id);
        $types = TypePresence::all();
        $eleves = $classe->eleves();
        $day =  $date ? $date :  date('Y-m-d');
        // $eleves[]->presence();
        // $classeNiveauSup = $classe->classesDeNiveauSuperieur();
        // $classeMemeNiveau = $classe->classesDeMemeNiveau();
        $annee = AnneeScolaire::current();

        // dd($eleves);

        return view('presences.classe')
            ->with('page_name', 'Presences Classe de ' . $classe->nomCourt() . ' du ' . $day)
            ->with('classe', $classe)
            ->with('annee', $annee)
            ->with('types', $types)
            ->with('day', $day)
            ->with('eleves', $eleves);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Presence  $presence
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Presence  $presence
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
     * @param  \App\Models\Presence  $presence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Presence  $presence
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
