<?php

namespace App\Models;

use App\Models\User;
use App\Models\Cours;
use App\Models\AnneeScolaire;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enseignement extends Model
{
    use HasFactory,SoftDeletes;

    // protected $fillable = [
    //     ''
    // ]

    public function annee_scolaire(){
        return $this->belongsTo(AnneeScolaire::class);
    }
    
    public function cours(){
        return $this->belongsTo(Cours::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
