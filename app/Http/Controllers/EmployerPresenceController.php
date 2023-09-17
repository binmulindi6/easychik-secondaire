<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Logfile;
use App\Models\Employer;
use App\Models\TypePresence;
use Illuminate\Http\Request;
use App\Models\AnneeScolaire;
use App\Models\EmployerPresence;

class EmployerPresenceController extends Controller
{

    public function home()
    {

        return view('presences.index')
            ->with('page_name', 'Presences');
    }

       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($date = null)
    {

        $employers = Employer::where('id','!=',1)
        ->orderBy('matricule')->get();
        $types = TypePresence::all();
        $day =  $date ? $date :  date('Y-m-d');
        // $eleves[]->presence();
        // $classeNiveauSup = $classe->classesDeNiveauSuperieur();
        // $classeMemeNiveau = $classe->classesDeMemeNiveau();
        $annee = AnneeScolaire::current();

        // dd($eleves);

        return view('presences.employers')
            ->with('page_name', 'Presences du Personnel du ' . date_format(date_create($day), 'd/m/Y'))
            ->with('annee', $annee)
            ->with('types', $types)
            ->with('day', $day)
            ->with('items', $employers);
    }

    public function setDate(Request $req){
        $req->validate([
            'date' => ['required' , 'date']
        ]);

        return $this->index($req->date);
    }
    public function setPeriode(Request $req){
        $req->validate([
            'date' => ['required' , 'date']
        ]);

        return $this->index($req->date);
    }

    public function storeApi(Request $request)
    {
        $request->validate([
            'annee_id' => ['required', 'int'],
            'type_id' => ['required', 'int'],
            'employer_id' => ['required', 'int'],
            'user_id' => ['required', 'int'],
            'date' => ['required', 'string'],
        ]);

        $annee = AnneeScolaire::findOrFail($request->annee_id);
        $type = TypePresence::findOrFail($request->type_id);
        $employer = Employer::findOrFail($request->employer_id);
        $user = User::findOrFail($request->user_id);

        $presence = EmployerPresence::create([
            'date' => $request->date
        ]);
        
        $presence->type_presence()->associate($type);
        $presence->annee_scolaire()->associate($annee);
        $presence->employer()->associate($employer);
        // $presence->frequentation()->associate($fre);

        $presence->save();

        Logfile::createLog('employer_presences', $presence->id, $user->id);

        return 'succes';
    }

}
