<?php

namespace App\Models;

use App\Models\Jour;
use App\Models\Cours;
use App\Models\Heure;
use App\Models\Classe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Horaire extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nom',
        'numerotation'
    ];


    public function cours()
    {
        return $this->belongsTo(Cours::class);
    }
    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
    public function heure()
    {
        return $this->belongsTo(Heure::class);
    }
    public function jour()
    {
        return $this->belongsTo(Jour::class);
    }
}
