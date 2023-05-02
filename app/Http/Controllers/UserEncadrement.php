<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Classe;
use App\Models\Encadrement;
use Illuminate\Http\Request;
use App\Models\AnneeScolaire;

class UserEncadrement extends Controller
{
    public static function create($id)
    {   $page = "Encadrements / Create";
        $encadrements = Encadrement::latest()
                        ->limit(10)
                        ->get();
        $classes = Classe::orderBy('niveau_id', 'asc')->get();
        $annees = AnneeScolaire::all();
        $users = User::where('isAdmin', '=', '0')->where('parrain_id', null)->get();
        $user = User::find($id);
        $current = AnneeScolaire::current();

        return view('users.encadrements')
                    ->with('page_name', $page)
                    ->with('user', $user)
                    ->with('items', $encadrements)
                    ->with('classes', $classes)
                    ->with('current', $current)
                    ->with('users', $users)
                    ->with("annees",$annees);
                    
    }

    
    public static function filterUser($user){
        $users = array();
        foreach($user as $u){
            if($u->isEnseignant()){
                array_push($users, $u);
            }
        }
        return $users;
    }

    public static function createClasse($id)
    {   $page = "Encadrements / Create";
        $encadrements = Encadrement::latest()
                        ->limit(10)
                        ->get();
        $classes = Classe::orderBy('niveau_id', 'asc')->get();
        $annees = AnneeScolaire::all();
        $userz = User::where('isAdmin', '=', '0')
                    // ->where('isActive', 1)
                    ->where('parrain_id', null)->get();
        // dd($userz);
        // $users = array();
        // foreach($userz as $u){
        //     if($u->isEnseignant()){
        //         array_push($users, $u);
        //     }
        // }
        // // dd(10);

        // dd($users);

        $classe = Classe::find($id);
        $current = AnneeScolaire::current();

        return view('users.encadrements')
                    ->with('page_name', $page)
                    ->with('classe', $classe)
                    ->with('items', $encadrements)
                    ->with('classes', $classes)
                    ->with('current', $current)
                    ->with('users', $userz)
                    ->with("annees",$annees);
                    
    }

}
