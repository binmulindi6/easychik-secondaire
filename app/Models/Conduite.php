<?php

namespace App\Models;

use App\Models\Eleve;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conduite extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'nom',
        'abbreviation',
    ];

    public function eleves(){
        return $this->hasMany(Eleve::class);
    }

    public function annee(){
        dd(20);
    }
}
