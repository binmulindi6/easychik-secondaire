<?php

namespace App\Models;

use App\Models\Frais;
use App\Models\Frequentation;
use App\Models\MoyenPaiement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaiementFrais extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'montant_paye',
        'reference',
        'date'
    ];

    public function moyen_paiement()
    {
        return $this->belongsTo(MoyenPaiement::class);
    }
    public function frequentation()
    {
        return $this->belongsTo(Frequentation::class);
    }
    public function frais()
    {
        return $this->belongsTo(Frais::class);
    }

    public static function periode($debut, $fin){
        // dd($debut);
        return PaiementFrais::where('date','>=' , $debut)
                                ->where('date', '<=', $fin)
                                ->get();
    }
}
