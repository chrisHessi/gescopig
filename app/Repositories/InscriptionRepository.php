<?php


namespace App\Repositories;


use App\Models\Inscription;
use InfyOm\Generator\Common\BaseRepository;

class InscriptionRepository extends BaseRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return Inscription::class;
    }
}