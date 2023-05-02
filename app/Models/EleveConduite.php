<?php

namespace App\Models;

use App\Models\Eleve;
use App\Models\Periode;
use App\Models\Conduite;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EleveConduite extends Model
{
    use HasFactory,SoftDeletes;



    public function eleve(){
        return $this->belongsTo(Eleve::class);
    }

    public function conduite(){
        return $this->belongsTo(Conduite::class);
    }

    public function periode(){
        return $this->belongsTo(Periode::class);
    }
}
