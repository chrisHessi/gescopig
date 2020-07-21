<?php
/**
 * Created by PhpStorm.
 * User: Christian HESSI
 * Date: 06/10/2018
 * Time: 11:38
 */

namespace App\Helpers;


use Illuminate\Support\Facades\DB;

class AcademicYear
{
    public static function getCurrentAcademicYear(){
        $academicYear = DB::table('academic_years')->where('actif', true)->first();
        return isset($academicYear) ? $academicYear->id : '';
    }
}