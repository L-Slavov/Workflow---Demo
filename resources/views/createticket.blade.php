@extends('layouts.app')

@section('content')
<div class="container" style="background-color: #e6e6e6">

<form method="post"  action="{{ url('/createticket') }}" enctype="multipart/form-data">
 {{ csrf_field() }}

<table class="table create-table-form">
    <tr>
        <td colspan="2"><h1>Заявка</h1></td>
        <td colspan="2" class="hidden"></td>
    </tr>
    <tr>
        <td colspan="2">Заявка №</td>
        <td>{{$taskID}} <input type="hidden" value="{{$taskID}}" name="task_number"></input></td>
        <td>Дата: <span id="time"></span></td>
    </tr>
    <tr>
        <td colspan="2">Контрагент: </td>
        <td colspan="2">{{ Auth::user()->partner }}</td>
    </tr>
    <tr>
        <td colspan="2">Задача(кратко описание на задачата): </td>
        <td colspan="2"><input type="text" class="form-control required" rows="3" name="task_summary"></input></td>
    </tr>
    <tr>
        <td rowspan="7" style="width:3px;">П<br/>о<br/>д<br/>р<br/>о<br/>б<br/>н<br/>о<br/> <br/>о<br/>п<br/>и<br/>с<br/>а<br/>н<br/>и<br/>е<br/> <br/>н<br/>а<br/> <br/>з<br/>а<br/>д<br/>а<br/>ч<br/>а<br/>т<br/>а<br/>:</td>
    </tr>
    <tr>
        <td colspan="2" class="col-xs-1">Конкретно описание на задачата: </td>
        <td colspan="2" class="col-xs-10"><textarea class="form-control"  rows="3" name="full_task_text"></textarea></td>
    </tr>
    <tr>
        <td colspan="2" class="col-xs-1">Какъв е възникналия казус задачата: </td>
        <td colspan="2" class="col-xs-10"><textarea class="form-control"  rows="2" name="task_case"></textarea></td>
    </tr>
    <tr>
        <td colspan="2" class="col-xs-1">За кои курсове се отнася задачата: </td>
        <td colspan="2" class="col-xs-10"><textarea class="form-control"  rows="2" name="affected_courses"></textarea></td>
    </tr>
    <tr>
        <td colspan="2" class="col-xs-1">За кои потребител се отнася задачата: </td>
        <td colspan="2" class="col-xs-10"><textarea class="form-control"  rows="2" name="affected_users"></textarea></td>
    </tr>
    <tr>
        <td colspan="2" class="col-xs-1">Необходимо ли е някакво предхождащо или последващо действие: </td>
        <td colspan="2" class="col-xs-10"><textarea class="form-control"  rows="2" name="extra_work"></textarea></td>
    </tr>
    <tr>
        <td colspan="2" class="col-xs-1">Допълнителен коментар: </td>
        <td colspan="2" class="col-xs-10"><textarea class="form-control"  rows="2" name="comments"></textarea></td>
    </tr>
    
    <tr>
        <td colspan="2">Изключение (специфики свързани с потребителя или курсове): </td>
        <td colspan="2"><textarea class="form-control"  rows="2" name="exceptions"></textarea></td>
    </tr>
    <tr>
        <td colspan="2">Приоритет: </td>
        <td colspan="2"> <select name="priority" class="form-control">
            <option value="1">Нисък</option>
            <option value="2">Среден</option>
            <option value="3">Висок</option>
        </select></td>
    </tr>
    <tr>
        <td colspan="2">Финален срок за стартиране работа на задачата: </td>
        <td colspan="2"><input class="form-control required datepicker" readonly="true"  name="latest_startingtime"></input></td>
    </tr>
    
</table>

  <div class="col-md-3"><label class="control-label h4">Прикачи файл:</label></div>
        <div class="col-md-8" style="padding-top: 10px;"><input type="file" class="form-control" multiple name="files[]"></input></div>


    <div class="col-md-4 col-md-offset-5" style="padding-bottom: 20px; padding-top: 20px;"><button class="btn btn-default btn-lg" type="submit" id="mainBtn" disabled="true">Изпрати</button></div>
    </form>

</div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{URL::to('js/createTicketJS.js')}}"></script>
@endsection