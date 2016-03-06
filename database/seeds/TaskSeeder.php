<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            ['description' => 'Implement approved recommendations from the 2015 Public Computing Report',
                'date' => Carbon::createFromDate(2012, 3, 1, 'America/Toronto'),
                'leads' => 'Vicky Varga',
                'collaborators' => 'IT Project Team',
                'budget' => 0,
                'projectPlan' => '',
                'successMeasured' => '',
                'priority' => 0,
                'action_id' => 1
            ],
            ['description' => 'Upgrade LibOnline to the latest version (4.9)',
                'date' => Carbon::createFromDate(2012, 1, 1, 'America/Toronto'),
                'leads' => '<Michael, Luc',
                'collaborators' => 'Active Networks',
                'budget' => 0,
                'projectPlan' => '',
                'successMeasured' => '',
                'priority' => 0,
                'action_id' => 1
            ],
            ['description' => 'Provide planning assistance to the Customer Payments team to implement the necessary changes to support a Fine Free day',
                'date' => Carbon::createFromDate(2012, 3, 1, 'America/Toronto'),
                'leads' => 'Vicky Varga',
                'collaborators' => '',
                'budget' => 0,
                'projectPlan' => '',
                'successMeasured' => '',
                'priority' => 0,
                'action_id' => 2
            ],
            ['description' => 'Aid in the selection, purchase, and configuration of equipment for the fourth literacy van',
                'date' => Carbon::createFromDate(2012, 9, 9, 'America/Toronto'),
                'leads' => 'Vicky Varga',
                'collaborators' => 'Kalil, Robin, Any',
                'budget' => 0,
                'projectPlan' => '',
                'successMeasured' => '',
                'priority' => 0,
                'action_id' => 3
            ]
        ]);
    }
}