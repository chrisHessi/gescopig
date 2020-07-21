<?php
/**
 * Created by PhpStorm.
 * User: Christian HESSI
 * Date: 06/07/2019
 * Time: 10:43
 */

namespace App\Repositories;


use App\Models\Versement;
use InfyOm\Generator\Common\BaseRepository;

class VersementRepository extends BaseRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return Versement::class;
    }
}