<?php

namespace App\Http\Controllers;

use App\Models\Niveau;
use App\Models\Logfile;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $page_name = "Sections";
    public function index()
    {
        $sections = Section::latest()->get();

        return view('enseignement.sections')
            ->with('items', $sections)
            ->with('page_name', $this->page_name);
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
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'abbreviation' => ['required', 'string', 'max:255']
        ]);

        // dd(10);

        Logfile::createLog(
            'sections',
            Section::create([
                'nom' => $request->nom,
                'abbreviation' => $request->abbreviation
            ])->id
        );

        return redirect()->route('sections.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        // dd($request->_method === "PUT");

        if ($request->_method === "PUT") {
            $request->validate([
                'nom' => ['required', 'string', 'max:255'],
                'abbreviation' => ['required', 'string', 'max:255']
            ]);
            
            return $this->update($request, $id);

        }
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sections = Section::latest()->get();
        $section = Section::findOrFail($id);

        return view('enseignement.sections')
            ->with('self', $section)
            ->with('items', $sections)
            ->with('page_name', $this->page_name . " / Edit");
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
        $section = Section::findOrFail($id);
        $section->nom = $request->nom;
        $section->abbreviation = $request->abbreviation;
        $section->save();
        Logfile::updateLog(
            'sections',
            $section->id
        );

        return redirect()->route('sections.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
