@extends('admin.block.master')
<!-- title off page -->
@section('title')
    {{ trans('order.title-order') }}
@endsection
<!-- css used for page -->
<!-- content of page -->
@section('content')
    <div class="">
        <!-- title -->
        <div class="page-title">
            <div class="title_left">
                <h3>{{ trans('order.title-order') }}</h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group">
                    <div class="col-md-4">
                        <a href="{{ action('Admin\OrderController@create') }}" data-toggle="tooltip" data-placement="top" title="{{ trans('order.tooltip.create') }}" class="btn btn-primary"><i class="fa fa-plus " ></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end title -->
        <div class="clearfix"></div>
        @include('admin.block.messages')
        <!-- form search -->
        <div class="row">
            @include('admin.product.search')
        </div>
        <div class="row">
            <div class="x_content">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <canvas id="myChart" width="400" height="400"></canvas>
                                {{ Html::style('/bower_components/moment/src/moment.js') }}
                                {{ Html::style('/bower_components/chartjs/dist/Chart.min.js') }}
                                <script type="text/javascript">
                                     var riceData = {
                                        labels : ["January","February","March","April","May","June"],
                                        datasets :
                                         [
                                            {
                                              fillColor : "rgba(172,194,132,0.4)",
                                              strokeColor : "#ACC26D",
                                              pointColor : "#fff",
                                              pointStrokeColor : "#9DB86D",
                                              data : [203000,15600,99000,25100,30500,24700]
                                            }
                                         ]
                                        }

                                        var rice = document.getElementById('myChart').getContext('2d');
                                         new Chart(rice).Line(riceData);
                                </script>
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
    {{ Html::script('/admin/js/order.js') }}
@endsection
