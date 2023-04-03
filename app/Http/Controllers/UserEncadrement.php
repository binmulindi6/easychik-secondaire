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
        $users = User::where('isAdmin', '=', '0')->get();
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
}
