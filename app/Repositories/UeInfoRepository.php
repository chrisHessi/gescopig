<?php
/**
 * Created by PhpStorm.
 * User: Christian HESSI
 * Date: 17/06/2019
 * Time: 20:32
 */

namespace App\Repositories;


use App\Models\UeInfo;
use InfyOm\Generator\Common\BaseRepository;

class UeInfoRepository extends BaseRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return UeInfo::class;
    }
}