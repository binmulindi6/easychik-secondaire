<?php

namespace App\Http\Controllers;

use App\Models\Frais;
use App\Models\ModePaiement;
use App\Models\Niveau;
use App\Models\TypeFrais;
use Illuminate\Http\Request;

class FraisController extends Controller
{   
    protected $page_name = "Frais";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(10);
        $frais = Frais::latest()->get();
        $types = TypeFrais::all();
        $niveaux = Niveau::all();
        $modes = ModePaiement::all();

        return view('frais.frais')
            ->with('items', $frais)
            ->with('types', $types)
            ->with('niveaux', $niveaux)
            ->with('modes', $modes)
            ->with('page_name', $this->page_name);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->page_name .= " / Create";
        return $this->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'montant' => ['required', 'string', 'max:10'],
            'mode_paiement' => ['required', 'string', 'max:255'],
            'type_frais' => ['required', 'string', 'max:255'],
            'niveau' => ['required', 'string', 'max:255'],
        ]);
        // dd(10);

        if($request->niveau === 'all'){

            $niveaux = Niveau::all();

            foreach($niveaux as $niveau){
                $frais = Frais::create([
                    'nom' => $request->nom,
                    'montant' => $request->montant,
                ]);
    
                $type = TypeFrais::find($request->type_frais);
                $mode = ModePaiement::find($request->mode_paiement);

                $frais->type_frais()->associate($type);
                $frais->niveau()->associate($niveau);
                $frais->mode_paiement()->associate($mode);
    
                $frais->save();
            }

        }else{
            $frais = Frais::create([
                'nom' => $request->nom,
                'montant' => $request->montant,
            ]);

            $type = TypeFrais::find($request->type_frais);
            $niveau = Niveau::find($request->niveau);
            $mode = ModePaiement::find($request->mode_paiement);

            ///

            $frais->type_frais()->associate($type);
            $frais->niveau()->associate($niveau);
            $frais->mode_paiement()->associate($mode);

            $frais->save();
        }
        return redirect()->route('frais.index');
        // return "succes";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'montant' => ['required', 'integer', 'max:10'],
            'mode_paiement' => ['required', 'integer', 'max:10'],
            'type_frais' => ['required', 'integer', 'max:10'],
            'niveau' => ['required', 'integer', 'max:10'],
        ]);
        return redirect()->route('frais.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $self = Frais::find($id);
        $frais = Frais::latest()->get();

        return view('frais.frais')
            ->with('items', $frais)
            ->with('self', $frais)
            ->with('page_name', $this->page_name . " / Edit");
        
        return redirect()->route('frais.index');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $self = Frais::find($id);
        $self->delete();
        return redirect()->route('frais.index');
    }
}
