<?php

namespace App\Models;

use App\Models\Eleve;
use App\Models\Classe;
use App\Models\Resultat;
use App\Models\AnneeScolaire;
use App\Models\PaiementFrais;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Frequentation extends Model
{
    use HasFactory,SoftDeletes;

    //links
    function annee_scolaire(){
        return $this->belongsTo(AnneeScolaire::class);
    }
    function classe(){
        return $this->belongsTo(Classe::class);
    }
    function eleve(){
        return $this->belongsTo(Eleve::class);
    }

    function paiement_frais(){
        return $this->hasMany(PaiementFrais::class);
    }

    function resultat(){
        return $this->hasOne(Resultat::class);
    }

    public static function findByEleveAndAnneeScolaire($eleve, $annee_scolaire){
        return Frequentation::where('eleve_id', $eleve)
                                ->where('annee_scolaire_id', $annee_scolaire)
                                ->first();
    }


}
