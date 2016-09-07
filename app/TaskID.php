<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskID extends Model
{
    //
    public $timestamps = false;
    protected $table = 'partner_taskid';
    protected $fillable = ['partner','task_number'];
}
