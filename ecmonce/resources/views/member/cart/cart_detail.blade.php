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
    <div class="cart-items ">
        <div class="container">
            <h2>{{ trans('member.lbl-your-cart') }} (<span id="total-number-cart">{{ Session::has('lbl-your-cart') ? count($productCats) : 0 }}</span>)</h2>
            @if (!is_null($productCats))
                @foreach ($productCats as $product)
                    <div class="cart-detail cart-header">
                        {{ Form::hidden('productId', isset($product->id) ? $product->id : 0, ['class' => 'cart-product']) }}
                        <div class="close1"> </div>
                        <div class="cart-sec simpleCart_shelfItem">
                            <div class="cart-item cyc">
                                <img src="{{ $product->path_image }}" class="img-responsive" alt="">
                            </div>
                            <div class="cart-item-info">
                                <h3><a href="{{ action('Member\ProductController@show', $product->id) }}">{{ $product->name }}</a></h3>
                                <div class="delivery">
                                    <p>{{ trans('product.lbl-price') }} : {{ $product->price_format }}</p>
                                    <div class="clearfix"></div>
                                    <p>{{ trans('product.lbl-made-in') }} : {{ $product->made_in }}</p>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                @endforeach
            @endif
            <div class="row">
                {{ Form::open(['action' => 'Member\OrderController@store', 'class' => 'form-order']) }}
                    {!! Form::button(trans('common.button.order'), ['class' => 'btn btn-success col-md-offset-8', 'id' => 'order', 'type' => 'button']) !!}
                {{ Form::close() }}
            </div>
        </div>
        <div class="container">
            <h2>{{ trans('member.lbl-order') }}</h2>
            <div class="table-responsive">
                @include('member.cart.your_order')
            </div>
        </div>
    </div>
@endsection
