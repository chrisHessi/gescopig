<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Enseignant
 * @package App\Models
 * @version March 7, 2018, 7:24 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection Enseignement
 * @property string name
 * @property string tel
 * @property string mail
 */
class Enseignant extends Model
{
    use SoftDeletes;

    public $table = 'enseignants';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'tel',
        'mail'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'tel' => 'string',
        'mail' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'bail|required|max:255',
        'tel' => 'bail|required|max:20',
        'mail' => 'bail|required|max:255|email'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function enseignements()
    {
        return $this->hasMany(\App\Models\Enseignement::class);
    }

    public function contratEnseignants(){
        return $this->hasMany(ContratEnseignant::class);
    }

    public function enseignant(){
        return $this->belongsTo(Enseignant::class);
    }
}
