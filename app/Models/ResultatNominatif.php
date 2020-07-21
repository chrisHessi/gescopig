<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultatNominatif extends Model
{
    protected $fillable = [
        'contrat_id',
        'next_cycle_id',
        'decision'
    ];

    public function contrat(){
        return $this->belongsTo(Contrat::class);
    }

    public  function cycle(){
        return $this->belongsTo(Cycle::class,'next_cycle_id');
    }
}
