<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Classe;
use App\Models\Encadrement;
use Illuminate\Http\Request;
use App\Models\AnneeScolaire;

class EncadrementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $page_name = 'Encadrements';
    public function index()
    {   
        // dd(session()->all());

        $encadrements = Encadrement::latest()
                       ->limit(20)
                        ->get();
        $classes = Classe::orderBy('niveau_id', 'asc')->get();
        $annees = AnneeScolaire::orderBy('nom')->get();
        $users = User::where('isAdmin', '=', '0')
                ->where('parrain_id', null)
                ->get();
        // dd($users);
        return view('users.encadrements')
                ->with('items',$encadrements)
                ->with('classes',$classes)
                ->with('annees',$annees)
                ->with('users', $users)
                ->with('page_name',$this->page_name);
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
            'user_id' => ['required', 'integer', 'max:255'],
            'classe_id' => ['required', 'integer', 'max:255'],
            'annee_scolaire_id' => ['required', 'integer', 'max:255'],
        ]);
        
        $user = User::find( $request->user_id);
        
        $classe = Classe::find($request->classe_id);
        $annee  = AnneeScolaire::find($request->annee_scolaire_id);
        
        $enc = Encadrement::where('annee_scolaire_id', $annee->id)
                            ->where('classe_id', $classe->id)
                            ->first();
                            
        if($enc === null){
            dd($enc);
            $encadrement = Encadrement::create();
        
            //links 
            // dd($encadrement);
            $encadrement->user()->associate($user);
            $encadrement->classe()->associate($classe);
            $encadrement->annee_scolaire()->associate($annee);
            // save
            $encadrement->save();
            
            return redirect()->route('encadrements.index');
        }
        return redirect()->route('encadrements.create')->withErrors([
            'classe_id' => 'Cet Employer n\'existe pas dans le system',
            'user_id' => 'Cet Employer n\'existe pas dans le system',
            ])->onlyInput('matricule');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        // dd(10);
        if ($request->_method == 'PUT') {
            $request->validate([
                'user_id' => ['required', 'integer', 'max:255'],
                'classe_id' => ['required', 'integer', 'max:255'],
                'annee_scolaire_id' => ['required', 'integer', 'max:255'],
            ]);
            return  $this->update($request, $id);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $encadrements = Encadrement::latest()
               ->limit(20)
                ->get();
        $encadrement = Encadrement::find($id);
        $classes = Classe::orderBy('niveau_id', 'asc')->get();
        $annees = AnneeScolaire::orderBy('nom')->get();
        $users = User::where('isAdmin', '=', '0')->where('parrain_id', null)->get();
        // dd($users);
        return view('users.encadrements')
        ->with('items',$encadrements)
        ->with('self', $encadrement)
        ->with('classes',$classes)
        ->with('annees',$annees)
        ->with('users', $users)
        ->with('page_name',$this->page_name . " / Edit");
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
        
        $encadrement = Encadrement::find($id);
        $classe = Classe::find($request->classe_id);
        $annee  = AnneeScolaire::find($request->annee_scolaire_id);
        $user = User::find( $request->user_id);

        //links 
        // dd($encadrement);
        $encadrement->user()->associate($user);
        $encadrement->classe()->associate($classe);
        $encadrement->annee_scolaire()->associate($annee);
        // save
        $encadrement->save();
        
        return redirect()->route('encadrements.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $encadrement = Encadrement::find($id);
        $encadrement->delete();
        return redirect()->route('encadrements.index');
    }
}
