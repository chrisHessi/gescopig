<?php


namespace App\Repositories;


use App\Models\Attestation;
use InfyOm\Generator\Common\BaseRepository;

class AttestationRepository extends BaseRepository
{

    public function model()
    {
        // TODO: Implement model() method.
        return Attestation::class;
    }

}