<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partner;
use App\User;
use DB;
use App\Http\Requests;

class InquiryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
	public function queryBuilder($request)
	{
		$creation_date = $request->starting_time;
    	$completed_on = $request->finishing_time;
    	$partner = $request->partner;
    	$created_by = $request->user;
    	$completed_by = $request->worker;

    	$sql_request = "Select * from tasks where completed_by !='null'";
    	if ($creation_date != '') {
    		$sql_request .=" and creation_date >='".$creation_date."'";
    		
    	}
    	if ($completed_on != '') {
    		$sql_request .=" and completed_on <='".$completed_on."'";
    		
    	}
    	if ($partner != 'all') {
    		$sql_request .=" and partner ='".$partner."'";
    		
    	}
    	if ($created_by != 'all') {
    		$sql_request .=" and requested_by ='".$created_by."'";
    		
    	}
    	if ($completed_by != 'all') {
    		$sql_request .="and completed_by ='".$completed_by."'";
    		
    	}
    	$sql_request .=";";
    	return $sql_request;
	}
    public function Statistics($tasks)
    {
        // times array is where we keep reaction time, completion time and counter on how many tasks the user has.(so we can take average)
        $times = [];
        $tasks = json_decode( json_encode($tasks),true);
        foreach ($tasks as $task) {
            // Checking if that user was already added in the array.
            if (array_key_exists($task['completed_by'],$times)) {
                //adding to counter
                $times[$task['completed_by']][2] = $times[$task['completed_by']][2]+1;
                // current reaction time
                $reactionTime = strtotime($task['task_start_date']) - strtotime($task['creation_date']);
                // current completion time
                $completion_time = strtotime($task['completed_on']) - strtotime($task['task_start_date']);
                //adding reaction time and completion time to the user.
                $times[$task['completed_by']][0] =  $times[$task['completed_by']][0]+$reactionTime;
                $times[$task['completed_by']][1] =  $times[$task['completed_by']][1]+$completion_time;

            }else{ 
                // if user doesn't is not in the array. We add counter of one.
                $counter = 1;
                // adding reaction adn completion time
                $reactionTime = strtotime($task['task_start_date']) - strtotime($task['creation_date']);
                $completion_time = strtotime($task['completed_on']) - strtotime($task['task_start_date']);
                $times[$task['completed_by']] = [$reactionTime,$completion_time,$counter];
            }
        }
        return $times;
    }
    public function index()
    {
    	$partners = Partner::all();
    	$users = User::all();
    	return view('inquiries',['users'=>$users,'partners'=>$partners]);
    }
    public function retrieve(Request $request)
    {
    	$partners = Partner::all();
    	$users = User::all();
    	$tasks = DB::select(self::queryBuilder($request));
        $statistics = self::Statistics($tasks);
    	return view('inquiries',['users'=>$users,'partners'=>$partners,'tasks'=>$tasks,"statistics" => $statistics]);
    }


   

        
      
    
}
