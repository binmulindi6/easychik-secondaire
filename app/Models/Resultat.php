<?php

namespace App\Models;

use App\Models\Frequentation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resultat extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        ''
    ];

    // public function 

    public function frequentation(){
        return $this->belongsTo(Frequentation::class);
    }

    public function conduiteFinal() {
        
    }
}
