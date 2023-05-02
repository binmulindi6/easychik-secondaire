<?php

namespace App\Models;

use App\Models\Frais;
use App\Models\Classe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Niveau extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'nom',
        'numerotation'
    ];

    public function classes(){
        return $this->hasMany(Classe::class);
    }
    public function frais(){
        return $this->hasMany(Frais::class);
    }
}
