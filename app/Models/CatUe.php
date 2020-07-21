<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatUe extends Model
{
    protected $fillable = [
        'title'
    ];

    public function ues(){
        return $this->hasMany(Ue::class);
    }
}
