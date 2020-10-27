<?php


namespace App\Repositories;


use App\Models\ResultatNominatif;
use InfyOm\Generator\Common\BaseRepository;

class ResultatNominatifRepository extends BaseRepository
{

    public function model()
    {
        // TODO: Implement model() method.
        return ResultatNominatif::class;
    }

}