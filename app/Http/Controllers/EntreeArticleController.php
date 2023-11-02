<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Logfile;
use Illuminate\Http\Request;
use App\Models\AnneeScolaire;
use App\Models\EntreeArticle;

class EntreeArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     protected $page_name = 'Entrées';
    public function index()
    {
        $items = EntreeArticle::latest()->get();
        $articles = Article::all();

        // dd($items[0]->categorie_article);
        return view('store.entrees')
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
        $items = EntreeArticle::latest()->get();
        $article = Article::findOrFail($id);

        // dd($items[0]->categorie_article);
        return view('store.entrees')
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
            'prix' => ['required', 'string', 'max:255'],
            'devise' => ['required', 'string', 'max:255'],
            'date' => ['required', 'string', 'max:255'],
        ]);
        if (AnneeScolaire::current()->isActive()) {
        
        $article = Article::findOrFail($request->article);
        // dd($article);
        // first entry if quantity
            $entree = EntreeArticle::create([
                'quantite' => (float) $request->quantite,
                'designation' => $request->designation,
                'prix' => $request->prix,
                'devise' => $request->devise,
                'date' => $request->date,
            ]);
            $entree->article()->associate($article);
            $entree->save();
            Logfile::createLog(
                'entree_articles',
                $entree->id
            );

        return redirect()->route('entrees.index');
        }
        return redirect()->back()->withErrors([
            "Vous ne pouvez pas effectuer des operations sur les Archives",
        ])->onlyInput('nom');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EntreeArticle  $entreeArticle
     * @return \Illuminate\Http\Response
     */
    public function show(EntreeArticle $entreeArticle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EntreeArticle  $entreeArticle
     * @return \Illuminate\Http\Response
     */
    public function edit(EntreeArticle $entreeArticle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EntreeArticle  $entreeArticle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EntreeArticle $entreeArticle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EntreeArticle  $entreeArticle
     * @return \Illuminate\Http\Response
     */
    public function destroy(EntreeArticle $entreeArticle)
    {
        //
    }
}
