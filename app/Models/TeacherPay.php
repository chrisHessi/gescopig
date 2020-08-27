<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherPay extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'montant',
    	'date',
    	'tranche',
    	'numero_piece',
    	'observation',
        'contrat_enseignant_id',
    ];

    protected $dates = ['date'];

    public function enseignements(){
    	return $this->belongsToMany(Enseignement::class, 'enseignements_payments', 'teacher_pays_id');
    }

    public function contrat_enseignant(){
        return $this->belongsTo(ContratEnseignant::class);
    }
}
