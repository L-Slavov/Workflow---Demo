@extends('layouts.app')

@section('content')
<div class="container" style="background-color: #F5F5F5">
<form method="post" class="form-group" action="{{ url('/inquiries') }}" style="margin-bottom: 25px;">
 {{ csrf_field() }}
    <div class="row">
    	<div class="col-md-1 col-xs-12 hidden-xs hidden-sm ">
    		<h4 class="h4 text-center" style="vertical-align:middle">Избери филтри:</h4>
    	</div>
	    <div class="col-md-2 col-xs-12 form-group text-center">
	    	<label>От</label>
	    		<input class="form-control datepicker" readonly="true" type="text" name="starting_time"></input>
	    	
	    </div>
	    <div class="col-md-2 col-xs-12 form-group text-center">
	    	<label>До</label>
	    		<input class="form-control datepicker" readonly="true" type="text" name="finishing_time"></input>
	    	
	    </div>
	    <div class="col-md-2 col-xs-12 form-group text-center">
	    	<label>Контрагент</label>
		    	<select  class="form-control" name="partner">
		    			<option value="all">всички</option>
	                @foreach($partners as $partner)
	                    <option value="{{$partner['name']}}">{{$partner['name']}}</option>
	                @endforeach
	                </select>
            
	    </div>
	    <div class="col-md-2 col-xs-12 form-group text-center">
	    	<label>Потребител </label>
	    		<select  class="form-control" name="user">
	    				<option value="all">всички</option>
                @foreach($users as $user)
                	@if($user['partner'] !='LyuboINC')
                    	<option value="{{$user['username']}}">{{$user['username']}}</option>
                    @endif
                @endforeach
                </select>
           
	    </div>
	    <div class="col-md-2 col-xs-12 form-group text-center">
	    	<label>Служител</label>
	    		<select  class="form-control" name="worker">
	    				<option value="all">всички</option>
                @foreach($users as $user)
                	@if($user['partner'] =='LyuboINC')
                    	<option value="{{$user['username']}}">{{$user['username']}}</option>
                    @endif
                @endforeach
                </select>
            
	    </div>
    </div>
    <div class="row">
    	<div class="col-xs-12 text-center"><button type="submit" class="btn btn-default">Продължи</button></div>
    </div>
</form>



@if(isset($tasks))
{{count($tasks)}} Резултата
<hr/>
<div class="table-responsive">
<table class="table table-striped result">
	<thead>
		<th>Създадена</th>
		<th>Започната</th>
		<th>Завършена</th>
		<th>Контрагент</th>
		<th>Потребител</th>
		<th>Служител</th>
	</thead>
	@foreach($tasks as $task)
		<tr data-task-id = "{{$task->id}}" class="request_target">
			<td class="creation_date">{{$task->creation_date}}</td>
			<td class="task_start_date">{{$task->task_start_date}}</td>
			<td class="completed_on">{{$task->completed_on}}</td>
			<td>{{$task->partner}}</td>
			<td>{{$task->requested_by}}</td>
			<td class="completed_by">{{$task->completed_by}}</td>

		</tr>
	@endforeach
</table>

	
	<table class="table statistic">
		<thead>
			<th>Служител</th>
			<th>Средно време за реакция в минути</th>
			<th>Средно време за обработка в минути</th>
		</thead>

	@foreach($statistics as $key=>$value)
		<tr>
			<td>{{$key}}</td>
			<td class="average-reaction">{{floor(($value[0]/$value[2])/60)}}</td>
			<td class="average-work-time">{{floor(($value[1]/$value[2])/60)}}</td>
		</tr>
	@endforeach
</table>

</div>
@endif




@endsection

@section('scripts')
<script type="text/javascript" src="{{URL::to('js/inquiriesJS.js')}}"></script>
@endsection