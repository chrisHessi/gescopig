<?php

namespace App\Repositories;

use App\Models\Ue;
use InfyOm\Generator\Common\BaseRepository;

class UeRepository extends BaseRepository{

    public function model()
    {
        // TODO: Implement model() method.

        return Ue::class;
    }

}