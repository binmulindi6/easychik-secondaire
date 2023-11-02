<?php

namespace App\Models;

// use App\Models\Eleve;
use App\Models\Eleve;
use App\Models\EleveParrain;
use Illuminate\Foundation\Auth\User as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Parrain extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nom',
        'prenom', 
        // 'email', 
        // 'password', 
        'telephone', 

    ];

    protected $guarded = ['id'];

    public function nomComplet(){
        return $this->nom . " " . $this->prenom;
    }

    public function email(){
        return $this->user->email;
    }

    //eleves
    public function eleves(){
        return $this->belongsToMany(Eleve::class);
    }

    public function user(){
        return $this->hasOne(User::class);
    }

    public function is_active(){
        return $this->user->isActive;
    }
}
