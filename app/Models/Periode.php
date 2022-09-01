<?php

namespace App\Models;

use App\Models\Trimestre;
use App\Models\Evaluation;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Date\DateController;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Periode extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'nom',
        'date_debut',
        'date_fin',
    ];

    //current
    public static function current(){
        return DateController::currentPeriode();
    }

    public  function isCurrent(){

        if($this == DateController::currentPeriode()){
            return true;
        } 
        return false;
    }

    public function trimestre()
    {
        return $this->belongsTo(Trimestre::class);
    }

    //link to Evaluation
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
}
