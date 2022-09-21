<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $page_name = 'Utilisateurs';

    
    public function index(){
        $page_name = 'Utilisateurs';
        $users = User::where('isAdmin', 0)
        ->latest()
        ->get();            
        
        return view('users.users')
                    ->with('page_name', $page_name)
                    ->with('items', $users);
    }

    public function changeStatut(Request $request, $id){
        $user = User::find($id);
        
        if($request->statut == '0'){
            $user->isActive = 1;
        } else {
            $user->isActive = 0;
        }
        $user->save();
        
        return redirect()->route('users.index');
        
    }
}
