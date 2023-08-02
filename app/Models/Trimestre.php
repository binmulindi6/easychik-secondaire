<?php

namespace App\Models;

use App\Models\Examen;
use App\Models\Periode;
use App\Models\AnneeScolaire;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Date\DateController;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trimestre extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'nom',
        'date_debut',
        'date_fin',
        'annee_scolaire',

    ];

    //current

    public static function current(){
        return DateController::currentTrimestre();
    }

    public static function currents(){
        $curr = AnneeScolaire::current();

        return Trimestre::where('annee_scolaire_id', $curr->id)
                        ->get();
    }

    public  function isCurrent(){

        if($this == DateController::currentTrimestre()){
            return true;
        } 
        return false;
    }

    public function annee_scolaire()
    {
       return $this->belongsTo(AnneeScolaire::class);
    }
    //link to periode
    public function periodes()
    {
        return $this->hasMany(Periode::class);
    }

    public function periode1() {
        return Periode::where('trimestre_id', $this->id)
                    ->where('nom', '=' , 'premiere periode') 
                    ->first();
     }
    public function periode2() {
        return Periode::where('trimestre_id', $this->id)
                    ->where('nom', '=' , 'deuxieme periode') 
                    ->first();
     }
    public function periode3() {
        return Periode::where('trimestre_id', $this->id)
                    ->where('nom', '=' , 'troisieme periode') 
                    ->first();
     }
    public function periode4() {
        return Periode::where('trimestre_id', $this->id)
                    ->where('nom', '=' , 'quatrieme periode') 
                    ->first();
     }
    public function periode5() {
        return Periode::where('trimestre_id', $this->id)
                    ->where('nom', '=' , 'cinquieme periode') 
                    ->first();
     }
    public function periode6() {
        return Periode::where('trimestre_id', $this->id)
                    ->where('nom', '=' , 'sixieme periode') 
                    ->first();
     }

    //link to Examen
    public function examens()
    {
        return $this->hasMany(Examen::class);
    }

}
