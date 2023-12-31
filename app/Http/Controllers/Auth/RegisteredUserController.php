<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        abort(404);
        return view('auth.register');
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
        
        // dd(10);

        // dd($userExist);
        $matricule = $request->matricule;
        $employer = Employer::where('matricule',$matricule)->first();
        //dd('here');

        $userExist = User::where('employer_id', $employer->id)
                            ->first();
        if($userExist !== null){
            return back()->withErrors([
                'matricule' => 'Cet Employer possede déjà un compte utilisateur',
            ])->onlyInput('matricule');
        }

        // if(!is_null($employer)){
        //     if ($employer->fonction->nom === 'Informaticien') {
        //         $user = User::create([
        //             'email' => $request->email,
        //             'password' => Hash::make($request->password),
        //             'isAdmin' => 1,
        //             'isActive' => 1,
        //         ]);
        //     }else{
        //         $user = User::create([
        //             'email' => $request->email,
        //             'password' => Hash::make($request->password),
                    
        //         ]);
        //      }
        //     $user->employer()->associate($employer);
        //     $user->save();
        //     dd($user);
            
        //     event(new Registered($user));
            
        //     Auth::login($user);
            
        //     return redirect(RouteServiceProvider::HOME);
        // }else{
        //     return back()->withErrors([
        //         'email' => 'Cet Employer n\'existe pas dans le system',
        //     ])->onlyInput('matricule');
            
        // }
        // return redirect('users.index');
    }
}
