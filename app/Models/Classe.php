<?php

namespace App\Models;

use App\Models\User;
use App\Models\Cours;
use App\Models\Frais;
use App\Models\Examen;
use App\Models\Niveau;
use App\Models\Horaire;
use App\Models\Section;
use App\Models\Evaluation;
use App\Models\Encadrement;
use App\Models\Frequentation;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classe extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'nom'
    ];


    public function nomCourt()
    {
        return $this->niveau->numerotation . 'e ' . $this->section->abbreviation . " " . $this->nom;
    }
    public function nomComplet()
    {
        return $this->niveau->nom . ' ' . $this->section->nom . " " . $this->nom;
    }

    //link to the user
    public function user()
    {
        return $this->currentEncadrement() ? $this->currentEncadrement()->user() : null;
    }

    public function currentEncadrement()
    {
        $encadrements = $this->encadrements;
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

    public function encadrements()
    {
        return $this->hasMany(Encadrement::class);
    }

    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function cours()
    {
        // dd(10);
        return Cours::where('niveau_id', $this->niveau->id)
            ->where('section_id', $this->section->id)
            ->get();
    }
    public function frais()
    {
        // dd(10);
        return Frais::where('niveau_id', $this->niveau->id)
            ->where('section_id', $this->section->id)
            ->get();
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
    public function horaires()
    {
        return $this->hasMany(Horaire::class);
    }
    // public function evaluations()
    // {   
    //     $cours = $this->cours;
    //     $evs = array();
    //     if(count($cours) > 0){
    //         foreach($cours as $cour){
    //             if (count($cour->evaluations) > 0) {
    //                 foreach($cour->evaluations as $evaluation){
    //                     array_push($evs, $evaluation);
    //                 }
    //             }
    //             // dd($cour->evaluations);
    //         }
    //     }
    //     return $evs;
    //     // dd($evs[0]->periode);

    //     // // $evaluations = 
    //     // return($cours[2]->evaluations[0]->periode);
    //     // // return $this->hasMany(Cours::class);
    // }

    public function currentEvaluations()
    {
        return Evaluation::currents($this->id);
    }
    // public function currentEvaluations()
    // {   
    //     $annee = AnneeScolaire::current();
    //     $cours = $this->cours;
    //     $evs = array();
    //     if(count($cours) > 0){
    //         foreach($cours as $cour){
    //             if (count($cour->evaluations) > 0) {
    //                 foreach($cour->evaluations as $evaluation){
    //                     if($evaluation->periode !== null && $evaluation->periode->trimestre->annee_scolaire->id === $annee->id){
    //                         array_push($evs, $evaluation);
    //                     }

    //                 }
    //             }
    //         }
    //     }

    //     return $evs;
    // }

    // public function examens()
    // {   
    //     $annee = AnneeScolaire::current();
    //     $cours = $this->cours;
    //     $evs = array();
    //     if(count($cours) > 0){
    //         foreach($cours as $cour){
    //             if (count($cour->examens) > 0) {
    //                 foreach($cour->examens as $examen){
    //                     array_push($evs, $examen);
    //                 }
    //             }
    //         }
    //     }

    //     return $evs;
    // }

    public function examens()
    {
        return $this->hasMany(Examen::class);
    }

    public function currentExamens()
    {
        return Examen::currents($this->id);
    }
    // public function currentExamens()
    // {   
    //     $annee = AnneeScolaire::current();
    //     $cours = $this->cours;
    //     $evs = array();
    //     if(count($cours) > 0){
    //         foreach($cours as $cour){
    //             if (count($cour->examens) > 0) {
    //                 foreach($cour->examens as $examen){
    //                     if($examen->trimestre !== null && $examen->trimestre->annee_scolaire->id === $annee->id){
    //                         array_push($evs, $examen);
    //                     }
    //                 }
    //             }
    //         }
    //     }

    //     return $evs;
    // }


    public function eleves()
    {
        $annee = AnneeScolaire::current();
        // $eleves = DB::table('eleves')
        //                     ->leftJoin('frequentations', 'frequentations.eleve_id', '=', 'eleves.id')
        //                     ->where('frequentations.annee_scolaire_id', '=', $annee->id)
        //                     ->where('frequentations.classe_id', '=', $this->id)
        //                     ->select('eleves.*')
        //                     ->get();
        $eleves = Eleve::leftJoin('frequentations', 'frequentations.eleve_id', '=', 'eleves.id')
            ->where('frequentations.annee_scolaire_id', '=', $annee->id)
            ->where('frequentations.classe_id', '=', $this->id)
            ->select('eleves.*')
            ->orderBy('eleves.nom', 'asc')
            ->get();
        // dd($eleves[0]);
        return $eleves;
    }
    public function elevesAnnee($annee)
    {
        // $eleves = DB::table('eleves')
        //                     ->leftJoin('frequentations', 'frequentations.eleve_id', '=', 'eleves.id')
        //                     ->where('frequentations.annee_scolaire_id', '=', $annee->id)
        //                     ->where('frequentations.classe_id', '=', $this->id)
        //                     ->select('eleves.*')
        //                     ->get();
        $eleves = Eleve::leftJoin('frequentations', 'frequentations.eleve_id', '=', 'eleves.id')
            ->where('frequentations.annee_scolaire_id', '=', $annee->id)
            ->where('frequentations.classe_id', '=', $this->id)
            ->select('eleves.*')
            ->orderBy('eleves.nom', 'asc')
            ->get();
        // dd($eleves[0]);
        return $eleves;
    }

    public function filles()
    {
        $annee = AnneeScolaire::current();
        $eleves = Eleve::leftJoin('frequentations', 'frequentations.eleve_id', '=', 'eleves.id')
            ->where('frequentations.annee_scolaire_id', '=', $annee->id)
            ->where('frequentations.classe_id', '=', $this->id)
            ->select('eleves.*')
            ->where('sexe', 'F')
            ->orderBy('eleves.nom', 'asc')
            ->get();
        return $eleves;
    }

    public function garcons()
    {
        $annee = AnneeScolaire::current();
        $eleves = Eleve::leftJoin('frequentations', 'frequentations.eleve_id', '=', 'eleves.id')
            ->where('frequentations.annee_scolaire_id', '=', $annee->id)
            ->where('frequentations.classe_id', '=', $this->id)
            ->select('eleves.*')
            ->where('sexe', 'M')
            ->orderBy('eleves.nom', 'asc')
            ->get();
        return $eleves;
    }

    public function frequentations()
    {
        return $this->hasMany(Frequentation::class);
    }
    public function currentrequentations()
    {
        $annee = AnneeScolaire::current();
        $frequentations = Frequentation::where('frequentations.annee_scolaire_id', '=', $annee->id)
            ->where('frequentations.classe_id', '=', $this->id)
            ->get();
        return $frequentations;
    }

    public function resultats()
    {
        $freqs = $this->currentrequentations();
        $resultats = array();

        foreach ($freqs as $freq) {
            array_push($resultats, $freq->resultat);
        }

        return $resultats;
    }

    public function reussites()
    {
        $resultats = $this->resultats();

        $reussites = [];
        foreach ($resultats as $resultat) {
            if ($resultat->decision === 'passe') {
                $reussites[] = $resultat;
            }
        }
    }

    public function resultatsTries()
    {
        $data = [];
        $data['classe'] = $this;
        $reussites = [];
        $echecs = [];
        $non_classes = [];
        $eleves = $this->eleves();
        // dd($eleves);
        foreach ($eleves as $eleve) {
            if ($eleve->resultat() === null) {
                $nc[] = $eleve;
            } else {
                // dd($eleve->resultat());
                if ($eleve->resultat()->decision === 'passe') {
                    $reussites[] = $eleve;
                } else {
                    if ($eleve->resultat()->decision === 'double') {
                        $echecs[] = $eleve;
                    } else {
                        $non_classes[] = $eleve;
                    }
                }
            }
        }
        $data['reussites'] = $reussites;
        $data['echecs'] = $echecs;
        $data['non_classe'] = $non_classes;

        return $data;
    }

    public function classesDeNiveauSuperieur()
    {
        $niveau = $this->niveau->numerotation;
        // dd($this);

        return Classe::join('niveaux', 'niveaux.id', 'niveau_id')
            ->join('sections', 'sections.id', 'section_id')
            ->where('numerotation', '=', $niveau + 1)
            ->orderBy('numerotation', 'asc')
            ->select('classes.*')
            ->get();
    }

    public function classesDeMemeNiveau()
    {
        $niveau = $this->niveau->numerotation;
        // dd($this);

        return Classe::join('niveaux', 'niveaux.id', 'niveau_id')
            ->join('sections', 'sections.id', 'section_id')
            ->where('numerotation', '=', $niveau)
            ->orderBy('numerotation', 'asc')
            ->select('classes.*')
            ->get();
    }
    public function classesDeMemeInferieur()
    {
        $niveau = $this->niveau->numerotation;
        // dd($this);

        return Classe::join('niveaux', 'niveaux.id', 'niveau_id')
            ->join('sections', 'sections.id', 'section_id')
            ->where('numerotation', '<', $niveau)
            ->orderBy('numerotation', 'asc')
            ->select('classes.*')
            ->get();
    }
}
