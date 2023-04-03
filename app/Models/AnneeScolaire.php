<?php

namespace App\Models;

use App\Models\Trimestre;
use App\Models\Encadrement;
use App\Models\Frequentation;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Date\DateController;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnneeScolaire extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'nom',
        'date_debut',
        'date_fin',

    ];

    public static function current(){
        return DateController::currentAnnee();
    }

    public  function isCurrent(){

        if($this == AnneeScolaire::current()){
            return true;
        } 
        return false;
    }

     //link to Frequentation
     public function frequentations()
     {
         return $this->hasMany(Frequentation::class);
     }

     public function trimestres()
     {
         return $this->hasMany(Trimestre::class);
     }

     public function encadrements(){
        return $this->hasMany(Encadrement::class);
     }
 }

