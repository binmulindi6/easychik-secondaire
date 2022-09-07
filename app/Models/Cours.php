<?php

namespace App\Models;

use App\Models\Examen;
use App\Models\Evaluation;
use App\Models\CategoryCours;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cours extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'nom',
        'max_periode',
        'max_examen',
    ];

    //link to categorie
    public function categorie_cours()
    {
        return $this->belongsTo(CategorieCours::class);
    }

    //link to classe
    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    //link to evaluation
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
    
    //link to examen
    public function examens()
    {
        return $this->hasMany(Examen::class);
    }
}
