<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cours;
use App\Models\Classe;
// use App\Models\Encadrement;
use App\Models\Logfile;
use App\Models\Enseignement;
use Illuminate\Http\Request;
use App\Models\AnneeScolaire;

class EnseignementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $page_name = 'Enseignements';
    public function index()
    {
        // dd(session()->all());

        $encadrements = Enseignement::latest()
            ->where('isActive', 1)
            ->limit(20)
            ->get();
        $cours = Cours::orderBy('niveau_id', 'asc')->get();
        $annees = AnneeScolaire::current();
        $current = AnneeScolaire::current();
        $users = User::where('isAdmin', '=', '0')
            ->where('parrain_id', null)
            ->get();
        // dd($users);
        return view('users.enseignements')
            ->with('items', $encadrements)
            ->with('cours', $cours)
            ->with('annees', $annees)
            ->with('current', $current)
            ->with('users', $users)
            ->with('page_name', $this->page_name);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->page_name .= " / Create";
        return $this->index();
    }

    public static function createCours($id)
    {
        $page = "Enseignements / Create";
        $enseignements = Enseignement::latest()
        ->where('isActive', 1)
            ->limit(30)
            ->get();
        $cours = Cours::orderBy('niveau_id', 'asc')->get();
        $annees = AnneeScolaire::orderBy('nom')->get();
        $userz = User::where('isAdmin', '=', '0')
            // ->where('isActive', 1)
            ->where('parrain_id', null)->get();

        $cour = Cours::find($id);
        $current = AnneeScolaire::current();
        // dd(10);
        return view('users.enseignements')
            ->with('page_name', $page)
            ->with('cour', $cour)
            ->with('items', $enseignements)
            ->with('cours', $cours)
            ->with('current', $current)
            ->with('users', $userz)
            ->with("annees", $annees);
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
            'user_id' => ['required', 'integer', 'max:255'],
            'cours_id' => ['required', 'integer', 'max:255'],
            'annee_scolaire_id' => ['required', 'integer', 'max:255'],
        ]);


        if (AnneeScolaire::current()->isActive()) {

            $user = User::find($request->user_id);
            if ($user->employer->isActive()) {

                $cours = Cours::findOrFail($request->cours_id);
                $annee  = AnneeScolaire::findOrFail($request->annee_scolaire_id);

                $enc = Enseignement::where('annee_scolaire_id', $annee->id)
                    ->where('cours_id', $cours->id)
                    ->where('isActive', 1)
                    ->first();
                $enc2 = Enseignement::where('annee_scolaire_id', $annee->id)
                    ->where('user_id', $user->id)
                    ->where('cours_id', $cours->id)
                    ->first();

                // dd($enc, $enc2);

                if ($enc === null) {
                    if ($enc2 === null) {
                        // dd($enc);
                        $enseignement = Enseignement::create();

                        //links 
                        // dd($encadrement);
                        $enseignement->user()->associate($user);
                        $enseignement->cours()->associate($cours);
                        $enseignement->annee_scolaire()->associate($annee);
                        // save
                        $enseignement->save();
                        Logfile::createLog(
                            'enseignements',
                            $enseignement->id
                        );
                        return redirect()->route('enseignements.index');
                    } else {
                        if ($enc2->cours_id === $cours->id) {
                            $enc2->isActive = 1;
                            $enc2->save();

                            Logfile::updateLog(
                                'enseignements',
                                $enc2->id
                            );
                            return redirect()->route('enseignements.index');
                        }
                    }
                    // return redirect()->route('enseignements.create')->withErrors([
                    //     'Classe' => 'Cet Enseignant encadre dejà une autre classe',
                    // ])->onlyInput('cours_id');
                }
                return redirect()->route('enseignements.create')->withErrors([
                    'Classe' => 'Cet Cours possede dejà un enseignant',
                ])->onlyInput('cours_id');
            }
            return redirect()->route('enseignements.create')->withErrors([
                "Vous ne pouvez pas effectuer des operations sur les Archives",
            ])->onlyInput('nom');
        }
        return redirect()->route('enseignements.create')->withErrors([
            "Vous ne pouvez pas effectuer des operations sur les Archives",
        ])->onlyInput('nom');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        // dd(10);
        if ($request->_method == 'PUT') {
            $request->validate([
                'user_id' => ['required', 'integer', 'max:255'],
                'cours_id' => ['required', 'integer', 'max:255'],
                'annee_scolaire_id' => ['required', 'integer', 'max:255'],
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
        $enseignements = Enseignement::latest()
            ->where('annee_scolaire_id', AnneeScolaire::current()->id)
            ->where('isActive', 1)
            ->limit(30)
            ->get();
        $enseignement = Enseignement::findOrFail($id);
        $cours = Cours::orderBy('niveau_id', 'asc')->get();
        $annees = AnneeScolaire::orderBy('nom')->get();
        $users = User::where('isAdmin', '=', '0')->where('parrain_id', null)->get();
        // dd($users);
        return view('users.enseignements')
            ->with('items', $enseignements)
            ->with('self', $enseignement)
            ->with('cours', $cours)
            ->with('annees', $annees)
            ->with('users', $users)
            ->with('page_name', $this->page_name . " / Edit");
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

        if (AnneeScolaire::current()->isActive()) {

            $user = User::find($request->user_id);
            if ($user->employer->isActive()) {

                $enseignement = Enseignement::findOrFail($id);
                $cours = Cours::findOrFail($request->cours_id);
                $annee  = AnneeScolaire::findOrFail($request->annee_scolaire_id);

                //links 
                // dd($encadrement);
                $enc = Enseignement::where('annee_scolaire_id', $annee->id)
                    ->where('cours_id', $cours->id)
                    ->where('isActive', 1)
                    ->first();

                $enc2 = Enseignement::where('annee_scolaire_id', $annee->id)
                    ->where('user_id', $user->id)
                    ->where('cours_id', $cours->id)
                    ->first();

                if ($enc === null) {
                    if ($enc2 === null) {
                        $enseignement->user()->associate($user);
                        $enseignement->cours()->associate($cours);
                        $enseignement->annee_scolaire()->associate($annee);
                        
                        // save
                        $enseignement->save();
                        Logfile::updateLog(
                            'enseignements',
                            $enseignement->id
                        );
                        return redirect()->route('enseignements.index');
                    }
                    if ($enc2->cours_id === $cours->id) {
                        $enc2->isActive = 1;
                        $enc2->save();

                        Logfile::updateLog(
                            'enseignements',
                            $enc2->id
                        );
                        return redirect()->route('enseignements.index');
                    }
                    return redirect()->back()->withErrors([
                        'Classe' => '⛔ Cet Cours possede dejà un enseignant',
                    ])->onlyInput('cours_id');
                }
                return redirect()->back()->withErrors([
                    'Classe' => '⛔ Cet Cours possede dejà un enseignant',
                ])->onlyInput('cours_id');
            }
            return redirect()->back()->withErrors([
                "⛔ Vous ne pouvez pas effectuer des operations sur les Archives",
            ])->onlyInput('nom');
        }
        return redirect()->back()->withErrors([
            "⛔ Vous ne pouvez pas effectuer des operations sur les Archives",
        ])->onlyInput('nom');
    }


    public function changeUser(Request $request, $id)
    {
        $request->validate([
            'user_id' => ['required', 'integer', 'max:255'],
            'cours_id' => ['required', 'integer', 'max:255'],
            'annee_scolaire_id' => ['required', 'integer', 'max:255'],
        ]);

        if (AnneeScolaire::current()->isActive()) {

            $user = User::findOrFail($request->user_id);
            if ($user->employer->isActive()) {

                $oldEnseignement = Enseignement::findOrFail($id);

                $cours = Cours::findOrFail($request->cours_id);
                $annee  = AnneeScolaire::findOrFail($request->annee_scolaire_id);

                // dd($oldEncadrement->user_id, $request->user_id);
                if (((int)$oldEnseignement->user_id === (int)$request->user_id) && (int)$oldEnseignement->isActive === 1) {
                    return redirect()->route('cours.index');
                } else {

                    $enc2 = Enseignement::where('annee_scolaire_id', $annee->id)
                        ->where('user_id', $user->id)
                        ->where('cours_id', $cours->id)
                        // ->where('isActive', 1)
                        ->first();

                    if ($enc2 !== null) {
                        // if ($enc2->cours_id === $cours->id) {
                        $enc2->isActive = 1;
                        $enc2->save();
                        Logfile::updateLog(
                            'enseignements',
                            $enc2->id
                        );

                        $oldEnseignement->isActive = 0;
                        $oldEnseignement->save();
                        Logfile::updateLog(
                            'enseignements',
                            $oldEnseignement->id
                        );

                        // } else {
                        //     $enc2->isActive = 0;
                        //     $enc2->save();

                        //     Logfile::updateLog(
                        //         'encadrements',
                        //         $enc2->id
                        //     );
                        // }
                    } else {
                        $enseignement = Enseignement::create();
                        $enseignement->user()->associate($user);
                        $enseignement->cours()->associate($cours);
                        $enseignement->annee_scolaire()->associate($annee);
                        $enseignement->save();
                        // save
                        $oldEnseignement->isActive = 0;
                        $oldEnseignement->save();
                        Logfile::createLog(
                            'enseignements',
                            $enseignement->id
                        );
                        Logfile::updateLog(
                            'enseignements',
                            $oldEnseignement->id
                        );
                        return redirect()->route('cours.index');
                    }
                }
                return redirect()->route('cours.index');
            }

            return redirect()->back()->withErrors([
                "Vous ne pouvez pas effectuer des operations sur les Archives",
            ])->onlyInput('nom');
        }
        return redirect()->back()->withErrors([
            "Vous ne pouvez pas effectuer des operations sur les Archives",
        ])->onlyInput('nom');
        return redirect()->back()->withErrors([
            "Vous ne pouvez pas effectuer des operations sur les Archives",
        ])->onlyInput('nom');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (AnneeScolaire::current()->isActive()) {
            $encadrement = Enseignement::find($id);
            $encadrement->delete();

            Logfile::deleteLog(
                'encadrements',
                $encadrement->id
            );
            return redirect()->route('encadrements.index');
        }
        return redirect()->back()->withErrors([
            "Vous ne pouvez pas effectuer des operations sur les Archives",
        ])->onlyInput('nom');
    }

    public function search(Request $request)
    {


        $items = Enseignement::join('users', 'encadrements.user_id', 'users.id')
            ->join('employers', 'employer_id', 'employers.id')
            ->where('isAdmin', 0)
            ->where('isActive', 1)
            ->where('nom', 'like', '%' . $request->search . '%')
            ->orWhere('prenom', 'like', '%' . $request->search . '%')
            ->get();

        $cours = Cours::orderBy('niveau_id', 'asc')->get();
        $annees = AnneeScolaire::orderBy('nom')->get();
        $users = User::where('isAdmin', '=', '0')
            ->where('parrain_id', null)
            ->get();

        return view('users.enseignements')
            ->with('items', $items)
            ->with('classes', $cours)
            ->with('annees', $annees)
            ->with('users', $users)
            ->with('search',  $request->search)
            ->with('page_name', $this->page_name . ' / Search');
    }
}
