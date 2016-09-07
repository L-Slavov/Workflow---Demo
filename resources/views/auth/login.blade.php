@extends('layouts.app')

@section('content')
@if (Auth::guest())
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Вход</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                           <label class="col-md-4 control-label">Потребителско Име</label>
                            <div class="col-md-6">
                            <input type="text" class="form-control" name="username" value="{{ old('username') }}">
                        @if ($errors->has('username'))
                             <span class="help-block">
                              <strong>{{ $errors->first('username') }}</strong>
                             </span>
                        @endif
                        </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Парола</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Запомни ме
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i>Влез
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">Забравена парола</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<img src="{{ URL::to('/') }}/images/403.png" style="width: 100%; height: auto">
@endif
@endsection
