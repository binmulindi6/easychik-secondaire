<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController as DefaultLoginController;

class ParentAuthController extends Controller
{
    public function index(){
        return view('parents.login');
    }

    public function username()
    {
        return 'email';
    }

    protected function guard()
    {
        return Auth::guard('parents');
    }

    public function auth(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = $request->only(['email', 'password']);
       return Auth::guard('parents')->validate($user);
    }
}
