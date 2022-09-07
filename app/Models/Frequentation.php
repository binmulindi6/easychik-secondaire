<?php

namespace App\Models;

use App\Models\Eleve;
use App\Models\Classe;
use App\Models\AnneeScolaire;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Frequentation extends Model
{
    use HasFactory,SoftDeletes;

    //links
    function annee_scolaire(){
        return $this->belongsTo(AnneeScolaire::class);
    }
    function classe(){
        return $this->belongsTo(Classe::class);
    }
    function eleve(){
        return $this->belongsTo(Eleve::class);
    }
}
