@extends('member.block.master')
<!-- title off page -->
@section('title')
    {{ trans('member.title-detail-suggest') }}
@endsection
<!-- banner -->
@section('banner')
    @include('member.block.banner')
@endsection
<!-- content of page -->
@section('content')
    <div class="products-agileinfo">
        <h2 class="tittle">{{ trans('member.title-detail-suggest') }}</h2>
        <div class="container">
        <!--single-->
            <div class="single-wl3">
                <div class="container">
                    <div class="single-grids">
                        <div class="col-md-9 single-grid">
                            <div clas="single-top">
                                <div class="single-left">
                                    <div class="flexslider">
                                        <div class="thumb-image"> <img src="{{ $productSuggest->path_images }}" data-imagezoom="true" class="img-responsive"> </div>
                                    </div>
                                </div>
                                <div class="single-right simpleCart_shelfItem">
                                    <h4>{{ $productSuggest->product_name }}</h4>
                                    <div class="block">
                                        <div class="starbox small ghosting"> </div>
                                    </div>
                                    <p class="price item_price">{{ $productSuggest->price_format }}</p>
                                    <div class="description">
                                        <p><span>{{ trans('product.lbl-description') }} : </span> {{ $productSuggest->description }}</p>
                                    </div>
                                    <div class="color-quality">
                                        <h6><a href="{{ action('Member\SuggestProductController@edit', $productSuggest->id) }}">{{ trans('common.button.edit') }}</a></h6>
                                    </div>
                                </div>
                                <div class="clearfix"> </div>

                            </div>
                        </div>
                        <div class="col-md-3 single-grid1">
                            <h3>Recent Products</h3>
                            <div class="recent-grids">
                                <div class="recent-left">
                                    <a href="single.html"><img class="img-responsive " src="images/r.jpg" alt=""></a>
                                </div>
                                <div class="recent-right">
                                    <h6 class="best2"><a href="single.html">Lorem ipsum dolor </a></h6>
                                    <div class="block">
                                        <div class="starbox small ghosting"> </div>
                                    </div>
                                    <span class=" price-in1"> $ 29.00</span>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="recent-grids">
                                <div class="recent-left">
                                    <a href="single.html"><img class="img-responsive " src="images/r1.jpg" alt=""></a>
                                </div>
                                <div class="recent-right">
                                    <h6 class="best2"><a href="single.html">Duis aute irure </a></h6>
                                    <div class="block">
                                        <div class="starbox small ghosting"> </div>
                                    </div>
                                    <span class=" price-in1"> $ 19.00</span>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="recent-grids">
                                <div class="recent-left">
                                    <a href="single.html"><img class="img-responsive " src="images/r2.jpg" alt=""></a>
                                </div>
                                <div class="recent-right">
                                    <h6 class="best2"><a href="single.html">Lorem ipsum dolor </a></h6>
                                    <div class="block">
                                        <div class="starbox small ghosting"> </div>
                                    </div>
                                    <span class=" price-in1"> $ 19.00</span>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="recent-grids">
                                <div class="recent-left">
                                    <a href="single.html"><img class="img-responsive " src="images/r3.jpg" alt=""></a>
                                </div>
                                <div class="recent-right">
                                    <h6 class="best2"><a href="single.html">Ut enim ad minim </a></h6>
                                    <div class="block">
                                        <div class="starbox small ghosting"> </div>
                                    </div>
                                    <span class=" price-in1">$ 45.00</span>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
        </div>
    </div>
@endsection
