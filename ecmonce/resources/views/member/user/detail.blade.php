@extends('member.block.master')
<!-- title off page -->
@section('title')
    {{ trans('common.title-detail') }}
@endsection
<!-- banner -->
@section('banner')
    @include('member.block.banner')
@endsection
<!-- content of page -->
@section('content')
    <div class="login">
        <div class="main-agileits">
            <div class="form-w3agile form1">
                <h3>{{ trans('common.title-detail') }}</h3>
                 {!! Form::open(['action' => ['Auth\RegisterController@update', $user->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

                    @include('member.user.form_user')
                    <div class="form-group">
                        <div class="col-md-3">
                            {{ Form::reset(trans('common.button.reset'), ['class' => 'btn btn-success']) }}
                        </div>
                        <div class="col-md-3">
                            {{ Form::submit(trans('common.button.edit'), ['class' => 'btn btn-success']) }}
                        </div>
                        <div class="clearfix"></div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
