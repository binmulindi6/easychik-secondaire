<?php

namespace App\Models;

use App\Models\Examen;
use App\Models\Parrain;
use App\Models\Conduite;
use App\Models\Evaluation;
use App\Models\EleveConduite;
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
          'num_permanent',
          'matricule',
          'nom',
          'prenom',
          'lieu_naissance',
          'date_naissance',
          'nom_pere',
          'nom_mere',
          'adresse',
          'sexe',
          'nationalite',

     ];

     public function nomComplet()
     {
          return $this->nom . " " . $this->prenom;
     }

     //class() is already taken by the system, that why i use classe

     public function classe($instance = true)
     {
          if (!$this->frequentations->isEmpty()) {
               $frequentations = $this->frequentations;
               foreach ($frequentations as $frequentation) {
                    if ($frequentation->annee_scolaire !== null) {
                         if ($frequentation->annee_scolaire->isCurrent()) {
                              $classe_id = $frequentation->classe_id;
                              $classe = Classe::find($classe_id);
                              if ($classe !== null) {
                                   if ($instance) {
                                        return $classe;
                                   }
                                   return $classe->niveau->numerotation . "e " . $classe->nom;;
                              }
                         }
                    }
               }
          }
          return null;
     }

     public function currentFrequentation()
     {
          if (!$this->frequentations->isEmpty()) {
               $frequentations = $this->frequentations;
               // $annee_id = $frequetation->annee_scolaire_id;
               // $annee = AnneeScolaire::withTrashed()->find($annee_id);

               //dd($annee->nom, AnneeScolaire::current()->nom, $annee->isCurrent());
               // dd($frequentations[1]->annee_scolaire->isCurrent());
               foreach ($frequentations as $frequentation) {
                    if ($frequentation->annee_scolaire !== null) {
                         if ($frequentation->annee_scolaire->isCurrent()) {
                              return $frequentation;
                         }
                    }
               }
          }
          return null;
     }

     public function nextFrequentation()
     {
          if (!$this->frequentations->isEmpty()) {
               $frequentations = $this->frequentations;
               // $annee_id = $frequetation->annee_scolaire_id;
               // $annee = AnneeScolaire::withTrashed()->find($annee_id);
               $next = AnneeScolaire::next();
               //dd($annee->nom, AnneeScolaire::current()->nom, $annee->isCurrent());
               // dd($frequentations[1]->annee_scolaire->isCurrent());
               foreach ($frequentations as $frequentation) {
                    if ($frequentation->annee_scolaire !== null) {
                         if ($frequentation->annee_scolaire->id === $next->id) {
                              return $frequentation;
                         }
                    }
               }
          }
          return null;
     }

     public function resultat()
     {
          return $this->currentFrequentation()->resultat;
     }

     //bulletinPeriode() to get points from periode
     public function bulletinPeriode($periode)
     {
          $niveau = $this->classe()->niveau;

          $bulletin = Evaluation::where('evaluations.periode_id', '=', $periode)
               ->join('eleve_evaluation', 'evaluation_id', '=', "evaluations.id")
               ->where('eleve_evaluation.eleve_id', '=', $this->id)
               ->join('cours', 'cours.id', '=', 'evaluations.cours_id')
               ->where('cours.niveau_id', $niveau->id)
               ->select('cours.nom as nom', DB::raw('SUM(eleve_evaluation.note_obtenu) as note'), DB::raw('SUM(evaluations.note_max) as max'), 'cours.max_periode as total')
               ->groupBy('cours.id', 'cours.nom', 'cours.max_periode')
               ->get();

          $bulletin->isEmpty() ? $bulletin = null : "";
          // dd($bulletin);
          return $bulletin;
     }


     //bulletinPeriode() to get points from periode
     public function bulletinExamen($trimestre)
     {

          $niveau = $this->classe()->niveau;

          $bulletin = Examen::where('examens.trimestre_id', '=', $trimestre)
               ->join('eleve_examen', 'examen_id', '=', "examens.id")
               ->where('eleve_examen.eleve_id', '=', $this->id)
               ->join('cours', 'cours.id', '=', 'examens.cours_id')
               ->where('cours.niveau_id', $niveau->id)
               ->select('cours.nom as nom', DB::raw('SUM(eleve_examen.note_obtenu) as note'), DB::raw('SUM(examens.note_max) as max'), 'cours.max_examen as total')
               ->groupBy('cours.id', 'cours.nom', 'cours.max_examen')
               ->get();

          $bulletin->isEmpty() ? $bulletin = null : "";

          return $bulletin;
     }

     public  function isActive()
     {
          if ($this->isActive === 1) {
               return true;
          } else {
               return false;
          }
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

     public function conduites()
     {
          return $this->hasMany(EleveConduite::class);
     }

     public function parrains()
     {
          return $this->belongsToMany(Parrain::class);
     }

     public static function getLastMatricule()
     {

          $lastmatricule = Eleve::all()->last()->matricule;
          if (count(Eleve::all()) > 0 && (count(explode('/', $lastmatricule, -1)) > 0)) {
               $initial = explode('/', $lastmatricule, -1)[0];
               $middle = str_replace('E', '', $initial);
               $matricule = (intval($middle) + 1) < 10 ?  'E0' . intval($middle) + 1 . '/' . date('Y') : 'E' . intval($middle) + 1 . '/' . date('Y');
          } else {
               if (count(Eleve::all()) > 0) {
                    $matricule = 'E'. count(Eleve::withTrashed()->get('*')) + 1 .'/' . date('Y');
               } else {
                    $matricule = 'E01/' . date('Y');
               }
               
          }

          return $matricule;
     }

     public static function checkEleves(): bool
     {
          if (Eleve::count() > 0) {
               return true;
          }
          return false;
     }

     public function presence($date = null)
     {
          $today =  $date ? $date : date('Y-m-d');
          $presence = Presence::join('frequentations', 'frequentations.id', 'frequentation_id')
               ->where('frequentations.eleve_id', $this->id)
               ->where('presences.date', $today)
               ->select('presences.*')
               ->first();
          return $presence;
     }
}
