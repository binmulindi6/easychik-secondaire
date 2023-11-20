<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Ecole;
use App\Models\Logfile;
use App\Models\Periode;
use App\Models\Employer;
use App\Models\Fonction;
use App\Models\Trimestre;
use PHPUnit\Framework\Test;
use Illuminate\Http\Request;
use App\Models\AnneeScolaire;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Date\DateController;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class EcoleController extends Controller
{
    public function index()
    {
        // abort(888);
        if (DateController::checkYears()) {
            if (DateController::checkTrimestres()) {
                if (DateController::checkPeriodes()) {
                    $annee = AnneeScolaire::current();
                    $trimestre = Trimestre::current();

                    $periode = Periode::current();
                    return view('ecole.index')
                        ->with('annee', $annee)
                        ->with('trimestre', $trimestre)
                        ->with('periode', $periode)
                        ->with('page_name', "Ecole");
                }
                return view('origin')->with('order', "periode");
            }
            return view('origin')->with('order', "semestre");
        }
        return view('origin')->with('order', "year");
    }

    public function create()
    {

        $ecole = Ecole::all();
        if (count($ecole) == 0) {
            //create ecole
            return view('ecole.create')
                ->with('page_name', 'Ecole');
        } else if (count($ecole) >= 1) {
            return redirect()->route('dashboard');
        }
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
            'abbreviation' => ['required', 'string', 'max:255'],
            'bp' => ['required', 'string', 'max:255'],
            'pays' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'ville' => ['required', 'string', 'max:255'],
            'commune' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255'],
            'ministere' => ['required', 'string', 'max:255'],
            'reussite' => ['required', 'string', 'max:255'],
        ]);


        $ecole = Ecole::all();
        if (count($ecole) == 0) {
            Ecole::create([
                "nom" => $request->nom,
                "abbreviation" => $request->abbreviation,
                "bp" => $request->bp,
                "reussite" => $request->reussite,
                "code" => $request->code,
                "pays" => $request->pays,
                "province" => $request->province,
                "ville" => $request->ville,
                "commune" => $request->commune,
                "ministere" => $request->ministere,
            ]);
        }

        return redirect()->route('ecole.first.employer');
    }

    public function update(Request $request)
    {

        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'abbreviation' => ['required', 'string', 'max:255'],
            'bp' => ['required', 'string', 'max:255'],
            'pays' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'ville' => ['required', 'string', 'max:255'],
            'commune' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255'],
            'ministere' => ['required', 'string', 'max:255'],
            'reussite' => ['required', 'string', 'max:255'],
        ]);


        $ecole = Ecole::first();

        $ecole->nom = $request->nom;
        $ecole->abbreviation = $request->abbreviation;
        $ecole->bp = $request->bp;
        $ecole->reussite = $request->reussite;
        $ecole->code = $request->code;
        $ecole->pays = $request->pays;
        $ecole->province = $request->province;
        $ecole->ville = $request->ville;
        $ecole->commune = $request->commune;
        $ecole->ministere = $request->ministere;

        $ecole->save();
        return redirect()->route('settings.index');
    }

    public function firstEmployer()
    {
        $ecole = Employer::all();
        if (count($ecole) <= 1) {
            // create ecole
            return view('employer.first')
                ->with('last_matricule', Employer::getLastMatricule())
                ->with('fonctions', Fonction::all())
                ->with('page_name', 'Employés / First');
        } else if (count($ecole) >= 2) {
            return redirect()->route('dashboard');
        }
    }
    public function firstUser($id)
    {
        $ecole = User::all();
        $employer = Employer::findOrFail($id);
        if (count($ecole) <= 1) {
            // create ecole
            return view('users.first')
                ->with('employer', $employer)
                ->with('page_name', 'Users / First');
        } else {
            return redirect()->route('dashboard');
        }
    }
    public function storeFirstEmployer(Request $request)
    {
        $ecole = Employer::all();
        if (count($ecole) <= 1) {

            $request->validate([
                'matricule' => ['required', 'string', 'max:255'],
                'nom' => ['required', 'string', 'max:255'],
                'prenom' => ['required', 'string', 'max:255'],
                'date_naissance' => ['required', 'string', 'max:255'],
                'sexe' => ['required', 'string', 'max:255'],
                'formation' => ['required', 'string', 'max:255'],
                'diplome' => ['required', 'string', 'max:255'],
                'niveau_etude' => ['required', 'string', 'max:255'],
                'fonction' => ['required', 'integer', 'max:255'],
            ]);

            $employer = Employer::create([
                'matricule' => $request->matricule,
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'date_naissance' => $request->date_naissance,
                'sexe' => $request->sexe,
                'formation' => $request->formation,
                'diplome' => $request->diplome,
                'niveau_etude' => $request->niveau_etude,
            ]);

            $fonction = Fonction::find($request->fonction);
            $employer->fonctions()->attach($fonction);
            $employer->save();

            return redirect()->route('ecole.first.user', $employer->id);
        } else if (count($ecole) >= 2) {
            return redirect()->route('dashboard');
        }
    }
    public function storeFirstUser(Request $request)
    {
        $ecole = User::all();
        $employer = Employer::where('matricule', $request->matricule)->first();
        if (count($ecole) <= 1) {
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                //'name' => $request->name,
            ]);
            $user->employer()->associate($employer);
            $user->isActive = 1;
            $user->save();

            redirect()->route('dasboard');
        } else if (count($ecole) >= 2) {
            return redirect()->route('dashboard');
        }
    }
}
