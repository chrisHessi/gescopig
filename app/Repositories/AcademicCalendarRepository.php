<?php


namespace App\Repositories;


use App\Models\AcademicCalendar;
use InfyOm\Generator\Common\BaseRepository;

class AcademicCalendarRepository extends BaseRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return AcademicCalendar::class;
    }
}