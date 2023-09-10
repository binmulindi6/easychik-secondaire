<?php

namespace App\Models;

use App\Models\Frequentation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Presence extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'date'
    ];


    public function frequentation() {
        return $this->belongsTo(Frequentation::class);
    }

    public function type_presence() {
        return $this->belongsTo(TypePresence::class);
    }
}
