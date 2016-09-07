@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Създай потребител 
                </div>
                <div class="panel-body">

                   {!!Form::open(array('before' => 'csrf','url'=>'/register',"files"=>true,'class'=>'form-group'))!!}
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

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" >
                            <label class="col-md-4 control-label" style="margin-top: 15px;">Имейл Адрес</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" style="margin-top: 15px;">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label" style="margin-top: 15px;">Парола</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password" style="margin-top: 15px;">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label" style="margin-top: 15px;">Повтори Паролата</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation" style="margin-top: 15px;">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @can("create_user_LyuboINC")
                        <div class="form-group">
                         <label class="col-md-4 control-label" style="margin-top: 25px;">Роля</label>
                         <div class="col-md-6">
                         
                         <div class="radio">
                              <label>
                                <input type="radio" name="role" id="optionsRadios1" value="User" checked >
                                User
                              </label>
                            </div>
                            <div class="radio">
                              <label>
                                <input type="radio" name="role" id="optionsRadios2" value="Manager">
                                Manager
                              </label>
                            </div>
                            <div class="radio">
                              <label>
                                <input type="radio" name="role" id="optionsRadios3" value="Admin">
                                Admin
                              </label>
                            </div>
                            </div>
                        </div>
                        @endcan
                        @can("create_user_partner")
                        <input type="hidden" name="role" value="User">
                        @endcan
                          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label" >Име</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label" style="margin-top: 15px;">Фамилия</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="surname" value="{{ old('surname') }}" style="margin-top: 15px;">

                                @if ($errors->has('surname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @can("create_user_LyuboINC")
                        <div class="form-group">
                                @if ($errors->has('partner'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            <label class="col-md-4 control-label" style="margin-top: 15px;">Партньор</label>
                            <div class="col-md-6">
                            <select  class="form-control" name="partner" value="{{ old('partner') }}" style="margin-top: 15px;">
                            
                            
                            @foreach($partners as $partner)
                               <option value="{{$partner['name']}}">{{$partner['name']}}</option>
                            @endforeach
                            </select>
                            </div>
                        </div>
                        @endcan 
                        @can("create_user_partner")
                            <input type="hidden" name="partner" value="{{Auth::user()->partner}}">
                        @endcan
                        
                        <div class="form-group">

                            <label class="col-md-4 control-label" style="margin-top: 15px;">Телефонен номер</label>
                           
                            <div class="col-md-6">
                             <span class="help-block" id="hidden">
                                        <strong>Невалиден телефонен номер.</strong>
                                    </span>
                                <input type="text" id="phone" class="form-control" name="phone_number"  value="{{ old('phone_number') }}" style="margin-top: 15px;">

                              
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" id="create_user" class="btn btn-primary" style="margin-top: 15px;">
                                    <i class="fa fa-btn fa-user"></i>Създай потребителя
                                </button>
                            </div>
                        </div>

                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="js/registerJS.js"></script>
@endsection