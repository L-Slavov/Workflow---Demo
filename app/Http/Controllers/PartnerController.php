<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partner;
use App\TaskID;
use Gate;
use App\Http\Requests;
use Validator;
class PartnerController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
    	if(Gate::denies('create_inquiry')){
    		return view('errors.403');
    	}
    	$partners = Partner::all();
    	return view("createpartner",['partners'=>$partners]);
    }
    public function save(Request $request)
    {
    	if(Gate::denies('create_inquiry')){
    		return view('errors.403');
    	}
    	$validator = Validator::make($request->all(), [
            'partner' => 'required|unique:partner_taskid',
        ]);
        if ($validator->fails()) {
            return redirect('/createpartner')->withErrors($validator);
        }
    	Partner::create(['name'=>$request->partner_name]);
    	TaskID::create(['partner'=>$request->partner_name,'task_number'=>0]);
    	return redirect('/')->with('status', 'Партьорът беше успешно добавен!');
    }
}
