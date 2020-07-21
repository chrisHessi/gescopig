<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Apprenant
 * @package App\Models
 * @version December 1, 2017, 10:57 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection absenceApprenants
 * @property \App\Models\Specialite specialite
 * @property string name
 * @property string tel
 * @property integer specialite_id
 * @property string tel_parent
 */
class Apprenant extends Model
{
    use SoftDeletes;

    public $table = 'apprenants';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nom',
        'prenom',
        'sexe',
        'tel',
        'matricule',
        'dateNaissance',
        'lieuNaissance',
        'nationalite',
        'civilite',
        'region',
        'email',
        'quartier',
        'academic_year_id',
        'etablissement_provenance',
        'academic_mail',
        'diplome',
        'addresse',
        'situation_professionnelle'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nom' => 'bail|required|max:250',
        'prenom' => 'bail|required|max:250',
        'sexe' => 'bail|required|max:25',
        'tel' => 'bail|required',
        'matricule' => 'bail|required',
        'dateNaissance' => 'date',
        'lieuNaissance' => 'bail|required',
        'nationalite' => 'bail|required',
        'civilite' => 'bail|required',
        'email' => 'bail|required|email',
        'quartier' => 'bail|required',
        'name' => 'bail|required',
        'profession' => 'bail|required',
        'addresse' => 'bail|required',
        'tel_mobile' => 'bail|required',
        'tel_bureau' => 'bail',
        'tel_fixe' => 'bail',
        'type' => 'bail|required',
        'academic_mail',
        'diplome' => 'bail|required',
        'situation_professionnelle' => 'bail|required',

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nom' => 'bail|required|max:250',
        'prenom' => 'bail|required|max:250',
        'sexe' => 'bail|required|max:25',
        'tel' => 'bail|required',
        'dateNaissance' => 'bail|required',
        'lieuNaissance' => 'bail|required',
        'nationalite' => 'bail|required',
        'civilite' => 'bail|required',
        'email' => 'bail|required|email',
        'quartier' => 'bail|required',
        'name1' => 'bail|required',
        'profession1' => 'bail|required',
        'addresse' => 'bail|required',
        'tel_mobile1' => 'bail|required',
        'tel_bureau' => 'bail',
        'tel_fixe' => 'bail',
        'type1' => 'bail|required',
        'etablissement_provenance' => 'bail|required',
        'specialite_id' => 'bail|required',
        'cycle_id' => 'bail|required',
        'academic_mail',
        'diplome' => 'bail|required',
        'situation_professionnelle' => 'bail|required',

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
//    public function absences()
//    {
//        return $this->hasMany(\App\Models\Absence::class);
//    }
//
//    /**
//     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
//     **/
//    public function specialite()
//    {
//        return $this->belongsTo(\App\Models\Specialite::class);
//    }
//
//    public function cycle(){
//        return $this->belongsTo(Cycle::class);
//    }

    public function tutors(){
        return $this->hasMany(Tutor::class);
    }

    public function academic_year(){
        return $this->belongsTo(AcademicYear::class);
    }

    public function contrats(){
        return $this->hasMany(Contrat::class);
    }

    public function scolarites(){
        return $this->hasMany(Scolarite::class);
    }
}
