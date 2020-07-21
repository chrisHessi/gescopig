<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scolarite extends Model
{
    protected $fillable = [
        'apprenant_id',
        'specialite_id',
        'academic_year_id',
        'cycle_id',
        'dette',
        'ancien'
    ];

    public function apprenant(){
        return $this->belongsTo(Apprenant::class);
    }

    public function specialite(){
        return $this->belongsTo(Specialite::class);
    }

    public function cycle(){
        return $this->belongsTo(Cycle::class);
    }

    public function academic_year(){
        return $this->belongsTo(AcademicYear::class);
    }

    public function moratoires(){
        return $this->hasMany(Moratoire::class);
    }

    public function versements(){
        return $this->hasMany(Versement::class);
    }
}
