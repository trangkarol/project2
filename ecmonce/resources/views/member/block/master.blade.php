<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>
        <!-- start css -->
        @section('contentCss')
            {{ Html::style('/bower_components/bootstrap/dist/css/bootstrap.min.css') }}
            {{ Html::style('/bower_components/components-font-awesome/css/font-awesome.min.css') }}
            {{ Html::style('/bower_components/nprogress/nprogress.css') }}
            {{ Html::style('/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}
            {{ Html::style('/jquery-colorbox/example3/colorbox.css') }}
            {{ Html::style('/css/custom.min.css') }}
            {{ Html::style('/css/common.css') }}
        @show
        <!-- end csss -->
    </head>
    <body class="home">
        <!-- Color Bars (above header)-->
        <div class="color-bar-1"></div>
        <div class="color-bar-2 color-bg"></div>
        <div class="container">
            <div class="row header">
                @include('user.block.header')
            </div>
            <div class="row headline">
                @yield('content')
            </div>
        </div>
        @section('contentJs')
            {{ Html::script('/bower_components/jquery/dist/jquery.js') }}
            {{ Html::script('/bower_components/bootstrap/dist/js/bootstrap.min.js') }}
            {{ Html::style('/bower_components/nprogress/nprogress.js') }}
            {{ Html::style('/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}
            {{ Html::style('/bower_components/fastclick/lib/fastclick.js') }}
            {{ Html::style('/bower_components/Flot/jquery.flot.js') }}
            {{ Html::style('/bower_components/Flot/jquery.pie.js') }}
            {{ Html::style('/bower_components/Flot/jquery.time.js') }}
            {{ Html::style('/bower_components/Flot/jquery.stack.js') }}
            {{ Html::style('/bower_components/Flot/jquery.resize.js') }}
            {{ Html::style('/bower_components/DateJS/build/date.js') }}
            {{ Html::style('/bower_components/moment/min/moment.min.js') }}
            {{ Html::script('/common/js/common.js') }}
            {{ Html::script('/jquery-colorbox/jquery.colorbox-min.js') }}
            {{ Html::script('/common/js/bootbox.min.js') }}
            {{ Html::script('/js/custom.min.js') }}
        @show
        <!-- end js  -->
        <script type="text/javascript">
            $.ajaxSetup ({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>

        @inlude('user.block.footer')
    </body>
</html>
