<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('actions')->insert([
            ['description' => 'Review public computing needs and develop strategies to meet those needs.',
                'date' => Carbon::createFromDate(2014, 1, 1, 'America/Toronto'),
                'leads' => 'Vicky Varga',
                'collaborators' => 'IT, DLI',
                'budget' => 0,
                'projectPlan' => '',
                'successMeasured' => 'Achieve an 90% satisfaction rating; Increase computer usage by 20%',
                'priority' => 0,
                'objective_id' => 1
            ],
            ['description' => 'Establish a fine-free day to take place every second year.',
                'date' => Carbon::createFromDate(2016, 1, 1, 'America/Toronto'),
                'leads' => 'Jody Crilly',
                'collaborators' => 'Marketing, Deputy CEO',
                'budget' => 0,
                'projectPlan' => '',
                'successMeasured' => '',
                'priority' => 0,
                'objective_id' => 2
            ],
             ['description' => 'Extend literacy van services to under served communities in Edmonton and surrounding areas.',
                 'date' => Carbon::createFromDate(2015, 1, 1, 'America/Toronto'),
                'leads' => 'Elaine Jones',
                'collaborators' => 'FAO, Marketing',
                'budget' => 0,
                'projectPlan' => '',
                'successMeasured' => 'Increased use and knowledge of EPL services in underserved communities',
                'priority' => 0,
                 'objective_id' => 2
            ],
            ['description' => 'Live stream two forward thinking speaker series events in 2016',
                'date' => Carbon::createFromDate(2016, 1, 1, 'America/Toronto'),
                'leads' => 'J McPhee',
                'collaborators' => 'Marketing, ITS, DLI',
                'budget' => 5000,
                'projectPlan' => 'n',
                'successMeasured' => 'Over 500 people watching live and 5,000 video hits.',
                'priority' => 2,
                'objective_id' => 3
            ],
            ['description' => 'Host EPL Day celebrations at all branches on March 13, 2016.',
                'date' => Carbon::createFromDate(2016, 3, 13, 'America/Toronto'),
                'leads' => 'J McPhee',
                'collaborators' => 'Marketing, Purchasing, All Branches',
                'budget' => 10000,
                'projectPlan' => 'y',
                'successMeasured' => 'Increase in customer visits year over year',
                'priority' => 2,
                'objective_id' => 4
            ],
            ['description' => 'Evaluate the 2016 event and create a proposal for the 2017 by November 30, 2016.',
                'date' => Carbon::createFromDate(2017, 11, 30, 'America/Toronto'),
                'leads' => 'J McPhee',
                'collaborators' => 'Marketing',
                'budget' => 0,
                'projectPlan' => 'y',
                'successMeasured' => '',
                'priority' => 2,
                'objective_id' => 4
            ],
            ['description' => 'Host a guest speaker during Freedom to Read Week related to intellectual freedom',
                'date' => Carbon::createFromDate(2016, 2, 25, 'America/Toronto'),
                'leads' => 'J Woods',
                'collaborators' => 'Marketing, Adult Services, Fund Development, Volunteers',
                'budget' => 0,
                'projectPlan' => 'y',
                'successMeasured' => 'Sold out event, full venue and 100% sell through of fund development seats. ',
                'priority' => 1,
                'objective_id' => 5
            ],
            ['description' => 'Host Reza Aslan to speak on confronting islamaphobia on May 18, 2016',
                'date' => Carbon::createFromDate(2016, 5, 18, 'America/Toronto'),
                'leads' => 'J McPhee',
                'collaborators' => 'Marketing',
                'budget' => 15000,
                'projectPlan' => 'y',
                'successMeasured' => 'Sold out event, full venue and 100% sell through of fund development seats. ',
                'priority' => 3,
                'objective_id' => 5
            ],
        ]);

        for ($j = 1; $j <= App\Objective::All()->Count(); $j++){
            global $obj;
            $obj = DB::table('objectives')->where('id', $j)->first();
            for ($i = 1, $k = 1; $i <= App\Action::All()->Count(); $i++) {
                $act = DB::table('actions')
                    ->where('id', $i)
                    ->first();
                if ($act->objective_id == $obj->id) {
                    DB::table('actions')
                        ->where('id', $i)
                        ->update(array('ident' => $obj->ident . '.' . $k));
                    $k++;
                }
             }
        }
    }
}
