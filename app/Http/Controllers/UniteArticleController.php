<?php

namespace App\Http\Controllers;

use App\Models\Logfile;
use App\Models\UniteArticle;
use Illuminate\Http\Request;

class UniteArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        Logfile::createLog(
            'categorie_articles',
            UniteArticle::create([
                'nom' => $request->nom,
                'abbreviation' => $request->nom
            ])->id
        );

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UniteArticle  $uniteArticle
     * @return \Illuminate\Http\Response
     */
    public function show(UniteArticle $uniteArticle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UniteArticle  $uniteArticle
     * @return \Illuminate\Http\Response
     */
    public function edit(UniteArticle $uniteArticle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UniteArticle  $uniteArticle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UniteArticle $uniteArticle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UniteArticle  $uniteArticle
     * @return \Illuminate\Http\Response
     */
    public function destroy(UniteArticle $uniteArticle)
    {
        //
    }
}
