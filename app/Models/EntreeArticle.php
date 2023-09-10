<?php

namespace App\Models;

use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EntreeArticle extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'quantite',
        'prix',
        'designation',
        'date',
        'devise'
    ];



    public function article() {
        return $this->belongsTo(Article::class);
    }
}
