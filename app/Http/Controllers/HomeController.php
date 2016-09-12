<?php

namespace App\Http\Controllers;
use Auth;
use Gate;
use Mail;
use Validator;
use Storage;
use App\User;
use App\Task;
use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Getting user information
        $user = Auth::user();

        //This variable is used for display control
        $type_of_user = '';

        //Selecting content for display depending on user permissions
        if(Gate::allows('view_tasks_LyuboINC')){
            $tasks = Task::where("completed_on",null)->orderBy('creation_date', 'desc')->paginate(10);
            $type_of_user = 'LyuboINC';
        }
        if(Gate::allows('view_tasks_partner')){
            $tasks = Task::where('partner',$user->partner)->where("completed_on",null)->orderBy('creation_date', 'desc')->paginate(10);
            $type_of_user = 'partner';
        }
        if(Gate::allows('view_tasks_self')){
            $tasks = Task::where('requested_by',$user->username)->where("completed_on",null)->orderBy('creation_date', 'desc')->paginate(10);
            $type_of_user = 'self';
        }

        
        
        

        return view('home',['tasks' => $tasks,"type_of_user" => $type_of_user]);
    }

    public function archive()
    {
        //create_inquiry is permission given only to employees and I've used it for the archive 
       if (Gate::allows("create_inquiry")) {
            $tasks = Task::where("completed_on","!=",null)->paginate(10);
            $type_of_user = 'LyuboINC';

            return view('home',['tasks' => $tasks,"type_of_user" => $type_of_user,"archive"=>true]);
       }else{
            return view('errors.403'); 
       }
    }


    public function setCompletionTime(Request $request)
    {
        // checking if user has permissions to edit tasks.
       if (Gate::denies('edit_tasks_status')){
            return view('errors.403');
       }else{
        // Retrieving and editing the completion time
        $task = Task::find($request->id);
        $files = Storage::allFiles($request->id."/");
        $task->expected_completion_time = $request->expected_completion_time;
        $task->save();
        return view('task',['task' => $task,'files'=>$files]);
       }
    }

    // This is single task review, in this view we can take and complete tasks.
    public function request($id)
    {
        $user = Auth::user();
      $task = Task::find($id);
      $files = Storage::allFiles($id."/");
      

      if ($task->completed_on != null && Gate::denies("create_inquiry")) {
            return view('errors.403');
      }elseif(Gate::denies("view_tasks_LyuboINC") && ($task->partner != $user->partner)){
            return view('errors.403');
      }else{
        return view('task',['task' => $task,'files'=>$files]);
      }
    }
    public function takeTask($id)
    {
        
        if(Gate::allows('edit_tasks_status')){
        //Retrieving current mysql server time
        $time = DB::select("SELECT NOW() FROM DUAL;");
        $time = json_decode( json_encode($time),true);
        $time = $time[0]["NOW()"];


        $user = Auth::user();
        $task = Task::find($id);
        $task->task_start_date = $time;
        $task->task_start_by = $user->username;

        $task->save();
        }

        // Disabled Mailing system
        /*
        $mailReceiver = User::where("username",$task->requested_by)->first();
        // sending mail to user and support that we have started working on the task.
        // emails.taskStart is a php blade in views/emails
        Mail::send('emails.taskStart', ['user'=>$mailReceiver,'task' => $task], function ($m) use ($user,$task) {
            $m->from('support@LyuboINC.bg', 'LyuboINC Ticket system');
            $m->to($user->email, $task->requested_by)->subject('Заявка '.$task->task_summary);
            $m->cc("lubomiri@abv.bg");
        });
        */
    
        return redirect('/')->with('status', 'Работа по заявка '.$task->task_summary.' е започната!');
    }
    public function endTask($id)
    {

        if(Gate::allows('edit_tasks_status')){
        //Retrieving current mysql server time
        $time = DB::select("SELECT NOW() FROM DUAL;");
        $time = json_decode( json_encode($time),true);
        $time = $time[0]["NOW()"];  

                
        $user = Auth::user();
        $task = Task::find($id);
        $task->completed_on = $time;
        $task->completed_by = $user->username;
        $task->save();
        }
        // sending mail to user and support that we have finished working on the task.
        // emails.taskComplete is a php blade in views/emails

        // Disabled mailing system
        /*
        Mail::send('emails.taskComplete', ['user'=>$user,'task' => $task], function ($m) use ($user,$task) {
            $m->from('support@LyuboINC.bg', 'LyuboINC Ticket system');
            $m->to($user->email, $user->name)->subject('Заявка '.$task->task_summary);
            $m->cc("lubomiri@abv.bg");
        });
        */
        return redirect('/')->with('status', 'Работата по заявка '.$task->task_summary.' е завършена!');
    }

}
