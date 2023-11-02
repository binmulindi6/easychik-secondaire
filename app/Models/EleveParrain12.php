<?php

namespace App\Models;

use App\Models\Eleve;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EleveConduite extends Model
{
    use HasFactory,SoftDeletes;



    public function eleve(){
        return $this->belongsTo(Eleve::class);
    }

    public function parrain(){
        return $this->belongsTo(Parrain::class);
    }

    

}
