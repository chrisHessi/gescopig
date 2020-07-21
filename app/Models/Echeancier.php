<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Echeancier extends Model
{
    protected $fillable = [
        'cycle_id',
        'montant',
        'date',
        'academic_year_id',
        'tranche'
    ];

    protected $casts = [
        'date' => 'date'
    ];

    public function cycle(){
        return $this->belongsTo(Cycle::class);
    }

    public function academic_year(){
        return $this->belongsTo(AcademicYear::class);
    }
}
