<?php

namespace App\Models;

use App\Models\Cours;
use App\Models\Frais;
use App\Models\Classe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'nom',
        'abbreviation'
    ];

    public function classes(){
        return $this->hasMany(Classe::class);
    }

    public function cours()
    {   
        return $this->hasMany(Cours::class);
    }
    public function frais()
    {   
        return $this->hasMany(Frais::class);
    }
}
