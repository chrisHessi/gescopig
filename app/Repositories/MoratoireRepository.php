<?php
/**
 * Created by PhpStorm.
 * User: Christian HESSI
 * Date: 06/07/2019
 * Time: 10:44
 */

namespace App\Repositories;


use App\Models\Moratoire;
use InfyOm\Generator\Common\BaseRepository;

class MoratoireRepository extends BaseRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return Moratoire::class;
    }

}