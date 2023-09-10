<?php

namespace App\Models;

use App\Models\Horaire;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jour extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nom',
        'numerotation'
    ];

    public function horaires()
    {
        return $this->hasMany(Horaire::class);
    }
}
