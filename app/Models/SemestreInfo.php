<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SemestreInfo extends Model
{
    protected $fillable = [
        'semestre_id',
        'contrat_id',
        'nbUeValid',
        'creditObt',
        'session',
        'mention',
        'totalNotes',
        'moyenne'
    ];

    public function semestre(){
        return $this->belongsTo(Semestre::class);
    }

    public function contrat(){
        return $this->belongsTo(Contrat::class);
    }
}
