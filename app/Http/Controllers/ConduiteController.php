<?php

namespace App\Http\Controllers;

use App\Models\AnneeScolaire;
use App\Models\Logfile;
use App\Models\Conduite;
use Illuminate\Http\Request;

class ConduiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $page = 'Conduites';

    public function index()
    {
        $consuites = Conduite::all();

        return view('ecole.conduites')
            ->with('page_name', $this->page)
            ->with("items", $consuites);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        if (AnneeScolaire::current()->isActive()) {
            $item = Conduite::findOrFail($id);
            $item->delete();
            Logfile::deleteLog(
                'conduites',
                $item->id
            );
            return redirect()->route('conduites.index');
        }
        return redirect()->back()->withErrors([
            "Vous ne pouvez pas effectuer des operations sur les Archives",
        ])->onlyInput('nom');
    }
}
