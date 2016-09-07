<?php

namespace App\Providers;

use Gate;
use App\Permissions;
use App\User;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */

    // Retrieving current permissions from DB
    protected function getUserPermissions($user)
    {
        $permissions = array_flatten(Permissions::where("username",$user->username)->get());
        return $permissions[0];
           
    }
    // Checking if user is from LyuboINC
    protected function LyuboINCUser($user)
    {
        
        return $user->partner == "LyuboINC";
    }


    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        // Every Gate is different permission
        $gate->define('create_tasks',function($user){
            $permissions = self::getUserPermissions($user);
            return $permissions->create_tasks == 1;
        });

        $gate->define('create_user',function($user){
            $permissions = self::getUserPermissions($user);

            return ($permissions->create_user_LyuboINC == 1) || ($permissions->create_user_partner == 1);
        });
        $gate->define('create_user_LyuboINC',function($user){
            $permissions = self::getUserPermissions($user);
            return $permissions->create_user_LyuboINC == 1;
        });
        $gate->define('create_user_partner',function($user){
            $permissions = self::getUserPermissions($user);
            return $permissions->create_user_partner == 1;
        });
        $gate->define('edit_user', function ($user){
           $permissions = self::getUserPermissions($user);
           return ($permissions->edit_user_LyuboINC == 1) || ($permissions->edit_user_partner == 1);
        });
        $gate->define('edit_user_LyuboINC',function($user){
            $permissions = self::getUserPermissions($user);
            return $permissions->edit_user_LyuboINC == 1;
        });
        $gate->define('edit_user_partner',function($user){
            $permissions = self::getUserPermissions($user);
            return $permissions->edit_user_partner == 1;
        });
        $gate->define('view_tasks_LyuboINC',function($user){
            $permissions = self::getUserPermissions($user);
            return $permissions->view_tasks_LyuboINC == 1;
        });
        $gate->define('view_tasks_partner',function($user){
            $permissions = self::getUserPermissions($user);
            return $permissions->view_tasks_partner == 1;
        });
        $gate->define('view_tasks_self',function($user){
            $permissions = self::getUserPermissions($user);
            return $permissions->view_tasks_self == 1;
        });       
        $gate->define('edit_tasks_status',function($user){
            $permissions = self::getUserPermissions($user);
            return $permissions->edit_tasks_status == 1;
        });
        $gate->define('create_inquiry', function($user)
        {
            return self::LyuboINCUser($user);
        });
              
    }

    


}
