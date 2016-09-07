@extends('layouts.app')

@section('content')
<div class="container">
	<form method="POST" action="{{ url('/permissions') }}">
	 {{ csrf_field() }}
		<table class="table table-striped">
	<tr>
		<td colspan="3"><h4 style="text-align: center;">{{$permissions->username}}</h4><input type="hidden" name="username" value="{{$permissions->username}}"></input></td>
	</tr>
	<tr >
		<td rowspan="2">Създава потребител като:</td>
		<td>Служител:</td>
		<td><input type="checkbox" name="create_user_LyuboINC" class="create-user" data-current-state="{{$permissions->create_user_LyuboINC}}"></td>
	</tr>
	<tr>
		
		<td style="background-color: #FFF">Партньор:</td>
		<td style="background-color: #FFF"> <input type="checkbox" name="create_user_partner" class="create-user" data-current-state="{{$permissions->create_user_partner}}"></td>
	</tr>
	<tr>
		<td rowspan="2" style="background-color: #F9F9F9">Променя потребители като:</td>
		<td style="background-color: #F9F9F9">Служител:</td>
		<td style="background-color: #F9F9F9"><input type="checkbox" name="edit_user_LyuboINC" class="edit-user" data-current-state="{{$permissions->edit_user_LyuboINC}}"></td>
	</tr>
	
	<tr>
		<td>Партньор:</td>
		<td ><input type="checkbox" name="edit_user_partner" class="edit-user" data-current-state="{{$permissions->edit_user_partner}}"></td>
	</tr>
	<tr >
		<td rowspan="3">Вижда задачите като:</td>
		<td>Служител:</td>
		<td><input type="checkbox" name="view_tasks_LyuboINC" class="view-tasks" data-current-state="{{$permissions->view_tasks_LyuboINC}}"></td>
	</tr>
	<tr>
		<td style="background-color: #FFF">Партньор:</td>
		<td style="background-color: #FFF"> <input type="checkbox" name="view_tasks_partner" class="view-tasks" data-current-state="{{$permissions->view_tasks_partner}}"></td>
	</tr>
	<tr>
		<td>Само своите задачи:</td>
		<td><input type="checkbox" name="view_tasks_self" class="view-tasks" data-current-state="{{$permissions->view_tasks_self}}"></td>
	</tr>
	<tr>
		<td>Променя статуса на задачите:</td>
		<td></td>
		<td><input type="checkbox" name="edit_tasks_status" data-current-state="{{$permissions->edit_tasks_status}}"></td>
	</tr>
	<tr>
		<td>Създава задачи:</td>
		<td></td>
		<td><input type="checkbox" name="create_tasks" data-current-state="{{$permissions->create_tasks}}"></td>
	</tr>
	



</table>
		<button class="btn btn-default save">Запази промените</button>
	</form>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{URL::to('js/permissionsJS.js')}}"></script>
@endsection