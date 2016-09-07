<?php

namespace App\Http\Controllers;
use Auth;
use Gate;
use Mail;
use Storage;
use Validator;
use App\Task;
use App\User;
use App\TaskID;
use App\Http\Requests;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class TicketCreationController extends Controller
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
        if (Gate::denies('create_tasks')) {
           return view('errors.403');
        }
        $user = Auth::user();

        $taskID = TaskID::where("partner",$user->partner)->first();
       
        $taskID->task_number = $taskID->task_number+1;

        $taskID->save();

        
        return view('createticket',['taskID'=>$taskID->task_number]);
    }
    public function save(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
        'task_summary' => 'required',
        'latest_startingtime' => 'required',
        'priority' => 'required',
        'task_number'=>'required'

        ]);
        if ($validator->fails()) {
            return redirect('/createticket');
        }


        $task = Task::create([
            'partner' => $user->partner,
            'requested_by' => $user->username,
            'task_summary' => $request->task_summary,
            'priority' => $request->priority,
            'latest_startingtime' => $request->latest_startingtime,
            'full_task_text' => $request->full_task_text,
            'task_case'=>$request->task_case,
            'affected_courses' => $request->affected_courses,
            'affected_users' => $request->affected_users,
            'extra_work' => $request->extra_work,
            'comments' => $request->comments,
            'exceptions' => $request->exceptions,
            'task_number'=>$request->task_number
            
            ]);
  
        //checking if there are files in the request
        if ($request->hasFile('files')) {
        Storage::makeDirectory($task->id);
        $uploadDestinationPath = base_path().'/storage/app/public/FileCatalog/'.$task->id;
        
        // this form uploads multiple files
        foreach ($request->file('files') as $fileKey => $fileObject ){

            // make sure each file is valid
            if ($fileObject->isValid()) {

                // make destination file name
                $destinationFileName = '/63/'.$fileObject->getClientoriginalName();

                // move the file from tmp to the destination path
               $fileObject->move($uploadDestinationPath, $destinationFileName);
                

               

            }
        }
    }

        //sending mail to support about the new ticket
        Mail::send('emails.taskCreation', ['user'=>$user,'task' => $task], function ($m) use ($user,$task) {
            $m->from('support@LyuboINC.bg', 'LyuboINC Ticket system');
            $m->to("lubomiri@abv.bg")->subject('Заявка '.$task->task_summary);
            
        });
        
        return redirect('/');
    }
}
