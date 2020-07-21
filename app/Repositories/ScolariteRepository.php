<?php
/**
 * Created by PhpStorm.
 * User: Christian HESSI
 * Date: 05/07/2019
 * Time: 17:12
 */

namespace App\Repositories;



use App\Models\Scolarite;
use InfyOm\Generator\Common\BaseRepository;

class ScolariteRepository extends BaseRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return Scolarite::class;
    }
}