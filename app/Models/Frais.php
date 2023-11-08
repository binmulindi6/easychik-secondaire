<?php

namespace App\Models;

use App\Models\Section;
use App\Models\TypeFrais;
use App\Models\ModePaiement;
use App\Models\PaiementFrais;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Frais extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'montant'
    ];

    public function type_frais()
    {
        return $this->belongsTo(TypeFrais::class);
    }

    public function paiement_frais()
    {
        return $this->hasMany(PaiementFrais::class);
    }

    public function mode_paiement()
    {
        return $this->belongsTo(ModePaiement::class);
    }

    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }
    
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    
}
