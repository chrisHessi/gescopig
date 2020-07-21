<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    protected $fillable = [
        'name',
        'profession',
        'addresse',
        'tel_mobile',
        'tel_bureau',
        'tel_fixe',
        'type',
        'apprenant_id'
    ];

    public function apprenant(){

        return $this->belongsTo(Apprenant::class);

    }
}
