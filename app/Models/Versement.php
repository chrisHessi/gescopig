<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Versement extends Model
{
    protected $fillable =[
        'contrat_id',
        'montant',
        'motif',
    ];

    public function contrat(){
        return $this->belongsTo(Contrat::class);
    }
}
