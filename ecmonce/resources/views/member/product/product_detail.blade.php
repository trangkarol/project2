@extends('member.block.master')
<!-- title off page -->
@section('title')
    {{ trans('product.title-detail-product') }}
@endsection
<!-- banner -->
@section('banner')
    @include('member.block.banner')
@endsection
<!-- content of page -->
@section('content')
    <div class="products-agileinfo">
        <!-- site map -->
        <div class="col-md-12">
            <ul>
                <li><a href="{{ action('Member\HomeController@index') }}">Home</a></li>
                <li><a href="{{ action('Member\HomeController@index') }}">{{ $product->category->name }}</a></li>
            </ul>
        </div>
        <h2 class="tittle">{{ trans('product.title-detail-product') }}</h2>
        <div class="container">
        <!--single-->
            <div class="single-wl3">
                <div class="container">
                    <div class="single-grids">
                        <div class="col-md-9 single-grid">
                            <div clas="single-top">
                                <div class="single-left">
                                    <div class="flexslider">
                                        <div class="thumb-image"> <img src="{{ $product->path_image }}" data-imagezoom="true" class="img-responsive"> </div>
                                    </div>
                                    <div class="women">
                                        <span>{{ trans('product.lbl-made-in') }} : <strong>{{ $product->made_in }}</strong></span>
                                        <span>{{ trans('product.lbl-number') }} : <strong>{{ $product->number_current }}</strong></span>
                                        <span>{{ trans('product.lbl-date-manufacture') }} : <strong>{{ $product->date_manufacture }}</strong></span>
                                        <span>{{ trans('product.lbl-date-expiration') }} : <strong>{{ $product->date_expiration }}</strong></span>

                                    </div>
                                    @include('member.cart.add_cart')
                                </div>
                                <div class="single-right simpleCart_shelfItem">
                                    <h4>{{ $product->name }}</h4>
                                    <div class="block">
                                        <div class="starbox small ghosting"> </div>
                                    </div>
                                    <p class="price item_price">{{ $product->price_format }}</p>
                                    <div class="description">
                                        <p><span>{{ trans('product.lbl-description') }} : </span> {{ $product->description }}</p>
                                    </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <!-- like,share -->
                            <div class="fb-like" data-share="true" data-width="450" data-show-faces="true">
                            </div>
                        </div>
                        <div class="col-md-3 single-grid1">
                            @include('member.product.related_product')
                        </div>
                        <div class="clearfix"> </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
