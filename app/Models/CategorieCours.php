<?php

namespace App\Models;

use App\Models\Cours;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryCours extends Model
{
    use HasFactory, SoftDeletes;

    //link to cours
    public function cours()
    {
        return $this->hasMany(Cours::class);
    }
}
