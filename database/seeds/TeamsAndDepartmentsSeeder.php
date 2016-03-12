<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamsAndDepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teamsAndDepartments')->insert([
            [
                'name' => 'IT Services Department',
                'description' => 'Provides technology related services',
                'Budget' => 435670,
                'team' => false,
            ],
            [
                'name' => 'Events Team',
                'description' => 'Provides events planning services',
                'Budget' => 10000,
                'team' => true,
            ],
        ]);
    }
}