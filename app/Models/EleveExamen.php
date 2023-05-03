<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EleveExamen extends Model
{
    use HasFactory, SoftDeletes;

    public static function find($eleve_id, $examen_id){
        $pivot = DB::table('eleve_examen')
                    ->where('eleve_id', '=', $eleve_id)
                    ->where('examen_id', '=', $examen_id)
                    ->first();
        return $pivot;
    }

    public static function getByExamen($examen_id)
    {
        $pivot = DB::table('eleve_examen')
            ->where('examen_id', '=', $examen_id)
            ->orderBy('eleves.nom')
            ->join('eleves', 'eleve_examen.eleve_id', 'eleves.id')
            ->select(['eleve_examen.id', 'eleve_examen.note_obtenu', 'eleve_examen.eleve_id', 'nom', 'prenom'])

            ->get();
        return $pivot;
    }

    public static function set($id, $note_obtenu){
        // dd($id);
        DB::table('eleve_examen')
            ->where('id', '=', $id)
            ->update([
                'note_obtenu' => $note_obtenu,
                'updated_at' => now(),
        ]);
        // dd(DB::table('eleve_examen')
        //     ->where('id', '=', $id)->get());
    }
}
