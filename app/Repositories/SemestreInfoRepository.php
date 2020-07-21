<?php
/**
 * Created by PhpStorm.
 * User: Christian HESSI
 * Date: 17/06/2019
 * Time: 20:34
 */

namespace App\Repositories;


use App\Models\SemestreInfo;
use InfyOm\Generator\Common\BaseRepository;

class SemestreInfoRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        // TODO: Implement model() method.
        return SemestreInfo::class;
    }
}