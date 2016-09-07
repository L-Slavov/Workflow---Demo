@extends('layouts.app')

@section('content')
<?php
$priority = ['Нисък',"Среден","Висок"];
?>
<!-- Главното инфо в заявката --> 
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-2">От потребител:</h3></div>
		<div class="col-md-3 ">{{ $task->requested_by }}</div>
		@can('edit_tasks_status')
		@if($task->task_start_date == null) 
			<div class="col-md-2 col-md-offset-1 ">
				<form action="{{ url('/view')."/".$task->id.'/start' }}" method="POST">
            		{{ csrf_field() }}
            		<button type="submit" class="btn btn-info">
                		<i class="glyphicon glyphicon-pushpin"></i> Започни работа
            		</button>
        		</form>
        	</div>
        	<hr/>
		@elseif($task->task_start_date != null && $task->completed_on == null)
			<div class="col-md-2 col-md-offset-1 ">
				<form action="{{ url('/view').'/'.$task->id.'/finish' }}" method="POST">
            		{{ csrf_field() }}
            		<button type="submit" class="btn btn-success">
               			 <i class="glyphicon glyphicon-ok"></i> Приключи работа
           			</button>
        		</form>
       		</div>
        @endif
        <hr id="special_hr" />
        @endcan
		
	</div>

	<div class="row">
		<div class="col-md-4 col-md-offset-2">Дата на подаване:</div>
		<div class="col-md-3 user-text">{{$task->creation_date}} </div>
	</div>
	<hr/>
	<div class="row">
		<div class="col-md-4 col-md-offset-2">Приоритет:</div>
		<div class="col-md-3 user-text">{{ $priority[$task->priority-1] }}</div>

	</div>
	<hr/>	
	<div class="row">
		<div class="col-md-4 col-md-offset-2">Финален срок за стартиране по задача:</div>
		<div class="col-md-3 user-text">{{ $task->latest_startingtime }}</div>
	</div>
	<hr/>
	<div class="row">
		<div class="col-md-4 col-md-offset-2">Прогнозна дата за изпълнение на задачата:</div>
		@if($task->expected_completion_time != null)
		<div class="col-md-3 user-text">{{ $task->expected_completion_time }}</div>
		@else
		@can("edit_tasks_status")
		<div class="col-md-3">
			<form  action="{{ url('/view/settime') }}" method="POST">
				{{ csrf_field() }}
				<input type="hidden" name="id" value="{{$task->id}}"></input>
				<input class="form-control required datepicker" readonly="true"  name="expected_completion_time">
				<button class="btn btn-default save" type="submit">Запази</button>
				</form>
		</div>
		@endcan
		@endif

		
	</div>

	<!-- текстовете на заявката -->
	<hr/>
	<div class="row">
		<div class="col-md-4 col-md-offset-2">Задача:</div>
		
	</div>
	
	<div class="row">
		<div class="col-md-7 col-md-offset-3 user-text">{{ $task->task_summary }}</div>
	</div>
	<hr/>
	@if($task->full_task_text != null)
	<div class="row">
		<div class="col-md-4 col-md-offset-2">Конкретно описание на задачата:</div>
	</div>
	<div class="row">
		<div class="col-md-8 col-md-offset-3 user-text">{{ $task->full_task_text }}</div>
	</div>
	<hr/>
	@endif
	@if($task->task_case != null) 
	<div class="row">
		<div class="col-md-4 col-md-offset-2">Кaкъв е възникналя казус на задачата:</div>
	</div>
	<div class="row">
		<div class="col-md-8 col-md-offset-3 user-text">{{ $task->task_case }}</div>
	</div>
	<hr/>
	@endif
	@if($task->affected_courses != null) 
	<div class="row">
		<div class="col-md-4 col-md-offset-2">За кои курсове се отнася задачата:</div>
	</div>
	<div class="row">
		<div class="col-md-8 col-md-offset-3 user-text">{{ $task->affected_courses }}</div>
	</div>
	<hr/>
	@endif
	@if($task->affected_users != null) 
	<div class="row">
		<div class="col-md-4 col-md-offset-2">За кой потребител отнася задачата:</div>
	</div>
	<div class="row">
		<div class="col-md-8 col-md-offset-3 user-text">{{ $task->affected_users }}</div>
	</div>
	<hr/>
	@endif
	@if($task->extra_work != null) 
	<div class="row">
		<div class="col-md-4 col-md-offset-2">Необходимо ли е някакво предхождащо действие:</div>
	</div>
	<div class="row">
		<div class="col-md-8 col-md-offset-3 user-text">{{ $task->extra_work }}</div>
	</div>
	<hr/>
	@endif
	@if($task->comments != null) 
	<div class="row">
		<div class="col-md-4 col-md-offset-2">Допълнителен коментар:</div>
	</div>
	<div class="row">
		<div class="col-md-8 col-md-offset-3 user-text">{{ $task->comments }}</div>
	</div>
	<hr/>
	@endif
	@if($task->exceptions != null) 
	<div class="row">
		<div class="col-md-4 col-md-offset-2">Изключение(спецификации свързани с потребителя или курсове):</div>
	</div>
	<div class="row">
		<div class="col-md-8 col-md-offset-3 user-text">{{ $task->exceptions }}</div>
	</div>
	<hr/>
	@endif
	@if(count($files) > 0) 
	<div class="row">
	<div class="col-md-1">Качени файлове:</div>
	@foreach($files as $file)

		<div class="col-md-2"><a href="{{ url('/download').'/'.$file }}">{{preg_replace('/\d+\//','',$file)}}</a></div>
	@endforeach
	</div>
	@endif

</div>
@endsection

@section("scripts")
<script type="text/javascript" src="{{URL::to('js/taskViewJS.js')}}"></script>
@endsection
