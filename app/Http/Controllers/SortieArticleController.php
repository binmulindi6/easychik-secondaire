<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Logfile;
use Illuminate\Http\Request;
use App\Models\SortieArticle;

class SortieArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $page_name = 'Sorties';
    public function index()
    {
        $items = SortieArticle::latest()->get();
        $articles = Article::all();

        // dd($items[0]->categorie_article);
        return view('store.sorties')
            ->with('page_name', $this->page_name)
            ->with('items', $items)
            ->with('articles', $articles);
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

    public function link($id)
    {
        $items = SortieArticle::latest()->get();
        $article = Article::findOrFail($id);

        // dd($items[0]->categorie_article);
        return view('store.sorties')
            ->with('page_name', $this->page_name . ' / Link')
            ->with('items', $items)
            ->with('article', $article);
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
            'quantite' => ['required', 'string', 'max:255'],
            'designation' => ['required', 'string', 'max:255'],
            'date' => ['required', 'string', 'max:255'],
        ]);

        $article = Article::findOrFail($request->article);
        // dd($article);
        // first entry if quantity
            $sortie = SortieArticle::create([
                'quantite' => (float) $request->quantite,
                'designation' => $request->designation,
                'date' => $request->date,
            ]);
            $sortie->article()->associate($article);
            $sortie->save();
            Logfile::createLog(
                'sortie_articles',
                $sortie->id
            );

        return redirect()->route('sorties.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SortieArticle  $sortieArticle
     * @return \Illuminate\Http\Response
     */
    public function show(SortieArticle $sortieArticle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SortieArticle  $sortieArticle
     * @return \Illuminate\Http\Response
     */
    public function edit(SortieArticle $sortieArticle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SortieArticle  $sortieArticle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SortieArticle $sortieArticle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SortieArticle  $sortieArticle
     * @return \Illuminate\Http\Response
     */
    public function destroy(SortieArticle $sortieArticle)
    {
        //
    }
}
