<?php

namespace App\Http\Controllers;
use Gate;
use App\Permissions;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;

class PermissionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
	public function index($name)
	{
		//checking if user has permissions to for this view
		if (Gate::denies('edit_user_LyuboINC')) {
        	return view('errors.403');
        }
        //retrieving current user permissions
        $permissions = Permissions::where("username",$name)->first();

        return view("permissions",["permissions"=>$permissions]);
	}

	public function save(Request $request)
	{
		//checking if user has permissions to for this view
		if (Gate::denies('edit_user_LyuboINC')) {
           return 0;
        }
        //retrieving current user permissions
        $permissions = Permissions::where("username",$request->username)->first();
        $user = User::where("username",$request->username)->first();
        $user->role = "Custom";
        //setting new permissions
        $permissions->create_user_LyuboINC = ($request->create_user_LyuboINC == "on")? 1:0;
        $permissions->create_user_partner = ($request->create_user_partner == "on")? 1:0;
        $permissions->edit_user_LyuboINC = ($request->edit_user_LyuboINC == "on")? 1:0;
        $permissions->edit_user_partner = ($request->edit_user_partner == "on")? 1:0;
        $permissions->view_tasks_LyuboINC =($request->view_tasks_LyuboINC == "on")? 1:0;
        $permissions->view_tasks_partner = ($request->view_tasks_partner == "on")? 1:0;
        $permissions->view_tasks_self = ($request->view_tasks_self == "on")? 1:0;
        $permissions->edit_tasks_status = ($request->edit_tasks_status == "on")? 1:0;
        $permissions->create_tasks = ($request->create_tasks == "on")? 1:0;
        
        //saving new role and permissions into the database
        $permissions->save();
        $user->save();
        return redirect('/userlist');

	}
}