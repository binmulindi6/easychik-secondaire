<?php

namespace App\Models;

use App\Models\User;
use App\Models\Cours;
use App\Models\Niveau;
use App\Models\Encadrement;
use App\Models\Frequentation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classe extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'nom'
    ];


    //link to the user
    public function user(){
        $encadrements = $this->encadrements;
        $currentAnneeScolaire = AnneeScolaire::current();
        $currentEncadrement = null;
        // dd($currentAnneeScolaire->id);
                foreach($encadrements as $encadrement){
                    if($encadrement->annee_scolaire->id === $currentAnneeScolaire->id){
                        $currentEncadrement = $encadrement;
                        return $currentEncadrement->user();
                    }
                }

        return $currentEncadrement;
    }

    public function encadrements(){
        return $this->hasMany(Encadrement::class);
    }

    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }

    public function cours()
    {
        return $this->hasMany(Cours::class);
    }

    public function eleves(){
        $annee = AnneeScolaire::current();
        $eleves = Eleve::join('frequentations', 'frequentations.eleve_id', '=', 'eleves.id')
                            ->where('frequentations.annee_scolaire_id', '=', $annee->id)
                            ->where('frequentations.classe_id', '=', $this->id)
                            //->select('eleves.id')
                            ->get();
        //dd($eleves);
        return $eleves;
    }

    public function frequentations()
    {
         return $this->hasMany(Frequentation::class);
    }

}
