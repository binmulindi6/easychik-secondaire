<?php

namespace App\Models;

use App\Models\User;
use App\Models\Fonction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'matricule',
        'nom',
        'prenom',
        'date_naissance',
        'sexe',
        'formation',
        'diplome',
        'niveau_etude'
    ];

    //nomComplet
    public function nomComplet(){
        return $this->nom . " " . $this->prenom; 
   }
    //Fonctions
    public function fonctions()
    {
        return $this->belongsToMany(Fonction::class);
    }

    //link to the user account
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
