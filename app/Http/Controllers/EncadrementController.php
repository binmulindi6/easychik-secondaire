<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Classe;
use App\Models\Logfile;
use App\Models\Encadrement;
use Illuminate\Http\Request;
use App\Models\AnneeScolaire;

class EncadrementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $page_name = 'Encadrements';
    public function index()
    {
        // dd(session()->all());

        $encadrements = Encadrement::latest()
            ->where('isActive', 1)
            ->limit(20)
            ->get();
        $classes = Classe::orderBy('niveau_id', 'asc')->get();
        $annees = AnneeScolaire::current();
        $current = AnneeScolaire::current();
        $users = User::where('isAdmin', '=', '0')
            ->where('parrain_id', null)
            ->get();
        // dd($users);
        return view('users.encadrements')
            ->with('items', $encadrements)
            ->with('classes', $classes)
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
            'classe_id' => ['required', 'integer', 'max:255'],
            'annee_scolaire_id' => ['required', 'integer', 'max:255'],
        ]);

        if (AnneeScolaire::current()->isActive()) {

            $user = User::find($request->user_id);
            if ($user->employer->isActive()) {

                $classe = Classe::find($request->classe_id);
                $annee  = AnneeScolaire::find($request->annee_scolaire_id);

                $enc = Encadrement::where('annee_scolaire_id', $annee->id)
                    ->where('classe_id', $classe->id)
                    ->where('isActive', 1)
                    ->first();
                $enc2 = Encadrement::where('annee_scolaire_id', $annee->id)
                    ->where('user_id', $user->id)
                    ->where('isActive', 1)
                    ->first();

                if ($enc === null) {
                    if ($enc2 === null) {
                        // dd($enc);
                        $encadrement = Encadrement::create();

                        //links 
                        // dd($encadrement);
                        $encadrement->user()->associate($user);
                        $encadrement->classe()->associate($classe);
                        $encadrement->annee_scolaire()->associate($annee);
                        // save
                        $encadrement->save();
                        Logfile::createLog(
                            'encadrements',
                            $encadrement->id
                        );
                        return redirect()->route('encadrements.index');
                    }
                    if ($enc2->classe_id === $classe->id) {
                        $enc2->isActive = 1;
                        $enc2->save();

                        Logfile::updateLog(
                            'encadrements',
                            $enc2->id
                        );
                        return redirect()->route('encadrements.index');
                    }

                    return redirect()->route('encadrements.create')->withErrors([
                        'Classe' => 'Cet Enseignant encadre dejà une autre classe',
                    ])->onlyInput('matricule');
                }
                return redirect()->route('encadrements.create')->withErrors([
                    'Classe' => 'Cette Classe possede dejà un encadreur',
                ])->onlyInput('matricule');
            }
            return redirect()->back()->withErrors([
                "Vous ne pouvez pas effectuer des operations sur les Archives",
            ])->onlyInput('nom');
        }
        return redirect()->back()->withErrors([
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
                'classe_id' => ['required', 'integer', 'max:255'],
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
        $encadrements = Encadrement::latest()
            ->where('isActive', 1)
            ->limit(20)
            ->get();
        $encadrement = Encadrement::find($id);
        $classes = Classe::orderBy('niveau_id', 'asc')->get();
        $annees = AnneeScolaire::orderBy('nom')->get();
        $users = User::where('isAdmin', '=', '0')->where('parrain_id', null)->get();
        // dd($users);
        return view('users.encadrements')
            ->with('items', $encadrements)
            ->with('self', $encadrement)
            ->with('classes', $classes)
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

            $encadrement = Encadrement::find($id);
            $classe = Classe::find($request->classe_id);
            $annee  = AnneeScolaire::find($request->annee_scolaire_id);
            $user = User::find($request->user_id);

            //links 
            // dd($encadrement);
            $enc = Encadrement::where('annee_scolaire_id', $annee->id)
                ->where('classe_id', $classe->id)
                ->where('isActive', 1)
                ->first();

            $enc2 = Encadrement::where('annee_scolaire_id', $annee->id)
                ->where('user_id', $user->id)
                ->where('isActive', 1)
                ->first();

            if ($enc === null) {
                if ($enc2 === null) {
                    $encadrement->user()->associate($user);
                    $encadrement->classe()->associate($classe);
                    $encadrement->annee_scolaire()->associate($annee);
                    // save
                    $encadrement->save();
                    Logfile::updateLog(
                        'encadrements',
                        $encadrement->id
                    );
                    return redirect()->route('encadrements.index');
                }
                if ($enc2->classe_id === $classe->id) {
                    $enc2->isActive = 1;
                    $enc2->save();

                    Logfile::updateLog(
                        'encadrements',
                        $enc2->id
                    );
                    return redirect()->route('encadrements.index');
                }
                return redirect()->route('encadrements.create')->withErrors([
                    'Classe' => 'Cet Enseignant encadre dejà une autre classe',
                ])->onlyInput('matricule');
            }
            return redirect()->route('encadrements.create')->withErrors([
                'Classe' => 'Cette Classe possede dejà un encadreur',
            ])->onlyInput('matricule');
        }
        return redirect()->back()->withErrors([
            "Vous ne pouvez pas effectuer des operations sur les Archives",
        ])->onlyInput('nom');
    }


    public function changeUser(Request $request, $id)
    {
        $request->validate([
            'user_id' => ['required', 'integer', 'max:255'],
            'classe_id' => ['required', 'integer', 'max:255'],
            'annee_scolaire_id' => ['required', 'integer', 'max:255'],
        ]);

        if (AnneeScolaire::current()->isActive()) {

            $oldEncadrement = Encadrement::findOrFail($id);

            $user = User::find($request->user_id);

            $classe = Classe::find($request->classe_id);
            $annee  = AnneeScolaire::find($request->annee_scolaire_id);

            // dd($oldEncadrement->user_id, $request->user_id);
            if ($oldEncadrement->user_id === (int)$request->user_id) {
                return redirect()->route('classes.index');
            } else {

                $enc2 = Encadrement::where('annee_scolaire_id', $annee->id)
                    ->where('user_id', $user->id)
                    ->where('isActive', 1)
                    ->first();

                if ($enc2 !== null) {
                    if ($enc2->classe_id === $classe->id) {
                        $enc2->isActive = 1;
                        $enc2->save();

                        Logfile::updateLog(
                            'encadrements',
                            $enc2->id
                        );
                    } else {
                        $enc2->isActive = 0;
                        $enc2->save();

                        Logfile::updateLog(
                            'encadrements',
                            $enc2->id
                        );
                    }
                }
                $encadrement = Encadrement::create();
                //links 
                // dd($encadrement);
                $encadrement->user()->associate($user);
                $encadrement->classe()->associate($classe);
                $encadrement->annee_scolaire()->associate($annee);
                // save
                $oldEncadrement->isActive = 0;
                $oldEncadrement->save();
                $encadrement->save();
                Logfile::createLog(
                    'encadrements',
                    $encadrement->id
                );
                Logfile::updateLog(
                    'encadrements',
                    $oldEncadrement->id
                );
                return redirect()->route('classes.index');
            }
            return redirect()->route('encadrements.index');
        }
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
            $encadrement = Encadrement::find($id);
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


        $items = Encadrement::join('users', 'encadrements.user_id', 'users.id')
            ->join('employers', 'employer_id', 'employers.id')
            ->where('isActive', 1)
            ->where('isAdmin', 0)
            ->where('nom', 'like', '%' . $request->search . '%')
            ->orWhere('prenom', 'like', '%' . $request->search . '%')
            ->get();

        $classes = Classe::orderBy('niveau_id', 'asc')->get();
        $annees = AnneeScolaire::orderBy('nom')->get();
        $users = User::where('isAdmin', '=', '0')
            ->where('parrain_id', null)
            ->get();

        return view('users.encadrements')
            ->with('items', $items)
            ->with('classes', $classes)
            ->with('annees', $annees)
            ->with('users', $users)
            ->with('search',  $request->search)
            ->with('page_name', $this->page_name . ' / Search');
    }
}
