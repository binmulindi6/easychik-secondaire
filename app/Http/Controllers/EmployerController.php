<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Logfile;
use App\Models\Employer;
use App\Models\Fonction;
use App\Models\FileUpload;
use Illuminate\Http\Request;
use App\Models\AnneeScolaire;
use Illuminate\Support\Facades\Storage;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $page = 'Employers';
    public function index()
    {
        $employers = Employer::all()->except(['id', 1]);
        $fonctions = Fonction::select([
            'id',
            'nom'
        ])->get();

        $lastmatricule = Employer::withTrashed()->get('*')->last()->matricule;
        //dd($lastmatricule);
        // $lastmatricule = Employer::all()->last()->matricule;
        // $lastmatricule = Employer::withTrashed()->lastest()->matricule;
        $initial = explode('/', $lastmatricule, -1)[0];
        $middle = str_replace('P', '', $initial);
        $matricule = 'P0' . intval($middle) + 1 . '/' . date('Y');

        return view('employer.employers')
            ->with('page_name', $this->page)
            ->with('items', $employers)
            ->with('fonctions', $fonctions)
            ->with('last_matricule', $matricule);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->page .= '/Create';
        return $this->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   // dd(10);
        $request->validate([
            'matricule' => ['required', 'string', 'max:255'],
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'date_naissance' => ['required', 'string', 'max:255'],
            'sexe' => ['required', 'string', 'max:255'],
            'formation' => ['required', 'string', 'max:255'],
            'diplome' => ['required', 'string', 'max:255'],
            'niveau_etude' => ['required', 'string', 'max:255'],
            'fonction' => ['required', 'integer', 'max:255'],
        ]);

        $employer = Employer::create([
            'matricule' => $request->matricule,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'date_naissance' => $request->date_naissance,
            'sexe' => $request->sexe,
            'formation' => $request->formation,
            'diplome' => $request->diplome,
            'niveau_etude' => $request->niveau_etude,
        ]);

        $fonction = Fonction::find($request->fonction);
        $employer->fonctions()->attach($fonction);
        $employer->save();

        Logfile::createLog(
            'employers',
            $employer->id
        );

        return redirect()->route('employers.index');
    }

    public function uploadProfile(Request $request)
    {
        
        $request->validate([
            'image' => ['required','image','max:2048'],
            'employer_id' => ['required','string','max:255']
        ]);


        $employer = Employer::findOrFail($request->employer_id);
        $file = $request->file('image');

        $upload = new FileUpload('/profiles/employers/',['jpg','jpeg','png']);
        $oldAvatar = $employer->avatar;

        $employer->avatar = $upload->uploadFile($file);
        $employer->save();

        Logfile::updateLog(
            'employers',
            $employer->id
        );

        Storage::disk('public')->delete('/profiles/employers/'.$oldAvatar);
    
        if(isset($request->back)){
            return back();
        }else{
            return redirect()->route('employers.show', $employer->id);
        }

        //laravel 9 file upload system?
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
            $request->validate([
                'matricule' => ['required', 'string', 'max:255'],
                'nom' => ['required', 'string', 'max:255'],
                'prenom' => ['required', 'string', 'max:255'],
                'date_naissance' => ['required', 'string', 'max:255'],
                'nationalite' => ['required', 'string', 'max:255'],
                'sexe' => ['required', 'string', 'max:255'],
                'formation' => ['required', 'string', 'max:255'],
                'diplome' => ['required', 'string', 'max:255'],
                'niveau_etude' => ['required', 'string', 'max:255'],
                'fonction' => ['required', 'integer', 'max:255'],
            ]);

            //dd(10);
            return  $this->update($request, $id);
        }

        $employer = Employer::findOrFail($id);
        $user = User::where('employer_id', $employer->id)->first();
        $self = $employer;

        $employers = Employer::all()->except(['id', 1]);
        ///joker
        $index = 0;
        for ($i = 0; $i < $employers->count(); $i++) {
            if ($employers[$i]->id === $employer->id) {
                $index = $i;
                break;
            }
        }

        return view('employer.show')
            ->with('user', $user)
            ->with('self', $self)
            ->with('index', $index)
            ->with('employers', $employers)
            ->with('fonctions', Fonction::all())
            ->with('page_name', 'Users / Show ');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employers = Employer::all();
        $employer = Employer::find($id);
        $fonctions = Fonction::select([
            'id',
            'nom'
        ])->get();
        return view('employer.employers')
            ->with('page_name', $this->page . "/Edit")
            ->with('self', $employer)
            ->with('items', $employers)
            ->with('fonctions', $fonctions);
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
            'matricule' => ['required', 'string', 'max:255',],
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'date_naissance' => ['required', 'string', 'max:255'],
            'nationalite' => ['required', 'string', 'max:255'],
            'sexe' => ['required', 'string', 'max:255'],
            'formation' => ['required', 'string', 'max:255'],
            'diplome' => ['required', 'string', 'max:255'],
            'niveau_etude' => ['required', 'string', 'max:255'],
            'fonction' => ['required', 'integer', 'max:255'],
        ]);

        $employer = Employer::find($id);
        if ($employer->isActive()) {

            $employer->matricule = $request->matricule;
            $employer->nom = $request->nom;
            $employer->prenom = $request->prenom;
            $employer->nationalite = $request->nationalite;
            $employer->date_naissance = $request->date_naissance;
            $employer->sexe = $request->sexe;
            $employer->formation = $request->formation;
            $employer->diplome = $request->diplome;
            $employer->niveau_etude = $request->niveau_etude;

            if ($request->fonction !== null) {
                $fonction = Fonction::find($request->fonction);

                //detach all 
                $employer->fonctions()->detach();

                $employer->fonctions()->attach($fonction);
            }

            $employer->save();
            Logfile::updateLog(
                'employers',
                $employer->id
            );
            if (isset($request->back)) {
                return redirect()->back();
            }

            return redirect()->route('employers.index');
        }
        return redirect()->back()->withErrors([
            "Vous ne pouvez pas effectuer des operations sur les Archives",
        ])->onlyInput('nom');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employer = Employer::find($id);
        if ($employer->isActive()) {
            $employer->delete();
            Logfile::deleteLog(
                'employers',
                $employer->id
            );
            return redirect()->route('employers.index');
        }
        return redirect()->back()->withErrors([
            "Vous ne pouvez pas effectuer des operations sur les Archives",
        ])->onlyInput('nom');
    }


    public function linkEmployer()
    {
        $employers = Employer::latest()->get();
        // dd($employers[0]->user);
        return view('users.employers')
            ->with('page_name', 'Link Employé')
            ->with('items', $employers)
            ->with('link', true);
    }

    public function search(Request $request)
    {


        $items = Employer::where('id', '!=', 1)
            ->where('nom', 'like', '%' . $request->search . '%')
            ->orWhere('prenom', 'like', '%' . $request->search . '%')
            ->get();

        $fonctions = Fonction::select([
            'id',
            'nom'
        ])->get();

        $lastmatricule = Employer::withTrashed()->get('*')->last()->matricule;
        //dd($lastmatricule);
        // $lastmatricule = Employer::all()->last()->matricule;
        // $lastmatricule = Employer::withTrashed()->lastest()->matricule;
        $initial = explode('/', $lastmatricule, -1)[0];
        $middle = str_replace('P', '', $initial);
        $matricule = 'P0' . intval($middle) + 1 . '/' . date('Y');
        return view('employer.employers')
            ->with('page_name', $this->page . ' / Search')
            ->with('search',  $request->search)
            ->with('items', $items)
            ->with('fonctions', $fonctions)
            ->with('last_matricule', $matricule);
    }

    ///carte

    public function carte($id)
    {
        $eleve = Employer::findOrFail($id);
        return view('employer.carte')
            ->with('eleve', $eleve);
    }

    public function changeStatut(Request $request, $id)
    {
        $user = Employer::findOrFail($id);

        if ($request->statut == '0') {
            $user->isActive = 1;
        } else {
            $user->isActive = 0;
        }
        $user->save();

        Logfile::updateLog(
            'employers',
            $user->id
        );

        return redirect()->route('employers.index');
    }
}
