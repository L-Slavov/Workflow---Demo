<?php

namespace App\Http\Controllers\Auth;

use Gate;
use App\User;
use App\Permissions;
use App\Role;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    /* public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }
    */

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required',
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'partner' => 'required',
            'phone_number' => 'max:13'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

        if (Gate::denies('create_user')) {
           return view('errors.403');
        }
  


        if ($data['role'] == 'User' && $data['partner'] == 'beOnline') {
            $permissions = Role::where("name","SuperUser")->first();
            $data['role'] = "SuperUser";
        }else if($data['role'] == 'Manager'){
            $permissions = Role::where("name","Manager")->first();
        }else if($data['role'] == 'Admin' && $data['partner'] == 'beOnline'){
            $permissions = Role::where("name","SuperAdmin")->first();
            $data['role'] = "SuperAdmin";
        }else if($data['role'] == 'User'){
            $permissions = Role::where("name","User")->first();
        }else if($data['role'] == 'Admin'){
            $permissions = Role::where("name","Admin")->first();
        }

        Permissions:: create([
            "username" => $data['username'],
            'create_user_beonline'=>$permissions["create_user_beonline"],
            'create_user_partner'=>$permissions["create_user_partner"],
            'edit_user_beonline'=>$permissions["edit_user_beonline"],
            'edit_user_partner'=>$permissions["edit_user_partner"],
            'view_tasks_beonline'=>$permissions["view_tasks_beonline"],
            'view_tasks_partner'=>$permissions["view_tasks_partner"],
            'view_tasks_self'=>$permissions["view_tasks_self"],
            'edit_tasks_status'=>$permissions["edit_tasks_status"],
            'create_tasks'=>$permissions["create_tasks"]
            ]);

        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role'=>$data['role'],
            'first_name' => $data['name'],
            'surname' => $data['surname'],
            'partner' => $data['partner'],
            'phone_number' => $data['phone_number']
            
        ]);
    }
}
