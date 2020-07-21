<?php


namespace App\Repositories;


use App\Models\ResultatNomimatif;
use InfyOm\Generator\Common\BaseRepository;

class ResultatNominatifRepository extends BaseRepository
{

    public function model()
    {
        // TODO: Implement model() method.
        return ResultatNomimatif::class;
    }

}