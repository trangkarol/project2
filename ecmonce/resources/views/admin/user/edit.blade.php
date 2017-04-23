@extends('admin.block.master')
<!-- title off page -->
@section('title')
    {{ trans('user.title-update-users') }}
@endsection
<!-- css used for page -->
<!-- content of page -->
@section('content')
    <div class="">
        <!-- title -->
        <div class="page-title">
            <div class="title_left">
                <h3>{{ trans('user.title-users') }}</h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group">
                    <div class="col-md-4">
                       <a href="{{ action('Admin\UserController@index') }}" class="btn btn-primary" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="List member"><i class="fa fa-list " ></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end title -->
        <div class="clearfix"></div>
        <!-- form search -->
        <div class="row">
            <div class="x_content">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2> {{trans('user.title-update-users') }} </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                    </ul>
                                <div class="clearfix"></div>
                            </div>
                            {!! Form::open(['action' => ['Admin\UserController@update', $user->id], 'method' => 'PUT', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                                {{ Form::hidden('userId', $user->id, ['id' => 'userId']) }}
                                @include('admin.user.form_user')
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-7">
                                        <div class="col-md-2">
                                            {{ Form::reset(trans('common.button.reset'), ['class' => 'btn btn-success']) }}
                                        </div>
                                        <div class="col-md-2">
                                            {{ Form::submit(trans('common.button.edit'), ['class' => 'btn btn-success']) }}
                                        </div>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- js used for page -->
@section('contentJs')
    @parent
    {{ Html::script('/admin/js/user.js') }}
@endsection

