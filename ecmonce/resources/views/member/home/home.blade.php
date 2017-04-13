@extends('user.block.master')
<!-- title off page -->
@section('title')
    {{ trans('member.title-admin') }}
@endsection

<!-- content of page -->
@section('content')
    <div class="row headline">
        @include('member.home.hot_product')
    </div>
@endsection
