<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingoing extends Model
{

    protected $fillable = [

        'updated_at',
    ];

    public function ingoing(){
        return $this->morphTo();
    }
}
