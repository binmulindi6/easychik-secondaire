<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use App\Models\Classe;
use App\Models\Parrain;
use App\Models\Employer;
use App\Models\Encadrement;
use Illuminate\Support\Arr;
use App\Models\Enseignement;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'id_employer',
        'isAdmin',
        'isActive',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //check if user is admin
    public function isAdmin()
    {
        if ($this->parrain_id === null) {
            if ((int)$this->isAdmin === 1) {
                return true;
            }
        }
        return false;
    }
    public function isParent()
    {
        // $this->id;
        if ($this->parrain_id !== null) {
            return true;
        }
        return false;
    }

    public function isEnseignant()
    {
        if ($this->parrain_id === null) {
            foreach ($this->employer->fonctions as $fonction) {
                if (strtolower($fonction->nom) === strtolower('Enseignant')) {
                    return true;
                }
                // } else {
                //     if ($this->classes() !== null) {
                //         return true;
                //     }
                // }
            }
        }
        return false;
    }

    public function isDirecteur()
    {
        if ($this->parrain_id === null) {
            foreach ($this->employer->fonctions as $fonction) {
                if (strtolower($fonction->nom) === strtolower('Directeur') || strtolower($fonction->nom) === strtolower('Proviseur')) {
                    return true;
                    // dd(10);
                }
            }
        }
        return false;
        // return $this->isManager() ? true : false;
    }


    public function isSecretaire()
    {

        if ($this->parrain_id === null) {
            foreach ($this->employer->fonctions as $fonction) {
                if (strtolower($fonction->nom) === strtolower('Secretaire') || strtolower($fonction->nom) === strtolower('Comptable')) {
                    return true;
                    // dd(10);
                }
            }
        }
        return false;
    }
    public function isManager()
    {

        if ($this->parrain_id === null) {
            foreach ($this->employer->fonctions as $fonction) {
                if (strtolower($fonction->nom) === strtolower('Gestionnaire') || strtolower($fonction->nom) === strtolower('Manager')) {
                    return true;
                    // dd(10);
                }
            }
        }
        return false;
    }
    public function isLog()
    {

        if ($this->parrain_id === null) {
            foreach ($this->employer->fonctions as $fonction) {
                if (strtolower($fonction->nom) === strtolower('Logisticien') || strtolower($fonction->nom) === strtolower('Manager')) {
                    return true;
                    // dd(10);
                }
            }
        }
        return false;
    }

    //link to the employer
    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    //link to the parrain
    public function parrain()
    {
        return $this->belongsTo(Parrain::class);
    }

    //link to the class
    public function encadrements()
    {
        return $this->hasMany(Encadrement::class);
    }

    public function classe()
    {
        $encadrements = $this->encadrements;
        $currentAnneeScolaire = AnneeScolaire::current();
        $currentEncadrement = null;
        // dd($currentAnneeScolaire->id);  
        if ($this->isEnseignant()) {
            // dd(10);
            foreach ($encadrements as $encadrement) {
                if ($encadrement->annee_scolaire->id === $currentAnneeScolaire->id) {
                    if ((int)$encadrement->isActive === 1 && $encadrement->classe() !== null) {
                        $currentEncadrement = $encadrement;
                        return $currentEncadrement->classe();
                    }
                }
            }
        }
        // dd(11);
        // dd($encadrements);

        return $currentEncadrement;
    }

    public function enseignements()
    {
        return $this->hasMany(Enseignement::class);
    }

    public function cours($classe = null)
    {
        $encadrements = $this->enseignements;
        // dd($encadrements);
        $currentAnneeScolaire = AnneeScolaire::current();
        // $currentEncadrement = null;
        // // dd($currentAnneeScolaire->id);
        // if ($this->isEnseignant()) {
        //     $currentEncadrement = [];
        //     foreach ($encadrements as $encadrement) {
        //         if ($encadrement->annee_scolaire->id === $currentAnneeScolaire->id) {
        //             if ((int)$encadrement->isActive === 1) {
        //                 $currentEncadrement[] = $encadrement->cours;
        //                 // return $currentEncadrement->classe();
        //             }
        //         }
        //     }
        // }
        // dd(11);

        if ($classe !== null) {
            return Cours::join('enseignements', 'cours_id', 'cours.id')
                ->where('annee_scolaire_id', $currentAnneeScolaire->id)
                ->where('enseignements.user_id', $this->id)
                ->where('isActive', 1)
                ->where('cours.niveau_id', $classe->niveau->id)
                ->where('cours.section_id', $classe->section->id)
                ->select('cours.*')
                ->get();
        } else {
            return Cours::join('enseignements', 'cours_id', 'cours.id')
                ->where('annee_scolaire_id', $currentAnneeScolaire->id)
                ->where('isActive', 1)
                ->where('enseignements.user_id', $this->id)
                ->select('cours.*')
                ->get();
        }
    }
    public function isProf($cours)
    {
        $encadrements = $this->enseignements;
        foreach ($encadrements as $encadrement) {
            if ($encadrement->cours->id === $cours->id && (int)$encadrement->isActive === 1) {
                return true;
            }
        }
        return false;
    }

    public function classes()
    {
        $encadrements = $this->enseignements;
        // dd($encadrements);
        $currentAnneeScolaire = AnneeScolaire::current();
        $currentEncadrement = null;
        // dd($currentAnneeScolaire->id);
        if ($this->isEnseignant()) {
            $currentEncadrement = [];
            if (count($encadrements) > 0) {
                foreach ($encadrements as $encadrement) {
                    if ($encadrement->annee_scolaire->id === $currentAnneeScolaire->id) {
                        if ((int)$encadrement->isActive === 1) {
                            $classes = Classe::where('niveau_id', $encadrement->cours->niveau->id)
                                ->where('section_id', $encadrement->cours->section->id)->get();
                            if (count($classes) > 0) {
                                foreach ($classes as $classe) {
                                    $currentEncadrement[] = $classe;
                                }
                            }
                            // return $currentEncadrement;
                        }
                    }
                }
            } else {
                if ($this->classe() !== null) {
                    $currentEncadrement[] = $this->classe;
                }
            }
        }


        return $currentEncadrement;
    }

    public static function Parents()
    {
        return User::where('parrain_id', '!=', null)->get();
    }

    public static function Employers()
    {
        return User::where('parrain_id', null)->get();
    }

    public static function Directeurs()
    {
        $users = User::Employers();
        $dirs = array();
        foreach ($users as $user) {
            if ($user->isDirecteur() || $user->isManager()) {
                array_push($dirs, $user);
            }
        }

        return $dirs;
    }
}
