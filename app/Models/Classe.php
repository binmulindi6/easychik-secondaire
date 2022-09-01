<?php

namespace App\Models;

use App\Models\User;
use App\Models\Cours;
use App\Models\Frequentation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classe extends Model
{
    use HasFactory, SoftDeletes;


    //link to the user
    function user(){
        return $this->belongsTo(User::class);
    }

    public function cours()
    {
        return $this->hasMany(Cours::class);
    }

    public function frequentations()
    {
         return $this->hasMany(Frequentation::class);
    }

}
