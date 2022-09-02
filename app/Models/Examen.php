<?php

namespace App\Models;

use App\Models\Eleve;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Examen extends Model
{
    use HasFactory,SoftDeletes;


    //link to Eleve
    public function eleves()
    {
        return $this->belongsToMany(Eleve::class);
    }
    
    //link to cours
    public function cours()
    {
       return $this->belongsTo(Cours::class);
    }
    //link to
    public function trimestre()
    {
       return $this->belongsTo(Trimestre::class);
    }

}
