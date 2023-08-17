<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Eleve;
use App\Models\Logfile;
use App\Models\Parrain;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class ParrainController extends Controller
{
    protected $page_name = 'Parents';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $curent = AnneeScolaire::current();
        // $_SESSION['current'] = $curent;
        // // dd($_SESSION);

        $parents = Parrain::latest()->get();
        // dd($parents);

        // dd(10);
        return view('parents.parents')
            ->with('page_name', $this->page_name)
            ->with('items', $parents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->page_name .= ' / Create';
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
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'telephone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);

        $parent = Parrain::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'telephone' => $request->telephone,
        ]);
        $parent->save();
        Logfile::createLog(
            'parrains',
            $parent->id
        );
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            //'name' => $request->name,
        ]);

        $user->parrain()->associate($parent);
        $user->save();
        Logfile::createLog(
            'users',
            $user->id
        );
        return redirect()->route('parents.index');
        // return redirect()->route('parents.create');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Parrain  $parrain
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if ($request->_method == 'PUT') {
            $request->validate([
                'nom' => ['required', 'string', 'max:255'],
                'prenom' => ['required', 'string', 'max:255'],
                'telephone' => ['required', 'string', 'max:255'],
            ]);

            //dd(10);
            return  $this->update($request, $id);
        }
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Parrain  $parrain
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parents = Parrain::latest()->get();
        $parent = Parrain::find($id);
        // dd($parents);

        // dd(10);
        return view('parents.parents')
            ->with('page_name', $this->page_name . ' / Edit')
            ->with('self', $parent)
            ->with('items', $parents);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Parrain  $parrain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:255'],
        ]);

        $parent = Parrain::findOrFail($id);
        $parent->nom = $request->nom;
        $parent->prenom = $request->prenom;
        $parent->telephone = $request->telephone;

        $parent->save();
        Logfile::updateLog(
            'parrains',
            $parent->id
        );

        if (isset($request->password)) {

            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $user = User::where('parrain_id', $id)->first();
            $user->password = Hash::make($request->password);
            $user->save();
            Logfile::updateLog(
                'users',
                $user->id
            );
        }

        if (isset($request->back)) {
            return back();
        }

        return redirect()->route('parents.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Parrain  $parrain
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $parent = Parrain::find($id);
        $user = $parent->user;
        $user->isActive = 0;

        $user->save();
        Logfile::updateLog(
            'users',
            $user->id
        );

        $parent->delete();
        Logfile::deleteLog(
            'parrains',
            $user->id
        );

        return back();
    }

    public function changeStatut(Request $request, $id)
    {
        $parent = Parrain::find($id);
        $user = User::find($parent->user->id);

        if ($request->statut == '0') {
            $user->isActive = 1;
        } else {
            $user->isActive = 0;
        }
        $user->save();
        Logfile::updateLog(
            'users',
            $user->id
        );

        return redirect()->route('parents.index');
    }

    public function linkParentEleve($parent, $eleve)
    {
        $Parent = Parrain::find($parent);
        $Student = Eleve::find($eleve);

        $Student->parrain()->associate($Parent);
        $Student->save();

        return redirect()->route('parents.index');

        // dd($parent . " " . $eleve);
    }

    public function search(Request $request)
    {


        $items = Parrain::where('nom', 'like', '%' . $request->search . '%')
            ->orWhere('prenom', 'like', '%' . $request->search . '%')
            ->get();


        // dd($users);
        return view('parents.parents')
            ->with('page_name', $this->page_name . ' / Search')
            ->with('search',  $request->search)
            ->with('items', $items);
    }
}
