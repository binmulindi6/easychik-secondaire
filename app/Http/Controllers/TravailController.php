<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TravailController extends Controller
{
    public function index()
    {
        $classes = Auth::user()->classes();
        // dd($classes);
        return view('travails.classe')
            ->with('classes', $classes)
            ->with('page_name', "Travails");
    }
}
