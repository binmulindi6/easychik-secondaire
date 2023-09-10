<?php

namespace App\Models;

use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategorieArticle extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'nom'
    ];

    public function articles() {
        return $this->hasMany(Article::class);
    }
}
