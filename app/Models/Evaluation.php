<?php

namespace App\Models;

use App\Models\Cours;
use App\Models\Eleve;
use App\Models\Periode;
use App\Models\TypeEvaluation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evaluation extends Model
{
    use HasFactory, SoftDeletes;

    public function type_evaluation()
    {
       return $this->belongsTo(TypeEvaluation::class);
    }
    //link to cours
    public function cours()
    {
       return $this->belongsTo(Cours::class);
    }
    //link to
    public function periode()
    {
       return $this->belongsTo(Periode::class);
    }
    //link to Eleve
    public function eleves()
    {
        return $this->belongsToMany(Eleve::class);
    }
}
