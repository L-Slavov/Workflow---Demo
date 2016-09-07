<?php

use Illuminate\Database\Seeder;
use App\TaskID;
class partner_taskid extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        TaskID::create([
        	'partner'=>"LyuboINC",
        	'task_number'=>0
        	]);
        TaskID::create([
        	'partner'=>'Classic2000',
        	'task_number'=>0
        	]);
    }
}
