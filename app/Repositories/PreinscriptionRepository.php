<?php


namespace App\Repositories;


use App\Models\Preinscription;
use InfyOm\Generator\Common\BaseRepository;

class PreinscriptionRepository extends BaseRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return Preinscription::class;
    }
}