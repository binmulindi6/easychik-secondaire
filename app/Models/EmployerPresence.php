<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployerPresence extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'date'
    ];


    public function annee_scolaire() {
        return $this->belongsTo(Frequentation::class);
    }
    public function employer() {
        return $this->belongsTo(Employer::class);
    }

    public function type_presence() {
        return $this->belongsTo(TypePresence::class);
    }
}
