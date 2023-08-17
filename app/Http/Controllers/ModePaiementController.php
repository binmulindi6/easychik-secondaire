<?php

namespace App\Http\Controllers;

use App\Models\Logfile;
use App\Models\ModePaiement;
use Illuminate\Http\Request;

class ModePaiementController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255']
        ]);

        Logfile::createLog(
            'mode_paiements',
            ModePaiement::create([
                'nom' => $request->nom
            ])->id
        );

        return back();
    }
}
