<?php


namespace App\Repositories;


use App\Models\Autorisation;
use InfyOm\Generator\Common\BaseRepository;

class AutorisationRepository extends BaseRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return Autorisation::class;
    }
}