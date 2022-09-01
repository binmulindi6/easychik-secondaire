<?php

namespace App\Models;

use App\Models\Examen;
use App\Models\Evaluation;
use App\Models\Frequentation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

use function PHPUnit\Framework\isEmpty;

class Eleve extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
     'matricule',
     'nom',
     'prenom',
     'lieu_naissance',
     'date_naissance',
     'nom_pere',
     'nom_mere',
     'adresse',

    ];

    //classe() is already taken by the system, that why i use class

    public function classe( $instance = true ){
          if(!$this->frequentations->isEmpty()){
               $frequetation = $this->frequentations[count($this->frequentations)-1];
               $annee_id = $frequetation->annee_scolaire_id;
               $annee = AnneeScolaire::find($annee_id);
               
               //dd($annee->nom, AnneeScolaire::current()->nom, $annee->isCurrent());
               //dd($annee->isCurrent());
               if($annee->isCurrent()){
                    $classe_id = $frequetation->classe_id;
                    $classe = Classe::find($classe_id);
                   if($instance){
                    return $classe;
                   }
                   return $classe->niveau . " " . $classe->nom;;
               }
          }      
          return "NaN";
     }

    public function frequentations()
    {
         return $this->hasMany(Frequentation::class);
    }

    //link to Evaluation
    public function evaluations()
    {
         return $this->belongsToMany(Evaluation::class)->withPivot('note_obtenu');
    }

    //link to Evaluation
    public function examens()
    {
         return $this->hasMany(Examen::class);
    }
}
