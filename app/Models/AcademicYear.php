<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    protected $fillable = [
        'debut', 'fin', 'actif'
    ];

    public function apprenants(){
        return $this->hasMany(Apprenant::class);
    }

    public function contrats(){
        return $this->hasMany(Apprenant::class);
    }

    public function enseignements(){
        return $this->hasMany(Enseignement::class);
    }

    public function ecues(){
        return $this->hasMany(Ecue::class);
    }
}
