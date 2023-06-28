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
        if(session()->get('currentYear') !== null){
            return session()->get('currentYear');
        }else{
            return DateController::currentAnnee();
        }
    }

    public static function next(){

        $annee = AnneeScolaire::current();
        if ($annee !== null && isset($annee->nom)) {
            // dd($annee);
            $date = explode('-', $annee->nom)[1];
            $nextName = $date . "-" .(int)$date+1;

            $nextName = AnneeScolaire::where('nom', $nextName)->first();
            return $nextName;
        }
        return null;

    }

    public  function isCurrent(){

        if($this->id === AnneeScolaire::current()->id){
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

