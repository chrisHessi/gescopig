<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicCalendar extends Model
{
    protected $fillable = [
        'dateDebutPrevue',
        'dateDebut',
        'dateFinPrevue',
        'dateFin',
        'semestre_id',
        'academic_year_id'
    ];

    protected $casts = [
        'dateDebutPrevue' => 'date',
        'dateDebut' => 'date',
        'dateFinPrevue' => 'date',
        'dateFin' => 'date',
    ];

    public function semestre(){
        return $this->belongsTo(Semestre::class);
    }

    public function academicYear(){
        return $this->belongsTo(AcademicYear::class);
    }
}
