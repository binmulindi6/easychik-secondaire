<?php

namespace App\Http\Controllers;

use Rules\Password;
use App\Models\User;
use App\Models\Logfile;
use App\Models\Employer;
use App\Models\Fonction;
use Illuminate\Http\Request;
use App\Models\AnneeScolaire;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Session\Session;

class 
UserController extends Controller
{
    protected $page_name = 'Utilisateurs';


    public function index()
    {
        // $curent = AnneeScolaire::current();
        // $_SESSION['current'] = $curent;
        // // dd($_SESSION);

        $page_name = 'Utilisateurs';
        $users = User::where('email','!=', 'admin@easychik.com')
            ->where('isAdmin', 0)
            ->where('parrain_id', null)
            ->latest()
            ->get();

        // dd($users);
        return view('users.users')
            ->with('page_name', $page_name)
            ->with('items', $users);
    }

    public function enseignants()
    {
        // $curent = AnneeScolaire::current();
        // $_SESSION['current'] = $curent;
        // // dd($_SESSION);

        $page_name = 'Utilisateurs';
        $users = User::where('email','!=', 'admin@easychik.com')
            ->where('isAdmin', 0)
            ->where('parrain_id', null)
            ->latest()
            ->get();

        // dd($users);
        return view('users.users')
            ->with('page_name', 'Enseignants')
            ->with('items', $users);
    }

    public function create($id = null)
    {
        $page_name = 'Utilisateurs';
        $id !== null && $employe = Employer::findOrFail($id);
        $users = User::where('isAdmin', 0)->where('parrain_id', null)
            ->latest()
            ->get();

        // dd(10);
        return view('users.users')
            ->with('page_name', $page_name . " / Create")
            ->with('employe', isset($employe) ? $employe : null)
            ->with('items', $users);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'matricule' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $matricule = $request->matricule;
        $employer = Employer::where('matricule', $matricule)->first();
        //dd('here');

        $userExist = User::where('employer_id', $employer->id)
            ->first();

        if ($userExist !== null) {
            return back()->withErrors([
                'matricule' => 'Cet Employer possede déjà un compte utilisateur',
            ])->onlyInput('matricule');
        }

        if (!is_null($employer)) {
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                //'name' => $request->name,
            ]);
            $user->employer()->associate($employer);
            $user->save();

            Logfile::createLog(
                'users',
                $user->id
            );
            redirect()->route('users.index');
        } else {
            return back()->withErrors([
                'email' => 'Cet Employer n\'existe pas dans le system',
            ])->onlyInput('matricule');
        }
        return redirect()->route('users.index');
    }

    public function changeStatut(Request $request, $id)
    {
        $user = User::find($id);

        if ($request->statut == '0') {
            $user->isActive = 1;
        } else {
            $user->isActive = 0;
        }
        $user->save();

        Logfile::updateLog(
            'users',
            $user->id
        );

        return redirect()->route('users.index');
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
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            //dd(10);
            return  $this->update($request, $id);
        }
        $user = User::findOrFail($id);
        if ($user->isParent()) {
            $self = $user->parrain;
        } else {
            $self = $user->employer;
        }
        // dd($user->isEnseignant());

        return view('users.profile')
            ->with('user', $user)
            ->with('self', $self)
            ->with('fonctions', Fonction::all())
            ->with('page_name', 'Users / Show ');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::where('isAdmin', 0)->where('parrain_id', null)
            ->latest()
            ->get();
        $user = User::find($id);

        // dd(10);
        return view('users.users')
            ->with('page_name', $this->page_name . " / Edit")
            ->with('self', $user)
            ->with('items', $users);
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
        // dd(10);
        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->save();


        Logfile::updateLog(
            'users',
            $user->id
        );

        if (isset($request->back)) {
            return back();
        }

        return  redirect()->route('users.index');


        // $fonction = Fonction::find($request->fonction);

        // //detach all 
        // $employer->fonctions()->detach();;

        // $employer->fonctions()->attach($fonction);
        // $employer->save();

        // return redirect()->route('employers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();


        Logfile::deleteLog(
            'users',
            $user->id
        );
        return redirect()->route('users.index');
    }

    public function search(Request $request)
    {


        $items = User::join('employers','employer_id','employers.id')
            ->where('email','!=', 'admin@easychik.com')
            ->where('nom', 'like', '%' . $request->search . '%')
            ->orWhere('prenom', 'like', '%' . $request->search . '%')
            ->get();


        // dd($users);
        return view('users.users')
            ->with('page_name', Auth::user()->isAdmin() ? $this->page_name . ' / Search' : 'Enseignants / Search')
            ->with('search',  $request->search)
            ->with('items', $items);
    }
    // public function searchEnseignant(Request $request)
    // {


    //     $items = User::join('employers','employer_is','employers.id')
    //         ->where('isAdmin', 0)
    //         ->where('nom', 'like', '%' . $request->search . '%')
    //         ->orWhere('prenom', 'like', '%' . $request->search . '%')
    //         ->get();


    //     // dd($users);
    //     return view('users.users')
    //         ->with('page_name', Auth::user()->isAdmin() ? $this->page_name . ' / Search' : 'Enseignants / Search')
    //         ->with('search',  $request->search)
    //         ->with('items', $items);
    // }

    

}
