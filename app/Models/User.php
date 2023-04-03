<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use App\Models\Classe;
use App\Models\Employer;
use App\Models\Encadrement;
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
        if ($this->isAdmin === 1) {
            return true;
        }
        return false;
    }

    public function isEnseignant(){
        if ($this->employer->fonction->nom === 'Enseignant') {
            return true;
        }
        return false;
    }

    //link to the employer
    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    //link to the class
    public function encadrements()
    {
        return $this->hasMany(Encadrement::class);
    }

    public function classe(){
        $encadrements = $this->encadrements;
        $currentAnneeScolaire = AnneeScolaire::current();
        $currentEncadrement = null;
        // dd($currentAnneeScolaire->id);
                foreach($encadrements as $encadrement){
                    if($encadrement->annee_scolaire->id === $currentAnneeScolaire->id){
                        $currentEncadrement = $encadrement;
                        return $currentEncadrement->classe();
                    }
                }

        return $currentEncadrement;
    }
}