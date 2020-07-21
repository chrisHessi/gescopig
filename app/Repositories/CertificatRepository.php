<?php


namespace App\Repositories;


use App\Models\Certificat;
use InfyOm\Generator\Common\BaseRepository;

class CertificatRepository extends BaseRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return Certificat::class;
    }
}