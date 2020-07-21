<?php
namespace App\Transformers;

use App\Models\Apprenant;
use League\Fractal\TransformerAbstract;

    /**
     * Created by PhpStorm.
     * User: dell
     * Date: 16/02/2018
     * Time: 00:20
     */
class ApprenantTransformer extends TransformerAbstract
{

    protected $availableIncludes = [
        'absences',
        'specialite',
        'cycle'
    ];

    public function transform(Apprenant $apprenant){
        return [
            'id' => (int)$apprenant->id,
            'name' => $apprenant->name,
            'tel' => $apprenant->tel,
            'specialite_id' => $apprenant->specialite->slug. ' ' .$apprenant->cycle->niveau,
            'absences' => (int)$apprenant->absences->count(),
        ];
    }

    public function includeAbsences(Apprenant $apprenant){
        $absences = $apprenant->absences->count();

        $this->item($absences, new AbsenceTransformer);
    }


}
