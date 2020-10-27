<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Cycle
 * @package App\Models
 * @version November 30, 2017, 3:24 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection Semestre
 * @property \Illuminate\Database\Eloquent\Collection cycleSpecialites
 * @property string label
 * @property integer niveau
 * @property string slug
 */
class Cycle extends Model
{
    use SoftDeletes;

    public $table = 'cycles';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'label',
        'niveau',
        'slug'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'label' => 'string',
        'niveau' => 'integer',
        'slug' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'label' => 'bail|required|max:255',
        'niveau' => 'bail|required|max:10',
        'slug' => 'bail|max:255'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function semestres()
    {
        return $this->hasMany(\App\Models\Semestre::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function specialites()
    {
        return $this->belongsToMany(\App\Models\Specialite::class, 'cycle_specialites');
    }

    public function apprenants(){
        return $this->hasMany(Apprenant::class);
    }

    public function contrats(){
        return $this->hasMany(Contrat::class);
    }

    public function scolarites(){
        return $this->hasMany(Scolarite::class);
    }
    public function echeanciers(){
        return $this->hasMany(Echeancier::class);
    }

    public function resultatNominatifs(){
        $this->hasMany(ResultatNominatif::class);
    }
}
