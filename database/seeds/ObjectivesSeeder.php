<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ObjectivesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('objectives')->insert([
            ['name' => 'We Identify and meet community needs', 'goal_id' => 1],
            ['name' => 'We Reduce barriers to accessing library services', 'goal_id' => 1],
            ['name' => 'Online services are highly used and valued', 'goal_id' => 2],
            ['name' => 'Together with our community we provide successful, meaningful services that are highly rates and heavily used', 'goal_id' => 1],
        ]);

        for ($j = 1; $j <= App\Goal::All()->Count(); $j++){
            global $goal;
            $goal = DB::table('goals')->where('id', $j)->first();
            for ($i = 1, $k = 1; $i <= App\Objective::All()->Count(); $i++) {
                $obj = DB::table('objectives')
                    ->where('id', $i)
                    ->first();
                if ($obj->goal_id == $goal->id) {
                    DB::table('objectives')
                        ->where('id', $i)
                        ->update(array('ident' => $j . '.' . $k));
                    $k++;
                }
            }
        }
    }
}
