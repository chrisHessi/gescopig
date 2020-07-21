<?php

use App\Models\Semestre;
use Illuminate\Database\Seeder;

class SemestreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Semestre::create([
            'title' => 'Semestre 1',
            'cycle_id' => 1,
            'suffixe' => 1,
            'mhSemaine' => 20
        ]);
        Semestre::create([
            'title' => 'Semestre 2',
            'cycle_id' => 1,
            'suffixe' => 2,
            'mhSemaine' => 20
        ]);
        Semestre::create([
            'title' => 'Semestre 3',
            'cycle_id' => 2,
            'suffixe' => 1,
            'mhSemaine' => 20
        ]);
        Semestre::create([
            'title' => 'Semestre 4',
            'cycle_id' => 2,
            'suffixe' => 2,
            'mhSemaine' => 20
        ]);
        Semestre::create([
            'title' => 'Semestre 5',
            'cycle_id' => 3,
            'suffixe' => 1,
            'mhSemaine' => 20
        ]);
        Semestre::create([
            'title' => 'Semestre 6',
            'cycle_id' => 3,
            'suffixe' => 2,
            'mhSemaine' => 20
        ]);
        Semestre::create([
            'title' => 'Semestre 7',
            'cycle_id' => 4,
            'suffixe' => 1,
            'mhSemaine' => 20
        ]);
        Semestre::create([
            'title' => 'Semestre 8',
            'cycle_id' => 4,
            'suffixe' => 2,
            'mhSemaine' => 20
        ]);
        Semestre::create([
            'title' => 'Semestre 9',
            'cycle_id' => 5,
            'suffixe' => 1,
            'mhSemaine' => 20
        ]);
        Semestre::create([
            'title' => 'Semestre 10',
            'cycle_id' => 5,
            'suffixe' => 2,
            'mhSemaine' => 20
        ]);
    }
}
