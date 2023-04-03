<?php

namespace App\Http\Controllers;

use App\Models\AnneeScolaire;
use Rules\Password;
use App\Models\User;
use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Session\Session;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    protected $page_name = 'Utilisateurs';


    public function index()
    {   
        // $curent = AnneeScolaire::current();
        // $_SESSION['current'] = $curent;
        // // dd($_SESSION);
        
        $page_name = 'Utilisateurs';
        $users = User::where('isAdmin', 0)
        ->latest()
        ->get();
        
        // dd(10);
        return view('users.users')
            ->with('page_name', $page_name)
            ->with('items', $users);
    }

    public function create()
    {
        $page_name = 'Utilisateurs';
        $users = User::where('isAdmin', 0)
        ->latest()
        ->get();
        
        // dd(10);
        return view('users.users')
            ->with('page_name', $page_name . " / Create")
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
        $employer = Employer::where('matricule',$matricule)->first();
        //dd('here');

        if(!is_null($employer)){
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                //'name' => $request->name,
            ]);
            $user->employer()->associate($employer);
            $user->save();
            redirect()->route('users.index');
        }else{
            return back()->withErrors([
                'email' => 'Cet Employer n\'existe pas dans le system',
                ])->onlyInput('matricule');
                
            }
        return redirect()->route('users.create');
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
        $users = User::where('isAdmin', 0)
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

        return redirect()->route('users.index');
    }
}