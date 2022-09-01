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

    //link to Examen
    public function examens()
    {
        return $this->hasMany(Examen::class);
    }

}
