<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autorisation extends Model
{
    protected $fillable = [
        'contrat_id',
        'rang'
    ];

    public function contrat(){
        return $this->belongsTo(Contrat::class);
    }
}
