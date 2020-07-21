<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Semestre
 * @package App\Models
 * @version November 28, 2017, 9:48 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection Ecue
 * @property \App\Models\Cycle cycle
 * @property string title
 * @property integer cycle_id
 */
class Semestre extends Model
{
    use SoftDeletes;

    public $table = 'semestres';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'cycle_id',
        'suffixe',
        'dateDebutPrevue',
        'datDebutEff',
        'dateFinPrevue',
        'dateFinEff',
        'mhSemaine'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'cycle_id' => 'integer',
        'suffixe' => 'integer',
        'dateDebutPrevue' => 'datetime',
        'dateDebutEff' => 'datetime',
        'dateFinPrevue' => 'datetime',
        'dateFinEff' => 'datetime',
        'mhSemaine' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'bail|required|max:255',
        'cycle_id' => 'bail|required',
        'suffixe' => 'bail|required|digits_between:1,2',
        'dateDebutPrevue' => 'bail|required|date',
        'dateDebutEff' => '',
        'dateFinPrevue' => 'bail|required|date',
        'dateFinEff' => '',
        'mhSemaine' => 'bail|required|numeric'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function ecues()
    {
        return $this->hasMany(\App\Models\Ecue::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function cycle()
    {
        return $this->belongsTo(\App\Models\Cycle::class);
    }

    public function enseignements()
    {
        return $this->hasManyThrough(Enseignement::class, Ecue::class);
    }

    public function semestre_infos(){
        return $this->hasMany(SemestreInfo::class);
    }

    public function academic_calendars(){
        return $this->hasMany(AcademicCalendar::class);
    }
}
