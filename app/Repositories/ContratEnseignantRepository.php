<?php


namespace App\Repositories;


use App\Models\ContratEnseignant;
use InfyOm\Generator\Common\BaseRepository;

class ContratEnseignantRepository extends BaseRepository
{

    public function model()
    {
        // TODO: Implement model() method.
        return ContratEnseignant::class;
    }

}