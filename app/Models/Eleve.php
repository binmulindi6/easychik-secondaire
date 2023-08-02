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

     public function nomComplet(){
          return $this->nom . " " . $this->prenom; 
     }

     //class() is already taken by the system, that why i use classe

     public function classe($instance = true)
     {
          if (!$this->frequentations->isEmpty()) {
               $frequentations = $this->frequentations;
               // $curentYear = AnneeScolaire::current();
               // foreach($frequetation as $freq){
               //      if ($freq->annee_scolaire->id === $curentYear->id) {
               //           # code...
               //      }
               // }

               // $annee_id = $frequetation->annee_scolaire_id;
               // $annee = AnneeScolaire::withTrashed()->find($annee_id);

               // //dd($annee->nom, AnneeScolaire::current()->nom, $annee->isCurrent());
               // //dd($annee->isCurrent());
               foreach($frequentations as $frequentation){
                    if($frequentation->annee_scolaire !== null){
                         if ($frequentation->annee_scolaire->isCurrent()) {
                              $classe_id = $frequentation->classe_id;
                              $classe = Classe::find($classe_id);
                              if ($instance) {
                                   return $classe;
                              }
                              return $classe->niveau->numerotation . "e " . $classe->nom;;
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
               foreach($frequentations as $frequentation){
                    if($frequentation->annee_scolaire !== null){
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
               foreach($frequentations as $frequentation){
                    if($frequentation->annee_scolaire !== null){
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
          $classe = $this->classe(); 

          $bulletin = Evaluation::where('evaluations.periode_id', '=', $periode)
               ->join('eleve_evaluation', 'evaluation_id', '=', "evaluations.id")
               ->where('eleve_evaluation.eleve_id', '=', $this->id)
               ->join('cours', 'cours.id', '=', 'evaluations.cours_id')
               ->where('cours.classe_id', $classe->id)
               ->select('cours.nom as nom', DB::raw('SUM(eleve_evaluation.note_obtenu) as note'), DB::raw('SUM(evaluations.note_max) as max'), 'cours.max_periode as total')
               ->groupBy('cours_id')
               ->get();

          $bulletin->isEmpty() ? $bulletin = null : "";
          // dd($bulletin);
          return $bulletin;
     }


     //bulletinPeriode() to get points from periode
     public function bulletinExamen($trimestre)
     {    

          $classe = $this->classe(); 

          $bulletin = Examen::where('examens.trimestre_id', '=', $trimestre)
               ->join('eleve_examen', 'examen_id', '=', "examens.id")
               ->where('eleve_examen.eleve_id', '=', $this->id)
               ->join('cours', 'cours.id', '=', 'examens.cours_id')
               ->where('cours.classe_id', $classe->id)
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

     public function conduites(){
          return $this->hasMany(EleveConduite::class);
     }

     public function parrain(){
          return $this->belongsTo(Parrain::class);
     }

     public static function getLastMatricule(){
          
          // dd(count(Eleve::all()));
          if(count(Eleve::all()) > 1){
               $lastmatricule = Eleve::all()->last()->matricule;
               $initial = explode('/', $lastmatricule, -1)[0];
               $middle = str_replace('E', '', $initial);
               $matricule = 'E' . intval($middle) + 1 . '/' . date('Y');
          }else{
               $matricule = 'E1/' . date('Y');
          }

          return $matricule;
     }
}