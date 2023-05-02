<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'objet',
        'contenu',
        'expediteur',
        'destinateur',
    ];

    public function from(){
        return User::find($this->expediteur);
    }

    public function to(){
        return User::find($this->destinateur);
    }

    public function isReaden(){
        // dd($this->read_at);
        if($this->read_at === null){
            return 0;
        }else{
            return 1;
        }
        // $this->save();
    }

    public function read(){
        if($this->to()->id === Auth::user()->id){
            $this->read_at = now();
            $this->save();
        }
    }
}
