<?php

namespace App\Models;

use App\Models\User;
use App\Models\Cours;
use App\Models\Frequentation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classe extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'nom',
        'niveau'
    ];


    //link to the user
    function user(){
        return $this->belongsTo(User::class);
    }

    public function cours()
    {
        return $this->hasMany(Cours::class);
    }

    public function eleves(){
        $annee = AnneeScolaire::current();
        $eleves = Eleve::join('frequentations', 'frequentations.eleve_id', '=', 'eleves.id')
                            ->where('frequentations.annee_scolaire_id', '=', $annee->id)
                            ->where('frequentations.classe_id', '=', $this->id)
                            //->select('eleves.id')
                            ->get();
        //dd($eleves);
        return $eleves;
    }

    public function frequentations()
    {
         return $this->hasMany(Frequentation::class);
    }

}
