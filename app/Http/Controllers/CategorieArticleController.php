<?php

namespace App\Http\Controllers;

use App\Models\CategorieArticle;
use App\Models\Logfile;
use Illuminate\Http\Request;

class CategorieArticleController extends Controller
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
        dd(10);
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
            'nom' => ['required', 'string', 'max:255']
        ]);

        Logfile::createLog(
            'categorie_articles',
            CategorieArticle::create([
                'nom' => $request->nom
            ])->id
        );

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategorieArticle  $categorieArticle
     * @return \Illuminate\Http\Response
     */
    public function show(CategorieArticle $categorieArticle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategorieArticle  $categorieArticle
     * @return \Illuminate\Http\Response
     */
    public function edit(CategorieArticle $categorieArticle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategorieArticle  $categorieArticle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategorieArticle $categorieArticle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategorieArticle  $categorieArticle
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategorieArticle $categorieArticle)
    {
        //
    }
}
