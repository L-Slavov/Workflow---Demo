<?php

namespace App\Http\Controllers;
use Auth;
use Gate;
use Validator;
use App\User;
use App\Task;
use App\Partner;
use App\Permissions;
use App\Http\Requests;
use Illuminate\Http\Request;

class UserController extends Controller
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
        // checking if user has permissions to edit
        if (Gate::denies('edit_user')) {
           return view('errors.403');
        }
        // If user is from LyuboINC he can see the entire user list.
        if(Gate::allows('edit_user_LyuboINC')){
            $users = User::paginate(10);
            $partners = Partner::all();
            // else only from their partner.
        }else{
            $user = Auth::user();
            $users = User::where('partner',$user->partner)->where("role","!=","Admin")->paginate(10);
            $partners = $user->partner;
        }
        

       return view('userlist',['users'=>$users,'partners'=>$partners]);
    }
    public function delete($id)
    {
        // Only users from LyuboINC are allowed to delete users
         if(Gate::denies('edit_user_LyuboINC'))
         {
            return view('errors.403');
         }else{
            $user = User::find($id);
            $user -> delete();
            return redirect("/userlist")->with("delete","Потребител ".$user->username." беше изтрит!");
         }
    }
    public function edit(Request $request)
    {
        // checking if users has edit permissions
        $user = Auth::user();
        if (Gate::denies('edit_user')) {
           return view('errors.403');
        }
        // if a field is submitted then it must have some value.
        $validator = Validator::make($request->all(), [
        'id' => 'required',
        'username' => 'sometimes|required',
        'email' => 'sometimes|email|required',
        'partner'=>'sometimes|required',
        'first_name' => 'sometimes|required',
        'surname' => 'sometimes|required'
        ]);
        if ($validator->fails()) {
            return redirect("/userlist")->withErrors($validator);
        }
        // if user is not from LyuboINC and trying to edit someone from partner different from his own. 
        if(Gate::allows('edit_user_partner') && ($user->partner != $request->partner)){
            return redirect('/')->withErrors(array('message' => 'Потребителя не може да бъде от друг контрагент.'));
        }
        

        //Checking if username is already taken
        if (isset($request->username) && (User::where("id","!=",$request->id)->where("username",$request->username)->first())!=null) {
        
            return redirect('/userlist')->withErrors(array('message' => 'Потребителското име е вече заето!'));
        }
        //Checking if email is already taken
        if (isset($request->email) && (User::where("id","!=",$request->id)->where("email",$request->email)->first()) != null) {
            return redirect('/userlist')->withErrors(array('message' => 'Имейла е вече зает!'));
        }

        $user = User::find($request->id);
        // Changing username in permissions table only if the username is actually changed
        if(isset($request->username) && $request->username != $request->old_username){
        $permissions = Permissions::where("username",$request->old_username)->first();
        $permissions->username = $request->username;
        $permissions->save();
        }

        // Changing username in users table if the username is actually changed
        if(isset($request->username) && $request->username != $request->old_username){
            $user->username = $request->username;
        }
        if(isset($request->email)){
            $user->email = $request->email;
        }
        if(isset($request->partner)){
        $user->partner = $request->partner;
        }
        if(isset($request->first_name)){
        $user->first_name = $request->first_name;
        }
        if(isset($request->surname)){
        $user->surname = $request->surname;
        }
        $user->save();
        

        return redirect("/userlist")->with("status",$request->old_username." беше променен!");
    }

}
