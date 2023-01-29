<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Eleve;
use App\Models\Classe;
use App\Models\Employer;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $eleves = Eleve::count() > 0 ? Eleve::count() : 0;
        $employers = Employer::count() > 0 ? Employer::count() : 0;
        $classes = Classe::count() > 0 ? Classe::count() : 0;
        $users = User::count() > 0 ? User::count() : 0;
        return view('dashboard', [
            'page_name' => 'Dashboard',
            'eleves' => $eleves,
            'employers' => $employers,
            'classes' => $classes,
            'users' => $users,
        ]);
    }
}