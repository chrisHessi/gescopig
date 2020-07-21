<?php

use App\Models\Cycle;
use Illuminate\Database\Seeder;

class CycleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cycle::create([
            'label' => 'Licence',
            'niveau' => '1',
            'slug' => 'Licence-1'
        ]);
        Cycle::create([
            'label' => 'Licence',
            'niveau' => '2',
            'slug' => 'Licence-2'
        ]);
        Cycle::create([
            'label' => 'Licence',
            'niveau' => '3',
            'slug' => 'Licence-3'
        ]);
        Cycle::create([
            'label' => 'Master',
            'niveau' => '1',
            'slug' => 'Master-1'
        ]);
        Cycle::create([
            'label' => 'Master',
            'niveau' => '2',
            'slug' => 'Master-2'
        ]);
    }
}
