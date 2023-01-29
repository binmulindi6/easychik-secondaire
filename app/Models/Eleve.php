<?php

namespace App\Models;

use App\Models\Examen;
use App\Models\Evaluation;
use App\Models\Frequentation;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Eleve extends Model
{
     use HasFactory, SoftDeletes;
     protected $fillable = [
          'matricule',
          'nom',
          'prenom',
          'lieu_naissance',
          'date_naissance',
          'nom_pere',
          'nom_mere',
          'adresse',
          'sexe',

     ];

     //classe() is already taken by the system, that why i use class

     public function classe($instance = true)
     {
          if (!$this->frequentations->isEmpty()) {
               $frequetation = $this->frequentations[count($this->frequentations) - 1];
               $annee_id = $frequetation->annee_scolaire_id;
               $annee = AnneeScolaire::withTrashed()->find($annee_id);

               //dd($annee->nom, AnneeScolaire::current()->nom, $annee->isCurrent());
               //dd($annee->isCurrent());
               if ($annee->isCurrent()) {

                    $classe_id = $frequetation->classe_id;
                    $classe = Classe::find($classe_id);
                    if ($instance) {
                         return $classe;
                    }
                    return $classe->niveau . " " . $classe->nom;;
               }
          }
          return null;
     }

     //bulletinPeriode() to get points from periode
     public function bulletinPeriode($periode)
     {
          $bulletin = Evaluation::where('evaluations.periode_id', '=', $periode)
               ->join('eleve_evaluation', 'evaluation_id', '=', "evaluations.id")
               ->where('eleve_evaluation.eleve_id', '=', $this->id)
               ->join('cours', 'cours.id', '=', 'evaluations.cours_id')
               ->select('cours.nom as nom', DB::raw('SUM(eleve_evaluation.note_obtenu) as note'), DB::raw('SUM(evaluations.note_max) as max'), 'cours.max_periode as total')
               ->groupBy('cours_id')
               ->get();

          $bulletin->isEmpty() ? $bulletin = null : "";

          return $bulletin;
     }


     //bulletinPeriode() to get points from periode
     public function bulletinExamen($trimestre)
     {
          $bulletin = Examen::where('examens.trimestre_id', '=', $trimestre)
               ->join('eleve_examen', 'examen_id', '=', "examens.id")
               ->where('eleve_examen.eleve_id', '=', $this->id)
               ->join('cours', 'cours.id', '=', 'examens.cours_id')
               ->select('cours.nom as nom', DB::raw('SUM(eleve_examen.note_obtenu) as note'), DB::raw('SUM(examens.note_max) as max'), 'cours.max_examen as total')
               ->groupBy('cours_id')
               ->get();

          $bulletin->isEmpty() ? $bulletin = null : "";

          return $bulletin;
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
          return $this->belongsToMany(Examen::class)->withPivot('note_obtenu');
     }
}