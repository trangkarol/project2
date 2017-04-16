@extends('member.block.master')
<!-- title off page -->
@section('title')
    {{ trans('member.title-admin') }}
@endsection

<!-- content of page -->
@section('content')
    <div class="headline">
        <p>Home</p>
        @include('member.home.hot_product')
    </div>
@endsection
