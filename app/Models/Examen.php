<?php

namespace App\Models;

use App\Models\Eleve;
use App\Models\Classe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Examen extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'note_max',
        'date_examen'
    ];


    //link to Eleve
    public function eleves()
    {
        return $this->belongsToMany(Eleve::class);
    }

    //link to cours
    public function cours()
    {
        return $this->belongsTo(Cours::class);
    }
    //link to
    public function trimestre()
    {
        return $this->belongsTo(Trimestre::class);
    }
    //link to classe
    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    //get current year examens
    public static function currents($classe_id = null)
    {
        return 
            $classe_id 
            ? 
                Examen::join('trimestres', 'trimestres.id', 'trimestre_id')
                    ->where('trimestres.annee_scolaire_id', AnneeScolaire::current()->id)
                    ->orderBy('trimestres.id', 'desc')
                    ->select('examens.*')
                    ->get() 
            : 
                Examen::join('trimestres', 'trimestres.id', 'trimestre_id')
                    ->where('trimestres.annee_scolaire_id', AnneeScolaire::current()->id)
                    ->where('classe_id', $classe_id)
                    ->orderBy('trimestres.id', 'desc')
                    ->select('examens.*')
                    ->get();
        }
}
