@extends('member.block.master')
<!-- title off page -->
@section('title')
    {{ trans('member.title-admin') }}
@endsection

<!-- content of page -->
@section('content')
    <!-- featured products -->
    <div class="ban-bottom-w3l">
        @include('member.home.product_featured')
    </div>
    <!-- hot product -->
    <div class="new-arrivals-w3agile">
        @include('member.home.product_hot')
    </div>
    <!-- product -->
    <div class="product-agile">
        @include('member.home.product_new')
    </div>
@endsection
