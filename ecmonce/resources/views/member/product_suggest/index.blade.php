@extends('member.block.master')
<!-- title off page -->
@section('title')
    {{ trans('member.title-suggest') }}
@endsection
<!-- banner -->
@section('banner')
    @include('member.block.banner')
@endsection
<!-- content of page -->
@section('content')
    <div class="products-agileinfo">
        <h2 class="tittle">{{ trans('member.title-suggest') }}</h2>
        <div class="container">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>{{ trans('common.lbl-stt') }}</th>
                        <th>{{ trans('product.lbl-images') }}</th>
                        <th>{{ trans('product.lbl-name') }}</th>
                        <th>{{ trans('product.lbl-price') }}</th>
                        <th>{{ trans('product.lbl-description') }}</th>
                        <th>{{ trans('product.lbl-accept') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($productSuggests))
                        @foreach ($productSuggests as $product)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <a href="{{ action('Member\SuggestProductController@show', $product->id) }}"><img src="{{ $product->path_images }}" width="70px" height="50px" /></a>
                                </td>
                                <td><a href="{{ action('Member\SuggestProductController@show', $product->id) }}">{{ $product->product_name }}</a></td>
                                <td>{{ $product->price_format }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $product->is_accept ? 'Accept' : '' }}</td>
                                <td>
                                    @if (!$product->is_accept)
                                        <div class="col-md-6">
                                            <a href ="{{ action('Member\SuggestProductController@edit', $product->id) }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="{{ trans('product.tooltip.update') }}"><i class="fa fa-pencil-square-o"></i></a>
                                        </div>
                                        <div class="col-md-6">
                                        {{ Form::open(['action' => ['Admin\ProductController@destroy', $product->id], 'class' => 'form-delete-product']) }}
                                                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['class' => 'btn btn-success btn-delete', 'type' => 'button', 'data-toggle' => 'tooltip', 'title' => trans('product.tooltip.delete')]) !!}
                                            {{ Form::close() }}
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            @if (isset($productSuggests))
                {{ $productSuggests->links() }}
            @endif
        </div>
    </div>

@endsection
<!-- js used for page -->
@section('contentJs')
    @parent
    {{ Html::script('/member/js/suggest_product.js') }}
    <!-- add trans and action used in file user.js -->
    <script type="text/javascript">
        var trans = {
            'new_category': "{{ trans('product.lbl-new-category') }}",
            'old_category': "{{ trans('product.lbl-old-category') }}",
            'choose_category': "{{ trans('product.lbl-choose-category') }}",
        };

        var action = {
            'product_sub_category': "{{ action('Member\SuggestProductController@getCategory') }}",
        };
    </script>
@endsection
