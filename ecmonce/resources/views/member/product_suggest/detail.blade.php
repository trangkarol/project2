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
                                    <div class="women">
                                        <span>{{ trans('product.lbl-made-in') }} : {{ $productSuggest->made_in }}</span>
                                        <span>{{ trans('product.lbl-date-manufacture') }} : {{ $productSuggest->date_manufacture }}</span>
                                        <span>{{ trans('product.lbl-date-expiration') }} : {{ $productSuggest->date_expiration }}</span>
                                    </div>
                                    <div class="color-quality">
                                        <h6><a href="{{ action('Member\SuggestProductController@edit', $productSuggest->id) }}">{{ trans('common.button.edit') }}</a></h6>
                                    </div>
                                </div>
                                <div class="single-right simpleCart_shelfItem">
                                    <h4>{{ $productSuggest->product_name }}</h4>
                                    <p class="price item_price">{{ $productSuggest->price_format }}</p>
                                    <div class="description">
                                        <p><span>{{ trans('product.lbl-description') }} : </span> {{ $productSuggest->description }}</p>
                                    </div>
                                </div>
                                <div class="clearfix"> </div>

                            </div>
                        </div>
                        <div class="col-md-3 single-grid1">
                            @include('member.product.new_products')
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
