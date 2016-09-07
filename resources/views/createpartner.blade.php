@extends('layouts.app')

@section('content')
<div class="container">
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
	<form method="post"  action="{{ url('/createpartner') }}" >
 	{{ csrf_field() }}
	<label>Партьор:</label>
	<input type="text" name="partner" class="form-control"></input>
	<button type="submit">Запази</button>
 	</form>

    <ul class="list-group" style="margin-top: 20px">
    @foreach($partners as $partner)
    <li class="list-group-item">{{$partner->name}}</li>
    @endforeach
  </ul>


</div>
@endsection