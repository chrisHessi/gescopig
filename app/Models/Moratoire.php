<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Moratoire extends Model
{
    protected $fillable = [
        'contrat_id',
        'montant',
        'date',
    ];

    protected $casts = [
        'date' => 'date'
    ];

    public function contrat(){
        return $this->belongsTo(Contrat::class);
    }

}
