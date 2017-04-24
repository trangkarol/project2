<div class="x_content">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> {{ trans('common.lbl-search') }} </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                    <div class="clearfix"></div>
                </div>
                {!! Form::open(['action' => 'Admin\UserController@search', 'class' => 'form-horizontal form-label-left', 'id' => 'user-search']) !!}

                    <div class="form-group col-md-6">
                        <label for="team" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('user.lbl-name') }}</label>
                        <div class="col-md-6">
                            {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) }}
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="team" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('user.lbl-email') }}</label>
                        <div class="col-md-6">
                            {{ Form::email('email', null, ['class' => 'form-control', 'id' => 'email']) }}
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="team" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('user.lbl-role') }}</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {{ Form::select('role', $role, null, ['class' => 'form-control search', 'id' => 'positionTeams']) }}
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="team" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('user.lbl-active-member') }}</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {{ Form::checkbox('active_members', 1, null, ['class' => 'search', 'id' => 'active_members']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-10">
                            <button type="button" class="btn btn-success" id="btn-search">{{ trans('common.button.search') }}</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
