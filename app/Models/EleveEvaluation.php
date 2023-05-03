<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EleveEvaluation extends Model
{
    use HasFactory, SoftDeletes;

    public static function find($eleve_id, $evaluation_id)
    {
        $pivot = DB::table('eleve_evaluation')
            ->where('eleve_id', '=', $eleve_id)
            ->where('evaluation_id', '=', $evaluation_id)
            ->first();
        return $pivot;
    }

    public static function getByEvaluation($evaluation_id)
    {
        $pivot = DB::table('eleve_evaluation')
            ->where('evaluation_id', '=', $evaluation_id)
            ->join('eleves', 'eleve_evaluation.eleve_id', 'eleves.id')
            ->select(['eleve_evaluation.id', 'eleve_evaluation.note_obtenu', 'eleve_evaluation.eleve_id', 'nom', 'prenom'])
            ->orderBy('eleves.nom')
            ->get();
        return $pivot;
    }

    public function eleve()
    {
       return Eleve::findOrFail($this->eleve_id);
    }

    public static function set($id, $note_obtenu)
    {

        DB::table('eleve_evaluation')
            ->where('id', '=', $id)
            ->update([
                    'note_obtenu' => $note_obtenu,
                     'updated_at' => now(),
                ]);
    }
}