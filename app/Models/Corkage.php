<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Corkage extends Model
{
    protected $fillable = [
        'title',
        'montant',
        'reduction',
        'contrat_id'
    ];

    public function contrat(){
        return $this->belongsTo(Contrat::class);
    }
}
