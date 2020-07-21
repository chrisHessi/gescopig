<?php
/**
 * Created by PhpStorm.
 * User: Christian HESSI
 * Date: 22/07/2019
 * Time: 12:34
 */

namespace App\Repositories;


use App\Models\AcademicYear;
use InfyOm\Generator\Common\BaseRepository;

class AcademicYearRepository extends BaseRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return AcademicYear::class;
    }
}