<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>@yield('title')</title>
        <!-- start css -->
        @section('contentCss')
            {{ Html::style('/bower_components/bootstrap/dist/css/bootstrap.min.css') }}
            {{ Html::style('/bower_components/components-font-awesome/css/font-awesome.min.css') }}
            {{ Html::style('/css/style.css') }}
            {{ Html::style('/css/coreSlider.css') }}
            {{ Html::style('/css/jstarbox.css') }}
            {{ Html::style('/css/flexslider.css') }}
            {{ Html::style('/css/jquery-ui.css') }}
            {{ Html::style('/css/owl.carousel.css') }}
            {{ Html::style('//fonts.googleapis.com/css?family=Cagliostro') }}
            {{ Html::style('/jquery-colorbox/example3/colorbox.css') }}
            {{ Html::style('//fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,600,400italic,300italic,300') }}
        @show
    </head>
    <body>
        <div class="container-fluid">
            <!-- header -->
            <div class="header">
                @include('member.block.header')
            </div>
            <!-- banner -->
            <div class="banner-w3">
                @include('member.block.banner')
            </div>
            <!-- content -->
            <div class="content">
                @yield('content')
            </div>
        </div>
        @section('contentJs')
            {{ Html::script('/bower_components/jquery/dist/jquery.js') }}
            {{ Html::script('/js/member/simpleCart.min.js') }}
            {{ Html::script('/js/member/responsiveslides.min.js') }}
            {{ Html::script('/js/member/sjstarbox.js') }}
            {{ Html::script('/js/member/coreSlider.js') }}
            {{ Html::script('/js/member/main.js') }}
            {{ Html::script('/member/common.js') }}
            {{ Html::script('/jquery-colorbox/jquery.colorbox-min.js') }}
            {{ Html::script('/common/js/bootbox.min.js') }}
            <script type="text/javascript">
                var action = {
                    'get_login': "{{ action('Member\HomeController@getFormLogin') }}",
                };
            </script>
        @show
    </body>
</html>
