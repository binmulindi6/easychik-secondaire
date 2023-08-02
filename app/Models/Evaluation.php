<?php

namespace App\Models;

use App\Models\Cours;
use App\Models\Eleve;
use App\Models\Periode;
use App\Models\TypeEvaluation;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evaluation extends Model
{
   use HasFactory, SoftDeletes;
   protected $fillable = [
      'note_max',
      'date_evaluation'
   ];

   public function type_evaluation()
   {
      return $this->belongsTo(TypeEvaluation::class);
   }
   //link to cours
   public function cours()
   {
      return $this->belongsTo(Cours::class);
   }
   //link to
   public function periode()
   {
      return $this->belongsTo(Periode::class);
   }
   //link to Eleve
   public function eleves()
   {
      return $this->belongsToMany(Eleve::class);
   }

   public static function fiche($cours_id, $periode_id): array
   {
      $evs = Evaluation::where('evaluations.cours_id', $cours_id)
         ->where('evaluations.periode_id', $periode_id)
         ->orderBy('id')
         ->get();

      $eleveEVs = DB::table('eleve_evaluation', 'evaluations.id', 'evaluation_id')
         ->join('eleves', 'eleves.id', 'eleve_id')
         ->select('eleves.nom as nom', 'eleves.prenom as prenom','note_obtenu as note','evaluation_id')
         // ->groupBy('eleves.id')
         ->get();

      // $bulletin = Evaluation::where('evaluations.cours_id', $cours_id)
      //    ->where('evaluations.periode_id', $periode_id)
      //    ->join('eleve_evaluation', 'evaluations.id', 'evaluation_id')
      //    ->join('eleves', 'eleves.id', 'eleve_id')
      //    ->select('eleves.nom as nom', 'eleves.prenom as prenom')
      //    ->groupBy('eleves.id')
      //    ->get();
      dd($eleveEVs);

      return [];
   }
}
