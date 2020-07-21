<?php
/**
 * Created by PhpStorm.
 * User: Christian HESSI
 * Date: 06/07/2019
 * Time: 10:46
 */

namespace App\Repositories;


use App\Models\Echeancier;
use InfyOm\Generator\Common\BaseRepository;

class EcheancierRepository extends BaseRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return Echeancier::class;
    }
}