<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Permissions;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'username'=>"Admin",
        	'email'=>"Lyubomir93x@gmail.bg",
        	'password'=>bcrypt("123qweasd"),
        	'role'=>"SuperAdmin",
        	'first_name'=>"Lyubomir",
        	'surname'=>"Slavov",
        	'partner'=>"LyuboINC"
        	]);
        Permissions::create([
        	'username'=>"Admin",
        	'create_user_LyuboINC'=>1,
       		'create_user_partner'=>0,
       		'edit_user_LyuboINC'=>1,
       		'edit_user_partner'=>0,
       		'view_tasks_LyuboINC'=>1,
       		'view_tasks_partner'=>0,
       		'view_tasks_self'=>0,
       		'edit_tasks_status'=>1,
       		'create_tasks'=>0

        	]);


    }
}
