<?php

namespace App\Models;

use App\Models\Presence;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypePresence extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'nom',
        'abbreviation'
    ];

    public function presences() {
        return $this->hasMany(Presence::class);
    }
}
