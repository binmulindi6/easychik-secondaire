<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $page_name = 'Utilisateurs';


    public function index()
    {
        $page_name = 'Utilisateurs';
        $users = User::where('isAdmin', 0)
            ->latest()
            ->get();

        return view('users.users')
            ->with('page_name', $page_name)
            ->with('items', $users);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::all();
        $user = User::find($id);

        return view('users.users')
            ->with('page_name', $this->page_name . "/Edit")
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
        $request->validate([
            'matricule' => ['required', 'string', 'max:255',],
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'date_naissance' => ['required', 'string', 'max:255'],
            'formation' => ['required', 'string', 'max:255'],
            'diplome' => ['required', 'string', 'max:255'],
            'niveau_etude' => ['required', 'string', 'max:255'],
            'fonction' => ['required', 'integer', 'max:255'],
        ]);

        // $employer = Employer::find($id);
        // $employer->matricule = $request->matricule;
        // $employer->nom = $request->nom;
        // $employer->prenom = $request->prenom;
        // $employer->date_naissance = $request->date_naissance;
        // $employer->formation = $request->formation;
        // $employer->diplome = $request->diplome;
        // $employer->niveau_etude = $request->niveau_etude;

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