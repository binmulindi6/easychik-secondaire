<?php

namespace App\Models;

use App\Models\Frais;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeFrais extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'nom',
        'devise',
    ];

    public function frais()
    {
       return $this->hasMany(Frais::class);
    }
}
