<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\UniteArticle;
use Illuminate\Http\Request;
use App\Models\CategorieArticle;
use App\Models\EntreeArticle;
use App\Models\Logfile;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    protected $page_name = 'Articles';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Article::latest()->get();
        $categories = CategorieArticle::latest()
            ->limit(10)
            ->get();
        $units = UniteArticle::all();

        // dd($items[0]->categorie_article);
        return view('store.items')
            ->with('page_name', $this->page_name)
            ->with('items', $items)
            ->with('units', $units)
            ->with('categories', $categories);
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

    public function link()
    {
        $items = Article::latest()->get();

        // dd($items[0]->categorie_article);
        return view('store.items')
            ->with('page_name', $this->page_name . ' / Link')
            ->with('isLink', true)
            ->with('items', $items);
    }

    public function linkSortie()
    {
        $items = Article::latest()->get();

        // dd($items[0]->categorie_article);
        return view('store.items')
            ->with('page_name', $this->page_name . ' / Link')
            ->with('isLink', true)
            ->with('isSortie', true)
            ->with('items', $items);
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
            'num_serie' => ['required', 'string', 'max:255', 'unique:articles'],
            'nom' => ['required', 'string', 'max:255'],
            'categorie' => ['required', 'int', 'max:255'],
            'unite' => ['required', 'int', 'max:255'],
        ]);

        $unit = UniteArticle::find($request->unite);
        $category = CategorieArticle::find($request->categorie);

        $item = Article::create([
            'num_serie' => $request->num_serie,
            'nom' => $request->nom,
            // 'quantite' => $request->quantite,
            'update_by' => Auth::user()->id
        ]);

        $item->unite_article()->associate($unit);
        $item->categorie_article()->associate($category);
        $item->save();
        Logfile::createLog(
            'articles',
            $item->id
        );

        //first entry if quantity
        // if ((int) $request->quantite > 0) {
        //     // dd('firts');
        //     $entree = EntreeArticle::create([
        //         'quantite' => (int) $request->quantite,
        //         'designation' => 'Premiere Entrée',
        //         'prix' => '',
        //         'date' => date('Y-m-d')
        //     ]);
        //     $entree->article()->associate($item);
        //     $entree->save();
        //     Logfile::createLog(
        //         'entree_articles',
        //         $entree->id
        //     );
        // }


        return redirect()->route('entrees.link.article',$item->id);
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
        dd('show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $items = Article::all();
        $item = Article::findOrFail($id);
        $categories = CategorieArticle::latest()
            ->limit(10)
            ->get();
        $units = UniteArticle::all();

        return view('store.items')
            ->with('page_name', $this->page_name . ' / Edit')
            ->with('items', $items)
            ->with('self', $item)
            ->with('units', $units)
            ->with('categories', $categories);
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
            'num_serie' => ['required', 'string', 'max:255'],
            'nom' => ['required', 'string', 'max:255'],
            'categorie' => ['required', 'int', 'max:255'],
            'unite' => ['required', 'int', 'max:255'],
        ]);

        $unit = UniteArticle::find($request->unite);
        $category = CategorieArticle::find($request->categorie);

        $item = Article::findOrFail($id);
        $item->nom = $request->nom;

        $item->unite_article()->associate($unit);
        $item->categorie_article()->associate($category);
        $item->save();
        Logfile::updateLog(
            'articles',
            $item->id
        );

        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Article::find($id);
        Logfile::deleteLog(
            'articles',
            $item->id
        );
        $item->delete();
        return redirect()->route('articles.index');
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => ['required', 'string', 'max:255'],
        ]);

        $items = Article::where('name', 'like', '%' . $request->search . '%')->get();
        $categories = CategorieArticle::all();
        $units = UniteArticle::all();
        return view('store.items')
            ->with('page_name', $this->page_name . ' / Search')
            ->with('search', $request->search)
            ->with('items', $items)
            ->with('units', $units)
            ->with('categories', $categories);
    }
}
