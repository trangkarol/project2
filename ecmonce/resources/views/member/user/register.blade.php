@extends('member.block.master')
<!-- title off page -->
@section('title')
    {{ trans('member.title-admin') }}
@endsection

<!-- content of page -->
@section('content')
    <div class="login">
        <div class="main-agileits">
            <div class="form-w3agile form1">
                <h3>{{ trans('common.title-resgiter') }}</h3>
                 {!! Form::open(['action' => 'Auth\RegisterController@register', 'enctype' => 'multipart/form-data']) !!}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        {{ Form::label('email', trans('user.lbl-email'), ['class' => 'col-md-12 control-label']) }}
                        <div class="col-md-12">
                            {{ Form::email('email', old('email'), ['id' => 'email', 'required', 'class' => 'form-control']) }}
                        </div>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        {{ Form::label('name', trans('user.lbl-name'), ['class' => 'col-md-12 control-label']) }}
                        <div class="col-md-12">
                            {{ Form::text('name', old('name'), ['id' => 'name', 'required', 'class' => 'form-control']) }}
                        </div>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                        <div class="clearfix"></div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        {{ Form::label('password', trans('user.lbl-password'), ['class' => 'col-md-12 control-label']) }}
                        <div class="col-md-12">
                            {{ Form::password('password', ['class' => 'form-control',  'id' => 'password', 'required']) }}
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        {{ Form::label('password_confirmation', trans('user.lbl-comfirm_password'), ['class' => 'col-md-12 control-label']) }}
                        <div class="col-md-12">
                            {{ Form::password('password_confirmation', ['class' => 'form-control',  'id' => 'password_confirmation', 'required']) }}

                            @if ($errors->has('comfirm_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                        {{ Form::label('birthday', trans('user.lbl-birthday'), ['class' => 'col-md-12 control-label']) }}
                        <div class="col-md-12">
                            {{ Form::date('birthday', isset($user->birthday) ? $user->birthday : old('birthday'), ['class' => 'form-control', 'id' => 'birthday', 'required' => true]) }}
                        </div>

                        @if ($errors->has('birthday'))
                            <span class="help-block">
                                <strong>{{ $errors->first('birthday') }}</strong>
                            </span>
                        @endif
                        <div class="clearfix"></div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('avartar', trans('user.lbl-avartar'), ['class' => 'col-md-12 control-label']) }}
                        <div class="col-md-12">
                           {{ Form::file('file', ['id' => 'avatar']) }}
                            <div class="col-md-6">
                                <img src="{{ isset($user->avatar)? url(config('setting.path.show'), $user->avatar) : url(config('setting.path.show'), config('setting.images.avatar')) }}" width="200px" height="150px">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('phone_number', trans('user.lbl-phone_number'), ['class' => 'col-md-12 control-label']) }}
                        <div class="col-md-12">
                           {{ Form::text('phone_number', isset($user->phone_number) ? $user->phone_number : old('phone_number'), ['class' => 'form-control', 'id' => 'birthday', 'required' => true]) }}
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('address', trans('user.lbl-address'), ['class' => 'col-md-12 control-label']) }}
                        <div class="col-md-12">
                           {{ Form::text('address', isset($user->address) ? $user->address : old('address'), ['class' => 'form-control', 'id' => 'birthday', 'required' => true]) }}
                        </div>
                        <div class="clearfix"></div>
                    </div>

                     <div class="form-group">
                        <div class="col-md-3">
                            {{ Form::reset(trans('common.button.reset'), ['class' => 'btn btn-success']) }}
                        </div>
                        <div class="col-md-3">
                            {{ Form::submit(trans('common.button.insert'), ['class' => 'btn btn-success']) }}
                        </div>
                        <div class="clearfix"></div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
