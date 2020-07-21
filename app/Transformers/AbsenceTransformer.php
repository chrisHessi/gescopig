<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 16/02/2018
 * Time: 10:27
 */

namespace App\Transformers;


use App\Models\Absence;
use League\Fractal\TransformerAbstract;

class AbsenceTransformer extends TransformerAbstract
{
    public function transform(Absence $absence){

        return[
            'id' => (int)$absence->id,
            'date' => $absence->date,
            'ecue' => $absence->ecue
        ];

    }
}