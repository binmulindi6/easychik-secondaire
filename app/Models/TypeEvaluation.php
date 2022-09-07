<?php

namespace App\Models;

use App\Models\Evaluation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeEvaluation extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'nom',
    ];

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
}
