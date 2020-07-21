<?php

use App\Models\AcademicYear;
use Illuminate\Database\Seeder;

class AcademicYearTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AcademicYear::create([
            'debut' => '2018',
            'fin' => '2019',
            'actif' => true,
        ]);
    }
}
