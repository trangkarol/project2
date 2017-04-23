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
        </div>
        <!-- end title -->
        <div class="clearfix"></div>
        @include('admin.block.messages')
        <!-- form search -->
        <div class="row">
            <div class="x_content">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <canvas id="myChart" width="400" height="400"></canvas>
                                <script type="text/javascript">
                                        var ctx = document.getElementById("myChart");
                                        var myChart = new Chart(ctx, {
                                            type: 'pie',
                                            data: {
                                                labels: [
                                                        "Red",
                                                        "Blue",
                                                        "Yellow"
                                                    ],
                                                    datasets: [
                                                        {
                                                            data: [300, 50, 100],
                                                            backgroundColor: [
                                                                "#FF6384",
                                                                "#36A2EB",
                                                                "#FFCE56"
                                                            ],
                                                            hoverBackgroundColor: [
                                                                "#FF6384",
                                                                "#36A2EB",
                                                                "#FFCE56"
                                                            ]
                                                    }],
                                                },
                                            options: {
                                                scales: {
                                                    yAxes: [{
                                                        ticks: {
                                                            beginAtZero:true
                                                        }
                                                    }]
                                                }
                                            }
                                        });
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
