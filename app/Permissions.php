<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    //
    protected $table = 'permissions';
    protected $fillable = ['username', 'create_user_LyuboINC', 'create_user_partner','edit_user_LyuboINC','edit_user_partner','view_tasks_LyuboINC','view_tasks_partner','view_tasks_self','edit_tasks_status','create_tasks'];
    public $timestamps = false;

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
