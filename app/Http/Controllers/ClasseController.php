<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Classe;
use App\Models\Niveau;
use App\Models\Periode;
use Illuminate\Http\Request;
use App\Models\AnneeScolaire;
use App\Models\CategorieCours;
use App\Models\Trimestre;
use Illuminate\Support\Facades\DB;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $page = "Classes";

    public function index()
    {   


        $classes = Classe::orderBy('niveau_id','asc')->get();
        $niveaux = Niveau::all();
        //$user = User::where('id',)
        // dd($classes[2]);
        // dd($classes[2]->encadrements);
        return view('classe.classes')
            ->with('page_name', $this->page)
            ->with('niveaux', $niveaux)
            ->with('items', $classes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->page = "Classes / Create";
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
            'niveau' => ['required', 'string', 'max:255'],
            'nom' => ['required', 'string', 'max:255'],
        ]);

        // dd($request->nom , $request->niveau);
        $niveau = Niveau::find($request->niveau);
        $classe = Classe::create([
            'nom' => $request->nom,
        ]);

        $classe->niveau()->associate($niveau);

        $classe->save();

        return redirect()->route("classes.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if ($request->_method == 'PUT') {
            return  $this->update($request, $id);
        }
        $classe = Classe::findOrFail($id);
        $annee = AnneeScolaire::current();
        $annees = AnneeScolaire::latest()->get();
        // dd($annees);

        return view('classe.profile')
            ->with('page_name', "Classe / ". $classe->nomComplet())
            ->with('annee_scolaire', $annee)
            ->with('annees', $annees)
            ->with('classe', $classe);
    }

    public function Eleves($id)
    {
        $classe = Classe::findOrFail($id);
        $eleves = $classe->eleves();

        return view('classe.eleves')
                ->with('page_name', $this->page . " / Eleves")
                ->with('items', $eleves)
                ->with('classe', $classe);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $classes = Classe::orderBy('niveau_id', 'asc')->get();
        $classes = Classe::all();
        $classe = Classe::find($id);
        $niveaux = Niveau::all();
        // $users = User::crossJoin('classes', 'classes.user_id', '=', 'users.id')->get();
        // $users = User::whereNotExists(function ($query) {
        //     $query->select(DB::raw(1))
        //         ->from('classes')
        //         ->whereColumn('classes.user_id', 'users.id');
        // })->get();

        // dd($users);
        // $users = User::join('classes', 'users.id', '!=' , 'classes.user_id')
        //             ->get();
                        // ->where('user.fonction');


        // ('classes', 'classes.user_id', '=', 'users.id')->get();
        //dd($users);

        return view('classe.classes')
            ->with('page_name', $this->page . ' / Edit')
            ->with('self', $classe)
            ->with('niveaux', $niveaux)
            ->with('items', $classes);
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

        $request->validate([
            'niveau' => ['required', 'string', 'max:255'],
            'nom' => ['required', 'string', 'max:255'],
            'user' => ['required', 'string', 'max:255'],
        ]);

        $classe = Classe::find($id);
        $classe->niveau = $request->niveau;
        $classe->nom = $request->nom;

        $user = User::find($request->user);
        $classe->user()->associate($user);

        $classe->save();

        return redirect()->route("classes.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classe = Classe::find($id);
        $classe->delete();
        return redirect()->route("classes.index");
    }

    public function resultatPeriode($id,$periode_id,$annee_scolaire_id)
    {
        $classe = Classe::findOrFail($id);
        $periode = Periode::findOrFail($periode_id);
        $annee = AnneeScolaire::findOrFail($annee_scolaire_id);
        // $eleves = $classe->elevesAnnee($annee);

        $classResults = $classe->resultats();
        $res = array();
        // arsort($classResults);
        foreach($classResults as $resultat){
            if($resultat->frequentation->eleve !== null){
                $data = array();
                $data['resultat'] = $this->checkPeriode($resultat, $periode);
                $data['eleve'] = $resultat->frequentation->eleve->nomComplet();
                $data['id'] = $resultat->frequentation->eleve->id;
                array_push($res, $data);
            }
        }
        arsort($res);
        $resultats = array();
        foreach($res as $final ){
            array_push($resultats, $final);
        }
        // dd($resultats);  

        return view('classe.resultats')
            ->with('page_name', "Resultats / Classe")
            ->with('annee_scolaire', $annee)
            ->with('periode', $periode)
            ->with('data', $resultats)
            ->with('classe', $classe);
    }
    public function resultatTrimestre($id,$trimestre_id,$annee_scolaire_id)
    {
        $classe = Classe::findOrFail($id);
        $trimestre = Trimestre::findOrFail($trimestre_id);
        $annee = AnneeScolaire::findOrFail($annee_scolaire_id);
        // $eleves = $classe->elevesAnnee($annee);

        $classResults = $classe->resultats();
        $res = array();
        // dd($trimestre);
        // arsort($classResults);
        foreach($classResults as $resultat){
            if($resultat->frequentation->eleve !== null){
                $data = array();
                $data['resultat'] = $this->checkTrimestre($resultat, $trimestre);
                $data['eleve'] = $resultat->frequentation->eleve->nomComplet();
                $data['id'] = $resultat->frequentation->eleve->id;
                array_push($res, $data);
            }
        }
        arsort($res);
        $resultats = array();
        foreach($res as $final ){
            array_push($resultats, $final);
        }

        return view('classe.resultats')
            ->with('page_name', "Resultats / Classe")
            ->with('annee_scolaire', $annee)
            ->with('trimestre', $trimestre)
            ->with('data', $resultats)
            ->with('classe', $classe);
    }
    public function resultatAnnee($id,$annee_scolaire_id)
    {   
        $classe = Classe::findOrFail($id);
        $annee = AnneeScolaire::findOrFail($annee_scolaire_id);

        $classResults = $classe->resultats();
        $res = array();
        // dd($trimestre);
        // arsort($classResults);
        foreach($classResults as $resultat){
            // dd($resultat);
            if($resultat->frequentation->eleve !== null){
                $data = array();
                $data['resultat'] = $resultat->annee;
                $data['eleve'] = $resultat->frequentation->eleve->nomComplet();
                $data['id'] = $resultat->frequentation->eleve->id;
                array_push($res, $data);
            }
        }
        arsort($res);
        $resultats = array();
        foreach($res as $final ){
            array_push($resultats, $final);
        }

        return view('classe.resultats')
            ->with('page_name', "Resultats / Classe")
            ->with('annee_scolaire', $annee)
            ->with('data', $resultats)
            ->with('classe', $classe);
    }


    //methods
    public function checkPeriode($resultat, $periode)
    {
        // $data ;
        switch ($periode->nom) {
            case 'PREMIERE PERIODE':
                $data = $resultat->periode1;
                break;
            case 'DEUXIEME PERIODE':
                $data = $resultat->periode2;
                break;
            case 'TROISIEME PERIODE':
                $data = $resultat->periode3;
                break;
            case 'QUATRIEME PERIODE':
                $data = $resultat->periode4;
                break;
            case 'CINQUIME PERIODE':
                $data = $resultat->periode5;
                break;
            case 'SIXIEME PERIODE':
                $data = $resultat->periode6;
                break;
        }

        return $data;
    }

    public function checkTrimestre($resultat, $trimestre)
    {
        // dd($trimestre);
        $trim = 0.00 ;
        switch ($trimestre->nom) {
                case 'PREMIER TRIMESTRE':
                    $trim = $resultat->trimestre1;
                break;
                case 'DEUXIEME TRIMESTRE':
                    $trim = $resultat->trimestre2;
                    break;
                case 'TROISIEME TRIMESTRE':
                    $trim = $resultat->trimestre3;
                break;
        }

        return $trim;
    }
}

