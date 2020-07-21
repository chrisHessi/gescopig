<?php

namespace App\Models;

use App\Events\EnseignementUpdate;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Enseignement
 * @package App\Models
 * @version March 8, 2018, 5:15 pm UTC
 *
 * @property \App\Models\Enseignant enseignant
 * @property \App\Models\Ecue ecue
 * @property \App\Models\Specialite specialite
 * @property integer enseignant_id
 * @property integer ecue_id
 * @property integer specialite_id
 * @property dateTime dateDebutPrevue
 * @property dateTime dateDebutEff
 * @property dateTime dateFinPrevue
 * @property dateTime dateFinEff
 * @property integer mhTotal
 * @property integer mhEff
 * @property integer mhSemaine
 */
class Enseignement extends Model
{
    use SoftDeletes;

    public $table = 'enseignements';
    

    protected $dates = ['deleted_at'];

    protected $dispatchesEvents = [
        'updated' => EnseignementUpdate::class,
    ];


    public $fillable = [
        'contrat_enseignant_id',
        'ecue_id',
        'specialite_id',
        'academic_year_id',
        'dateDebut',
        'dateFin',
        'mhTotal',
        'mhEff',
        'communication',
        'progression',
        'cc',
        'ue_id',
        'credits'

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'enseignant_id' => 'integer',
        'ecue_id' => 'integer',
        'specialite_id' => 'integer',
        'dateDebut' => 'date',
        'dateFin' => 'date',
        'mhTotal' => 'integer',
        'mhEff' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'contrat_enseignant_id' => 'integer',
        'ecue_id' => 'integer',
        'specialite_id' => 'integer',
        'dateDebut' => 'date',
        'dateFin' => '',
        'mhTotal' => 'integer',
        'mhEff' => '',
        'communication' => '',
        'progression' => '',
        'cc' => '',
        'ue_id' => 'integer',
        'credits' => 'integer'

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function contratEnseignant()
    {
        return $this->belongsTo(\App\Models\ContratEnseignant::class);
    }

    public function enseignant(){
        return $this->belongsTo(Enseignant::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function ecue()
    {
        return $this->belongsTo(\App\Models\Ecue::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function specialite()
    {
        return $this->belongsTo(\App\Models\Specialite::class);
    }
    public function academic_year()
    {
        return $this->belongsTo(\App\Models\AcademicYear::class);
    }

    public function ingoing(){
        return $this->morphOne(Ingoing::class, 'ingoing');
    }

    public function ue(){
        return $this->belongsTo(Ue::class);
    }

    public function notes(){
        return $this->hasMany(Note::class);
    }

}
