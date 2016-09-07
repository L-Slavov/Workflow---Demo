<?php

use Illuminate\Database\Seeder;
use App\Role;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Role::create([
       	'name'=>'User',
       	'create_user_LyuboINC'=>0,
       	'create_user_partner'=>0,
       	'edit_user_LyuboINC'=>0,
       	'edit_user_partner'=>0,
       	'view_tasks_LyuboINC'=>0,
       	'view_tasks_partner'=>0,
       	'view_tasks_self'=>1, 
       	'edit_tasks_status'=>0,
       	'create_tasks'=>1
       	]);
       Role::create([
       	'name'=>'SuperUser',
       	'create_user_LyuboINC'=>0,
       	'create_user_partner'=>0,
       	'edit_user_LyuboINC'=>0,
       	'edit_user_partner'=>0,
       	'view_tasks_LyuboINC'=>1,
       	'view_tasks_partner'=>0,
       	'view_tasks_self'=>0, 
       	'edit_tasks_status'=>1,
       	'create_tasks'=>0
       	]);

       Role::create([
       	'name'=>'Manager',
       	'create_user_LyuboINC'=>0,
       	'create_user_partner'=>0,
       	'edit_user_LyuboINC'=>0,
       	'edit_user_partner'=>0,
       	'view_tasks_LyuboINC'=>1,
       	'view_tasks_partner'=>0,
       	'view_tasks_self'=>0,
       	'edit_tasks_status'=>1,
       	'create_tasks'=>1
       	]);
       Role::create([
       	'name'=>'Admin',
       	'create_user_LyuboINC'=>0,
       	'create_user_partner'=>1,
       	'edit_user_LyuboINC'=>0,
       	'edit_user_partner'=>1,
       	'view_tasks_LyuboINC'=>0,
       	'view_tasks_partner'=>1,
       	'view_tasks_self'=>0,
       	'edit_tasks_status'=>0,
       	'create_tasks'=>1
       	]);
       Role::create([
       	'name'=>'SuperAdmin',
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
