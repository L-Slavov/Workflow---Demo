<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    public $timestamps = false;
    protected $fillable = ['partner', 'requested_by', 'task_summary','priority','latest_startingtime','full_task_text','task_case','affected_courses','affected_users','extra_work','comments','exceptions','expected_completion_time','task_start_date','completed_on',"task_number"];
}
