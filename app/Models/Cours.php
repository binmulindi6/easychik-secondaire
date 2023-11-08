<?php

namespace App\Models;

use App\Models\Examen;
use App\Models\Niveau;
use App\Models\Section;
use App\Models\Evaluation;
use App\Models\Enseignement;
use App\Models\CategoryCours;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cours extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'nom',
        'max_periode',
        'max_examen',
    ];

    //link to categorie
    public function categorie_cours()
    {
        return $this->belongsTo(CategorieCours::class);
    }

    //link to classe
    public function nomComplet()
    {
        return $this->nom . " : " . $this->niveau->nom . " " . $this->section->nom;
    }
    public function nomCourt()
    {
        return $this->nom . " : " . $this->niveau->numerotation . "e " . $this->section->abbreviation;
    }
    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function classes()
    {
        $classes = Classe::where('niveau_id', $this->niveau->id)->where('section_id', $this->section->id)->get();
        return $classes;
    }

    //link to evaluation
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
    
    //link to examen
    public function examens()
    {
        return $this->hasMany(Examen::class);
    }

    //link to examen
    public function horaires()
    {
        return $this->hasMany(Cours::class);
    }

    public function enseignements()
    {
        return $this->hasMany(Enseignement::class);
    }
    public function enseignant()
    {
        $encadrements = $this->enseignements;
        $currentAnneeScolaire = AnneeScolaire::current();
        $currentEncadrement = null;
        foreach ($encadrements as $encadrement) {
            if ($encadrement->annee_scolaire->id === $currentAnneeScolaire->id) {
                if ((int)$encadrement->isActive === 1) {
                    $currentEncadrement = $encadrement;
                    return $currentEncadrement->user;
                }
            }
        }

        return $currentEncadrement;
    }
    public function currentEnseignement()
    {
        $encadrements = $this->enseignements;
        $currentAnneeScolaire = AnneeScolaire::current();
        $currentEncadrement = null;
        foreach ($encadrements as $encadrement) {
            if ($encadrement->annee_scolaire->id === $currentAnneeScolaire->id) {
                if ((int)$encadrement->isActive === 1) {
                    $currentEncadrement = $encadrement;
                    return $currentEncadrement;
                }
            }
        }

        return $currentEncadrement;
    }
}
