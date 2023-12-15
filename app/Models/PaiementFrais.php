<?php

namespace App\Models;

use App\Models\User;
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
        'date',
        'deposer_par',
    ];

    public static function current()
    {
        $current = AnneeScolaire::current();
        return self::join('frequentations', 'frequentations.id', 'paiement_frais.frequentation_id')
                    ->where('frequentations.annee_scolaire_id', $current->id)
                    ->select("paiement_frais.*")
                    ->latest()
                    ->get();
        # code...
    }

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
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function periode($debut, $fin){
        // dd($debut);
        return PaiementFrais::where('date','>=' , $debut)
                                ->where('date', '<=', $fin)
                                ->get();
    }
}
