<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class GoalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('goals')->insert([
            ['name' => 'Transform Communities', 'bpid' => 1],
            ['name' => 'Evolve our Digital Environment', 'bpid' => 1],
            ['name' => 'Act as a catalyst for learning, discovery, and creating', 'bpid' => 1]
        ]);

        for ($i = 1; $i <= App\Goal::All()->Count(); $i++){
            DB::table('goals')
                ->where('id', $i)
                ->update(array('ident' => $i));
        }
    }
}
