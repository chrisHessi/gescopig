<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Specialite
 * @package App\Models
 * @version December 4, 2017, 12:42 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection cycleSpecialites
 * @property \Illuminate\Database\Eloquent\Collection ecueSpecialites
 * @property \Illuminate\Database\Eloquent\Collection Apprenant
 * @property string title
 * @property string slug
 * @property string temp
 */
class Specialite extends Model
{
    use SoftDeletes;

    public $table = 'specialites';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'slug',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'slug' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'bail|required|max:255',
        'slug' => 'bail|required|max:255',
        'cycle' => 'bail|required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function cycles()
    {
        return $this->belongsToMany(\App\Models\Cycle::class, 'cycle_specialites');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function ecues()
    {
        return $this->belongsToMany(\App\Models\Ecue::class, 'ecue_specialites');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/

    public function enseignements()
    {
        return $this->hasMany(\App\Models\Enseignement::class);
    }

    public function contrats(){
         return $this->hasMany(Contrat::class);
    }

    public function scolarites(){
        return $this->hasMany(Scolarite::class);
    }
}
