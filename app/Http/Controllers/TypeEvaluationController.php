<?php

namespace App\Http\Controllers;

use App\Models\TypeEvaluation;
use Illuminate\Http\Request;

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

        TypeEvaluation::create([
            'nom' => $request->nom,
        ]);

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
        if($request->_method == 'PUT'){
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
    }
}
