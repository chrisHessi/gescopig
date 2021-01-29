<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'create absences'
        ]);

        Permission::create([
            'name' => 'create apprenants'
        ]);

        Permission::create([
            'name' => 'create contrats'
        ]);

        Permission::create([
            'name' => 'create corkages'
        ]);

        Permission::create([
            'name' => 'create deliberation'
        ]);

        Permission::create([
            'name' => 'create echeanciers'
        ]);

        Permission::create([
            'name' => 'create ecues'
        ]);

        Permission::create([
            'name' => 'create enseignants'
        ]);

        Permission::create([
            'name' => 'create enseignements'
        ]);

        Permission::create([
            'name' => 'create moratoires'
        ]);

        Permission::create([
            'name' => 'create notes'
        ]);

        Permission::create([
            'name' => 'create specialites'
        ]);

        Permission::create([
            'name' => 'delete corkages'
        ]);

        Permission::create([
            'name' => 'delete teachers contract'
        ]);

        Permission::create([
            'name' => 'delete tutors'
        ]);

        Permission::create([
            'name' => 'delete versements'
        ]);

        Permission::create([
            'name' => 'edit absences'
        ]);

        Permission::create([
            'name' => 'edit apprenants'
        ]);

        Permission::create([
            'name' => 'edit contrats'
        ]);

        Permission::create([
            'name' => 'edit echeanciers'
        ]);

        Permission::create([
            'name' => 'edit ecues'
        ]);

        Permission::create([
            'name' => 'edit enseignants'
        ]);

        Permission::create([
            'name' => 'edit enseignements'
        ]);

        Permission::create([
            'name' => 'edit specialites'
        ]);

        Permission::create([
            'name' => 'edit teachers contract'
        ]);

        Permission::create([
            'name' => 'edit tutors'
        ]);

        Permission::create([
            'name' => 'edit versements'
        ]);

        Permission::create([
            'name' => 'export documents'
        ]);

        Permission::create([
            'name' => 'pay teachers'
        ]);

        Permission::create([
            'name' => 'print documents'
        ]);

        Permission::create([
            'name' => 'print notes'
        ]);

        Permission::create([
            'name' => 'print notice'
        ]);

        Permission::create([
            'name' => 'print teachers contract'
        ]);

        Permission::create([
            'name' => 'read absences'
        ]);
        Permission::create([
            'name' => 'read apprenants'
        ]);

        Permission::create([
            'name' => 'read catUes'
        ]);

        Permission::create([
            'name' => 'read contrats'
        ]);

        Permission::create([
            'name' => 'read corkages'
        ]);

        Permission::create([
            'name' => 'read echeanciers'
        ]);

        Permission::create([
            'name' => 'read ecues'
        ]);

        Permission::create([
            'name' => 'read enseignants'
        ]);

        Permission::create([
            'name' => 'read enseignements'
        ]);

        Permission::create([
            'name' => 'read moratoires'
        ]);

        Permission::create([
            'name' => 'read notes'
        ]);

        Permission::create([
            'name' => 'read rapport'
        ]);

        Permission::create([
            'name' => 'read scolarites'
        ]);

        Permission::create([
            'name' => 'read specialites'
        ]);

        Permission::create([
            'name' => 'read teachers contract'
        ]);

        Permission::create([
            'name' => 'read ues'
        ]);

        Permission::create([
            'name' => 'save versements'
        ]);

        Permission::create([
            'name' => 'update enseignements'
        ]);

        Permission::create([
            'name' => 'update specialites'
        ]);
    }
}
