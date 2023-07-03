<?php

namespace App\Http\Controllers;

use App\Models\Logfile;
use Illuminate\Http\Request;
use App\Models\TypeEvaluation;

class TypeEvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type_valuations = TypeEvaluation::all();
        return view('classe.type-evaluations')->with('items', $type_valuations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        ]);

        Logfile::createLog(
            'type_evaluations',
            TypeEvaluation::create([
                'nom' => $request->nom,
            ])->id
        );

        return redirect()->route('type-evaluations.index');
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
        dd("show");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type_valuations = TypeEvaluation::all();
        $type = TypeEvaluation::find($id);
        return view('classe.type-evaluations')
            ->with('self', $type)
            ->with('items', $type_valuations);
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
            'nom' => ['required', 'string', 'max:255'],
        ]);

        $type = TypeEvaluation::find($id);
        $type->nom = $request->nom;
        $type->save();

        Logfile::updateLog(
            'type_evaluations',
            $type->id
        );
        return redirect()->route('type-evaluations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = TypeEvaluation::find($id);
        $type->delete();

        Logfile::deleteLog(
            'type_evaluations',
            $type->id
        );
        return redirect()->route('type-evaluations.index');
    }
}
