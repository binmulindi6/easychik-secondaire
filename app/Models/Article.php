<?php

namespace App\Models;

use App\Models\UniteArticle;
use App\Models\EntreeArticle;
use App\Models\SortieArticle;
use App\Models\CategorieArticle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'num_serie',
        'nom',
    ];


    public function categorie_article() {
        // dd(10);
        return $this->belongsTo(CategorieArticle::class);
    }
    public function unite_article() {
        return $this->belongsTo(UniteArticle::class);
    }

    public function entrees_articles() {
        return $this->hasMany(EntreeArticle::class);
    }
    public function sortie_articles() {
        return $this->hasMany(SortieArticle::class);
    }

    public function stock() : int {
        
        $entrees = EntreeArticle::where('article_id', $this->id)->sum('quantite');
        $sortiees = SortieArticle::where('article_id', $this->id)->sum('quantite');
        // $sortiees = $this-
        return $entrees - $sortiees;
    }

    public function entreesPeriode($debut, $fin){
        return EntreeArticle::where('article_id', $this->id)
                            ->where('date','>=' , $debut)
                            ->where('date', '<=', $fin)
                            ->sum('quantite');
    }
    public function sortiesPeride($debut, $fin){
        return SortieArticle::where('article_id', $this->id)
                            ->where('date','>=' , $debut)
                            ->where('date', '<=', $fin)
                            ->sum('quantite');
    }
}
