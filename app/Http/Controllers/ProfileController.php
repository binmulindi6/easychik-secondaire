<?php

namespace App\Http\Controllers;

use App\Models\Fonction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $page_name = 'Profile';

    public function index(){
        $user = Auth::user();
        if($user->isParent()){
            $self = $user->parrain;
        }else{
            $self = $user->employer;
        }
        // dd($user->isEnseignant());

        return view('users.profile')
                    ->with('user', $user)
                    ->with('self', $self)
                    ->with('fonctions', Fonction::all())
                    ->with('page_name', $this->page_name);
                    
    }
}
