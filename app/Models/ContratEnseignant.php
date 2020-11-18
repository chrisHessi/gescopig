<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContratEnseignant extends Model
{
    protected $fillable = [
        'enseignant_id',
        'academic_year_id',
        'mh_licence',
        'mh_master',
        'rang'
    ];

    public static $rules = [
        'montant' => 'bail|required|integer',
        'date' => 'bail|required|date',
        'tranche' => 'bail|required',
        'numero_piece' => 'bail|required',
        'ecue_id' => 'bail|required|integer',
        'specialite' => 'bail|required'
    ];

    public function enseignant(){
        return $this->belongsTo(Enseignant::class);
    }

    public function academic_year(){
        return $this->belongsTo(AcademicYear::class);
    }

    public function enseignements()
    {
        return $this->hasMany(\App\Models\Enseignement::class);
    }

    public function payments(){
        return $this->hasManyThrough(TeachersPay::class, Enseignement::class);
    }
}
