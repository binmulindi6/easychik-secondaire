<?php

namespace App\Models;

use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SortieArticle extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'quantite',
        'designation',
        'date'
    ];

    public function article() {
        return $this->belongsTo(Article::class);
    }
}
