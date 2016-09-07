<?php

namespace App\Http\Controllers;
use Gate;
use Auth;
use Illuminate\Http\Request;
use App\Task;
use App\Http\Requests;

class Download extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }


    public function index($id,$file)
    {
        // Retrieving user in order to check partner 
    	$user = Auth::user();
        // Getting current task
    	$task = Task::find($id);
        // checking if task is completed, if it is we check if the user has permission to retrieve from archive
    	if ($task->completed_on != null && Gate::denies("create_inquiry")) {
        	return view('errors.403');
        // checking if task is from another party when user is not part of LyuboINC.
      	}elseif(Gate::denies("view_tasks_LyuboINC") && ($task->partner != $user->partner)){
      		return view('errors.403');
      	}else{
    		return response()->download(base_path()."/storage/app/public/FileCatalog/".$id."/".$file);
    	}
    }
}
