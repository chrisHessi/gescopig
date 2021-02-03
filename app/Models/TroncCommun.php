<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TroncCommun extends Model
{
    public function enseignements(){
        return $this->hasMany(Enseignement::class);
    }

    public function payments(){
        return $this->morphMany(TeacherPay::class, 'teachable');
    }
}
