<?php

namespace App\Models;

use App\Models\Employer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fonction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['nom'];
    //Employers
    public function employers()
    {
        return $this->belongsToMany(Employer::class);
    }
}
