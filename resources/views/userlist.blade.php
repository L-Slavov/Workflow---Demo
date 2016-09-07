@extends('layouts.app')

@section('content')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
@if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
@if (session('delete'))
                <div class="alert alert-danger">
                    {{ session('delete') }}
                </div>
            @endif
<div class="table-responsive">
	<table class="table ">
	<thead>
		<tr>
			<th class="col-xs-2">Потребителско име</th>
			<th class="col-xs-2">Имейл</th>
			<th class="col-xs-1">Роля</th>
			<th class="col-xs-2">Контрагент</th>
			<th class="col-xs-2">Име</th>
			<th class="col-xs-2">Фамилия</th>
		</tr>
	</thead>
	<tbody>
@foreach($users as $user)
	<tr>
		<form method="post" action="{{ url('/userlist') }}"> 
			 {{ csrf_field() }}
			<td>
			<input name="old_username" type="hidden" value="{{$user->username}}"></input>
				<div style="display:inline-block; position:relative;" class="input-target">
					<input class="form-control" readonly disabled="disabled" type="text" name="username" value="{{$user->username}}"></input>
					 <div style="position:absolute; left:0; right:0; top:0; bottom:0;" class="input-shield"></div>
				</div>
			</td>
			<td>
				<div style="display:inline-block; position:relative;" class="input-target">
				<input class="form-control" readonly disabled="disabled" type="text" name="email" value="{{$user->email}}"></input>
				<div style="position:absolute; left:0; right:0; top:0; bottom:0;" class="input-shield"></div>
				</div>
			</td>
			@can("edit_user_partner")
			<td>{{$user->role}}</td>
			@endcan
			@can("edit_user_LyuboINC")
			<td><a class="invisible-link" href="{{ url('/permissions/'.$user->username)}}">{{$user->role}}</a></td>
				<td>
					<div style=" position:relative;" class="input-target">
						<select class="form-control" name="partner"  disabled="disabled">

						@foreach($partners as $partner)
							<option value="{{$partner->name}}" {{ $user->partner == $partner->name ? 'selected="selected"' : '' }} >{{$partner->name}}</option>
						@endforeach	
						</select>
						<div style="position:absolute; left:0; right:0; top:0; bottom:0;" class="input-shield"></div>
					</div>
				</td>
			@endcan
			@can("edit_user_partner")
				<input type="hidden" value="{{$partners}}" name="partner"></input>
				<td class="col-xs-2 text-center">
					{{$partners}}			
				</td>
			@endcan
			<td>
			<div style="display:inline-block; position:relative;" class="input-target">
					<input class="form-control" readonly disabled="disabled" type="text" name="first_name" value="{{$user->first_name}}"></input>
					<div style="position:absolute; left:0; right:0; top:0; bottom:0;" class="input-shield"></div>
				</div>
			</td>
			<td >
				<div style="display:inline-block; position:relative;" class="input-target">
					<input class="form-control" readonly disabled="disabled" type="text" name="surname" value="{{$user->surname}}"></input>
					<div style="position:absolute; left:0; right:0; top:0; bottom:0;" class="input-shield"></div>
				</div>
			</td>
				<input type="hidden" name="id" value="{{$user->id}}">
			<td>
				<button type="submit" class="btn btn-default save" data-user-id="{{$user->id}}">Запази</button>
				<button class="btn btn-default cancel" type="button" data-user-id="{{$user->id}}">Отказ</button>
			</td>
			@if($user->id != 1)
			<td><a href="{{ url('/userlist/delete/'.$user->id)}}" class="invisible-link" onclick="return confirm('Сигурни ли сте, че искате да изтриете потребителя?')"><i class="fa fa-trash" aria-hidden="true"></i> Изтрий</a>
			</td>
			@endif
		</form>
	</tr> 



@endforeach
</table>
</div>
	</div> 
{!! $users->render() !!}

@endsection

@section('scripts')
<script type="text/javascript" src="{{URL::to('js/userlistJS.js')}}"></script>
@endsection