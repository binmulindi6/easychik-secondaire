<?php

namespace App\Models;

use App\Models\PaiementFrais;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MoyenPaiement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nom'
    ];

    public function paiements()
    {
        return $this->hasMany(PaiementFrais::class);
    }
}
