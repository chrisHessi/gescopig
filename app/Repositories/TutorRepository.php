<?php


namespace App\Repositories;


use App\Models\Tutor;
use InfyOm\Generator\Common\BaseRepository;

class TutorRepository extends BaseRepository
{

    public function model()
    {
        // TODO: Implement model() method.
        return Tutor::class;
    }

}