<?php

namespace App\Models;

use App\Events\ModelCreated;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Absence
 * @package App\Models
 * @version December 1, 2017, 11:22 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection absenceApprenants
 * @property \App\Models\Ecue ecue
 * @property date date
 * @property boolean justify
 * @property string justification
 * @property integer ecue_id
 */
class Absence extends Model
{
    use SoftDeletes;

    public $table = 'absences';
    

    protected $dates = ['deleted_at'];

    protected $dispatchesEvents = [
        'created' => ModelCreated::class
    ];

    public $fillable = [
        'date',
        'justify',
        'justification',
        'ecue_id',
        'contrat_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'date',
        'justify' => 'boolean',
        'justification' => 'string',
        'ecue_id' => 'integer',
        'contrat_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'date' => 'bail|required|date',
        'justify' => 'bail',
        'justification' => 'bail',
        'ecue_id' => 'bail|required',
        'contrat_id' => 'bail|required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function ecue()
    {
        return $this->belongsTo(\App\Models\Ecue::class);
    }

    public function contrat()
    {
        return $this->belongsTo(Contrat::class);
    }

    public function ingoing(){
        return $this->morphOne(Ingoing::class, 'ingoing');
    }
}
