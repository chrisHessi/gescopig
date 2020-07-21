<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContratEnseignant extends Model
{
    protected $fillable = [
        'enseignant_id',
        'academic_year_id',
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
}
