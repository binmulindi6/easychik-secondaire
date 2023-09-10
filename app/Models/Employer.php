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
    public function nomComplet()
    {
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

    public function isEnseignant()
    {
        foreach ($this->fonctions as $fonction) {
            if (strtolower($fonction->nom) === strtolower('Enseignant')) {
                return true;
                // dd(10);
            }
        }

        return false;
    }

    public function classe()
    {
        $encadrements = $this->user ? $this->user->encadrements : null;
        // dd($encadrements);
        $currentAnneeScolaire = AnneeScolaire::current();
        $currentEncadrement = null;
        // dd($currentAnneeScolaire->id);
        if ($this->isEnseignant() && $encadrements) {
            // dd(10);
            foreach ($encadrements as $encadrement) {
                if ($encadrement->annee_scolaire->id === $currentAnneeScolaire->id) {
                    $currentEncadrement = $encadrement;
                    return $currentEncadrement->classe();
                }
            }
        }
        // dd(11);

        return $currentEncadrement;
    }
}
