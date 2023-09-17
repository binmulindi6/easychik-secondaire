<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Classe;
use App\Models\Logfile;
use App\Models\Presence;
use Illuminate\Support\Arr;
use App\Models\TypePresence;
use Illuminate\Http\Request;
use App\Models\AnneeScolaire;
use App\Models\Frequentation;
use Illuminate\Support\Facades\Auth;
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

        if(Auth::user()->isParent()){
            $eleves = Auth::user()->parrain->eleves;
            $classes = [];
            foreach($eleves as $eleve){
                $classes[] = $eleve->classe(true);
            }
        }


        return view('presences.eleves')
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
            'date' => ['required', 'string']
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
            'date' => ['required', 'string']
        ]);

        $fre = Frequentation::findOrFail($request->freq_id);
        $type = TypePresence::findOrFail($request->type_id);
        $user = User::findOrFail($request->user_id);

        $presence = Presence::create([
            'date' => $request->date
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

    //setPeriode
    public function setPeriode(Request $req, $id){
        $req->validate([
            'debut' => ['required' , 'date'],
            'fin' => ['required' , 'date'],
        ]);
        // dd(10);
        return $this->periode($id,$req->debut, $req->fin);
    }

    public function periode($id, $start = null, $end = null)
    {
        //objects from Db
        $classe = Classe::findOrFail($id);
        $types = TypePresence::all();
        $eleves = $classe->eleves();

        // if(Auth::user()->isParent()){
        //     $eleves = Auth::user()->parrain->eleves;
        //     $classes = [];
        //     foreach($eleves as $eleve){
        //         $classes[] = $eleve->classe(true);
        //     }
        // }

        // dd($eleves[0]->parrain);
        
        //the first day
        $debut = $start ? date_create($start) : date_create(date('Y-m-d'));
        $holder = date_create(date_format($debut, 'Y-m-d'));
        //the last day

        // dd(date_format($debut, 'w'));        

        $fin = $end ? date_create($end) : date_add(date_create(date_format($holder, 'Y-m-d')), date_interval_create_from_date_string('7 days'));
        $days = array();

        for($i = $holder; $i <= $fin; date_add($i, date_interval_create_from_date_string('1 day'))){
            $days[] = date_format($i, 'Y-m-d'); 
        }
        // dd($days);

        $annee = AnneeScolaire::current();

        // dd($eleves);

        return view('presences.periode')
            ->with('page_name', 'Presences Classe de ' . $classe->nomCourt() . ' du ' . date_format($debut,'d/m/Y') . ' au ' . date_format($fin,'d/m/Y'))
            ->with('classe', $classe)
            ->with('annee', $annee)
            ->with('types', $types)
            ->with('debut', date_format($debut,'Y-m-d'))
            ->with('fin', date_format($fin,'Y-m-d'))
            ->with('days', $days)
            ->with('isPeriode', true)
            ->with('eleves', $eleves);
    }
}
