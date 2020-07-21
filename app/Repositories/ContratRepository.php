<?php
/**
 * Created by PhpStorm.
 * User: Christian HESSI
 * Date: 09/10/2018
 * Time: 19:44
 */

namespace App\Repositories;


use App\Models\Contrat;
use InfyOm\Generator\Common\BaseRepository;

class ContratRepository extends BaseRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return Contrat::class;
    }
}