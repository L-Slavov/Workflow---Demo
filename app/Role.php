<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $fillable =['name', 'create_user_LyuboINC', 'create_user_partner','edit_user_LyuboINC','edit_user_partner','view_tasks_LyuboINC','view_tasks_partner','view_tasks_self','edit_tasks_status','create_tasks'];
    public $timestamps = false;
}
