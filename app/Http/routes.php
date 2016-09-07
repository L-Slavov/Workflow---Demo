<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::auth();

Route::get('/', 'HomeController@index');
Route::get('/view/{id}', 'HomeController@request');
Route::get("/archive/view/{id}",'HomeController@request');
Route::post('/view/{id}/start', 'HomeController@takeTask');
Route::post('/view/{id}/finish', 'HomeController@endTask');
Route::get("/archive",'HomeController@archive');
Route::post("/view/settime",'HomeController@setCompletionTime');

Route::get("/download/{id}/{file}","Download@index");
			
Route::get("/permissions/{name}",'PermissionsController@index');
Route::post("/permissions",'PermissionsController@save');

Route::get('/userlist',"UserController@index");
Route::post('/userlist',"UserController@edit");
Route::get('/userlist/delete/{id}',"UserController@delete");


Route::get('/createticket', 'TicketCreationController@index');
Route::post('/createticket', 'TicketCreationController@save');

Route::get('/inquiries','InquiryController@index');
Route::post('/inquiries','InquiryController@retrieve');

Route::get('/createpartner','PartnerController@index');
Route::post('/createpartner','PartnerController@save');