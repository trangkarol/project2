<!DOCTYPE html>
<html>
    <head>
        <title>{{ trans('common.title-login') }}</title>
        {{ Html::style('/bower_components/bootstrap/dist/css/bootstrap.min.css') }}
        {{ Html::style('/bower_components/components-font-awesome/css/font-awesome.min.css') }}
        {{ Html::style('/member/css/login.css') }}
        <script src="https://apis.google.com/js/platform.js" async defer></script>
    </head>
    <body>
        <script>
            function onSignIn(googleUser) {
                // Useful data for your client-side scripts:
                var profile = googleUser.getBasicProfile();
                console.log("ID: " + profile.getId()); // Don't send this directly to your server!
                console.log('Full Name: ' + profile.getName());
                console.log('Given Name: ' + profile.getGivenName());
                console.log('Family Name: ' + profile.getFamilyName());
                console.log("Image URL: " + profile.getImageUrl());
                console.log("Email: " + profile.getEmail());

                // The ID token you need to pass to your backend:
                var id_token = googleUser.getAuthResponse().id_token;
                console.log("ID Token: " + id_token);
          };
    </script>
        <div class="container">
            <div class="omb_login">
                <h3 class="omb_authTitle">{{ trans('common.title-login') }} {{ trans('common.lbl-or') }} <a href="#">{{ trans('common.title-sinup') }}</a></h3>
                <div class="row omb_row-sm-offset-3 omb_socialButtons">
                    <div class="col-xs-4 col-sm-2">
                        <a href="{{ action('Auth\SocialiteController@redirectToProvider', 'facebook') }}" class="btn btn-lg btn-block omb_btn-facebook">
                            <i class="fa fa-facebook visible-xs"></i>
                            <span class="hidden-xs">{{ trans('common.title-facebook') }}</span>
                        </a>
                    </div>
                    <div class="col-xs-4 col-sm-2">
                        <a href="#" class="btn btn-lg btn-block omb_btn-twitter">
                            <i class="fa fa-twitter visible-xs"></i>
                            <span class="hidden-xs">{{ trans('common.title-twitter') }}</span>
                        </a>
                    </div>
                    <div class="col-xs-4 col-sm-2">
                        <a href="{{ action('Auth\SocialiteController@redirectToProvider', 'google') }}" class="btn btn-lg btn-block omb_btn-google">
                            <i class="fa fa-google-plus visible-xs"></i>
                            <span class="hidden-xs">{{ trans('common.title-google') }}+</span>
                        </a>
                    </div>
                </div>

                <div class="row omb_row-sm-offset-3 omb_loginOr">
                    <div class="col-xs-12 col-sm-6">
                        <hr class="omb_hrOr">
                        <span class="omb_spanOr">{{ trans('common.lbl-or') }}</span>
                    </div>
                </div>

                <div class="row omb_row-sm-offset-3">
                    <div class="col-xs-12 col-sm-6">
                    {!! Form::open(['action' => 'Auth\LoginController@login', 'method' => 'POST', 'class' => 'omb_loginForm']) !!}

                        <div class="input-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            {{ Form::text('email', old('email'), ['id' => 'email', 'required', 'placeholder' => 'someone@gmail.com', 'class' => 'form-control']) }}

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="input-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            {{ Form::password('password', ['id' => 'password', 'required', 'placeholder' => '****************', 'class' => 'form-control']) }}

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-4 col-md-offset-7">
                            {{ Form::submit(trans('common.button.login'), ['class' => 'btn btn-success btn-block btn-large']) }}
                        </div>
                    {{ Form::close() }}
                    </div>
                </div>
                <div class="row omb_row-sm-offset-3">
                    <div class="col-xs-12 col-sm-3">
                        <label class="checkbox">
                            <input type="checkbox" value="remember-me">Remember Me
                        </label>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <p class="omb_forgotPwd">
                            <a href="{{ action('Auth\ForgotPasswordController@index') }}">{{ trans('common.lbl-forgot-password') }}</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
