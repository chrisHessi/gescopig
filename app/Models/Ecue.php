<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Ecue
 * @package App\Models
 * @version November 28, 2017, 10:58 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection Absence
 * @property \App\Models\Semestre semestre
 * @property \Illuminate\Database\Eloquent\Collection ecueSpecialite
 * @property string title
 * @property integer semestre_id
 * @property string slug
 */
class Ecue extends Model
{
    use SoftDeletes;

    public $table = 'ecues';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'semestre_id',
        'slug',
        'credits',
        'academic_year_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'semestre_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'bail|required',
        'semestre_id' => 'bail|required|',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function absences()
    {
        return $this->hasMany(\App\Models\Absence::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function semestre()
    {
        return $this->belongsTo(\App\Models\Semestre::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function specialites()
    {
        return $this->belongsToMany(\App\Models\Specialite::class, 'ecue_specialites');
    }

    public function enseignements()
    {
        return $this->hasMany(\App\Models\Enseignement::class);
    }

    public function academicYears(){
        return $this->belongsTo(AcademicYear::class);
    }
}
