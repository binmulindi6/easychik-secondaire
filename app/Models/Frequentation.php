<?php

namespace App\Models;

use App\Models\Eleve;
use App\Models\Classe;
use App\Models\Presence;
use App\Models\Resultat;
use App\Models\AnneeScolaire;
use App\Models\PaiementFrais;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Frequentation extends Model
{
    use HasFactory,SoftDeletes;

    public static function current(){
        $current = AnneeScolaire::current();

        return self::where('annee_scolaire_id', $current->id)
                        ->latest()
                        ->limit(20)
                        ->get();
    }
    public static function currents(){
        $current = AnneeScolaire::current();
        if($current === null){
            return [];
        }
        return self::where('annee_scolaire_id', $current->id)
                        ->get();
    }
    public static function previous(){
        $current = AnneeScolaire::previous();
        if($current === null){
            return [];
        }
        return self::where('annee_scolaire_id', $current->id)
                        ->get();
    }
    public static function next(){
        $current = AnneeScolaire::next();
            if($current === null){
                return [];
            }
        return self::where('annee_scolaire_id', $current->id)
                        ->get();
    }
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

    public function presences() {
        return $this->hasMany(Presence::class);
    }

    public static function getPource() {
        $curr = self::currents() ? count(self::currents()) : 0;
        $prev = self::previous() ? count(self::previous()) : 0; 

        $dif = $curr - $prev;
        // dd($dif * 100 / $prev);
        return $curr > 0 ? ($dif * 100) / $curr : ($dif * 100) / 1;
        dd($curr - $prev);
    }
}
