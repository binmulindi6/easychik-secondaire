<?php

namespace App\Http\Controllers;

use App\Models\Logfile;
use App\Models\TypeFrais;
use Illuminate\Http\Request;

class TypeFraisController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'devise' => ['required', 'string', 'max:255']
        ]);

        Logfile::createLog(
            'type_frais',
            TypeFrais::create([
                'nom' => $request->nom,
                'devise' => $request->devise
            ])->id
        );

        return back();
    }
}
