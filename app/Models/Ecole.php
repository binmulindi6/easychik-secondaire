<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ecole extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nom',
        'abbreviation',
        'bp',
        'pays',
        'province',
        'ville',
        'commune',
        'code',
        'ministere',
        'reussite'
    ];


 }
