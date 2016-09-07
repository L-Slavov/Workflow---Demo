@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                @if (!Auth::guest())
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
                <div class="panel-heading"><b>Заявки</b>
                @if(!isset($archive))
                    @can("create_tasks")
                        <p style="text-align: right;margin-top: -5px;" ><a class="btn btn-default" href="{{ url('/createticket') }}"><i class="fa fa-plus" aria-hidden="true"></i> Създай нова заявка</a></p>
                    @endcan
                @endif
                </div>
                <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    @if($type_of_user == 'LyuboINC')
                        <th>Номер:</th>
                        <th>Задача:</th>
                        <th>Заявена от:</th>
                        <th>Контрагент:</th>
                        <th>Дата:</th>
                        <th>Статус:</th>
                    @elseif($type_of_user == 'partner')
                        <th>Номер:</th>
                        <th>Задача:</th>
                        <th>Заявена от:</th>
                        <th>Дата:</th>
                        <th>Status:</th>
                    @else
                        <th>Номер:</th>
                        <th>Задача:</th>
                        <th>Дата:</th>
                        <th>Статус:</th>
                    @endif
                    </thead>
					
                    @foreach($tasks as $task) 
                        
                        <?php
                        if ($task->task_start_date == null) {
                           $status = "Нова Заявка";
                           
                        }else if($task->task_start_date != null && $task->completed_on == null){
                            $status = "Работи се";
                            
                        }else{
                            $status = "Завършена";
                        }
                        ?>
                        <tr class ='request_target' id='{{$task->id}}'>
                        @if($type_of_user == 'LyuboINC')
                            <td>{{$task->task_number}}</td>
                            <td>{{substr($task->task_summary,0,40)}}</td>
                            <td>{{$task->requested_by}}</td>
                            <td>{{$task->partner}}</td>
                            <td>{{$task->creation_date}}</td>
                            
                            <td>{{$status}}</td>
                        @elseif($type_of_user == 'partner')
                            <td>{{$task->task_number}}</td>
                            <td>{{substr($task->task_summary,0,40)}}</td>
                            <td>{{$task->requested_by}}</td>
                            <td>{{$task->creation_date}}</td>
                            <td>{{$status}}</td>
                        @else
                            <td>{{$task->task_number}}</td>
                            <td>{{substr($task->task_summary,0,40)}}</td>
                            <td>{{$task->creation_date}}</td>
                            <td>{{$status}}</td>
                        @endif
                        </tr></a>
                    @endforeach
                        </table>
                        </div>
                        {!! $tasks->render() !!}
                <div class="panel-body">    
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script type="text/javascript" src="{{URL::to('js/homeJS.js')}}"></script>
@endsection