<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use App\Models\Classe;
use App\Models\Parrain;
use App\Models\Employer;
use App\Models\Encadrement;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Arr;

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
                    // dd(10);
                }
            }
        }
        return false;
    }

    public function isDirecteur()
    {
        if ($this->parrain_id === null) {
            foreach ($this->employer->fonctions as $fonction) {
                if (strtolower($fonction->nom) === strtolower('Directeur')) {
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
        // dd($encadrements);
        $currentAnneeScolaire = AnneeScolaire::current();
        $currentEncadrement = null;
        // dd($currentAnneeScolaire->id);
        if ($this->isEnseignant()) {
            // dd(10);
            foreach ($encadrements as $encadrement) {
                if ($encadrement->annee_scolaire->id === $currentAnneeScolaire->id) {
                    if ((int)$encadrement->isActive === 1) {
                        $currentEncadrement = $encadrement;
                        return $currentEncadrement->classe();
                    }
                }
            }
        }
        // dd(11);

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
            if ($user->isDirecteur()) {
                array_push($dirs, $user);
            }
        }

        return $dirs;
    }
}
