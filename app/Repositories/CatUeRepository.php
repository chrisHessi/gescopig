<?php
/**
 * Created by PhpStorm.
 * User: Christian HESSI
 * Date: 07/03/2019
 * Time: 20:21
 */

namespace App\Repositories;

use App\Models\CatUe;
use InfyOm\Generator\Common\BaseRepository;

class CatUeRepository extends BaseRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return CatUe::class;
    }
}