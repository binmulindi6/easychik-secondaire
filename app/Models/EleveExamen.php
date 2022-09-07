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

    public static function set($id, $note_obtenu){
        
        DB::table('eleve_examen')
                ->where('id', '=', $id)
                ->update(['note_obtenu' => $note_obtenu]);
    }
}
