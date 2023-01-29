<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TravailController extends Controller
{
    public function index()
    {
        return redirect()->route('evaluations.index');
        // return view('travails.index')
        //     ->with('page_name', "Travails");
    }
}