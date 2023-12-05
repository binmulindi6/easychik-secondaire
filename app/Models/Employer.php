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
        'niveau_etude',
        'telephone1',
        'telephone2'
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

    public  function isActive()
    {
        if ((int)$this->isActive === 1) {
            return true;
        } else {
            return false;
        }
    }

    public function fonction()
    {
        $text = '';
        foreach ($this->fonctions as $fonction) {
            $text .= " " . $fonction->nom;
        }
        if ($this->user && $this->user->classe()) {
            $text .= " " . $this->user->classe->nomCourt();
        }

        return $text;
    }

    //link to the user account
    public function user()
    {
        return $this->hasOne(User::class);
    }

    //link to the presences 
    public function employer_presences()
    {
        return $this->hasMany(EmployerPresence::class);
    }
    // public function employer_presences()
    // {
    //     return $this->hasMany(EmployerPresence::class);
    // }

    public function presence($date = null)
    {
        $today =  $date ? $date : date('Y-m-d');
        return EmployerPresence::where('employer_id', $this->id)
            ->where('date', $today)
            ->first();
        // return null;
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

    public static function getLastMatricule()
    {

        $lastmatricule = Employer::withTrashed()->get('*')->last()->matricule;
        if (count(Employer::all()) > 0 && (count(explode('/', $lastmatricule, -1)) > 0)) {
            $initial = explode('/', $lastmatricule, -1)[0];
            $middle = str_replace('P', '', $initial);
            $matricule = (intval($middle) + 1) < 10 ?  'P0' . intval($middle) + 1 . '/' . date('Y') : 'P' . intval($middle) + 1 . '/' . date('Y');
        } else {
            if (count(Eleve::all()) > 0) {
                $matricule = 'P' . count(Employer::withTrashed()->get('*')) + 1 . '/' . date('Y');
            } else {
                $matricule = 'P01/' . date('Y');
            }
        }

        return $matricule;
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
