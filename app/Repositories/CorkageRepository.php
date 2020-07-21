<?php


namespace App\Repositories;


use App\Models\Corkage;
use InfyOm\Generator\Common\BaseRepository;

class CorkageRepository extends BaseRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return Corkage::class;
    }
}