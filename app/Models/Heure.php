<?php

namespace App\Models;

use App\Models\Horaire;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Heure extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'debut',
        'fin',
        'numerotation'
    ];

    public function horaires()
    {
        return $this->hasMany(Horaire::class);
    }

    public function heures()
    {   $debut = date('H:i' , strtotime($this->debut));
           $fin = date('H:i' , strtotime($this->fin));
        return $debut . " - " . $fin;
    }
}
