<div class="x_content">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> {{ trans('common.lbl-search') }} </h2>
                    <div class="clearfix"></div>
                </div>
                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                    <div class="form-group col-md-6">
                        <label for="team" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('user.lbl-team') }}</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {{ Form::text('team', null, ['class' => 'form-control search', 'id' => 'team']) }}
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="team" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('user.lbl-position') }}</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {{ Form::text('team', null, ['class' => 'form-control search', 'id' => 'team']) }}
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="team" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('user.lbl-position_team') }}</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {{ Form::text('team', null, ['class' => 'form-control search', 'id' => 'team']) }}
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-10">
                            <button type="button" class="btn btn-success" id="btn-search">{{ trans('common.button.search') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
