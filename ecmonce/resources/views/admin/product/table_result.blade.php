<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>{{ trans('common.lbl-stt') }}</th>
            <th>{{ trans('product.lbl-images') }}</th>
            <th>{{ trans('product.lbl-name') }}</th>
            <th>{{ trans('product.lbl-price') }}</th>
            <th>{{ trans('product.lbl-description') }}</th>
            <th>{{ trans('product.lbl-category') }}</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @if (!empty($members))
            @foreach ($members as $member)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ action('Admin\ProductController@show', $product->id) }}"><img src="{{ url('/Upload', $product->images) }}" width="70px" height="50px" /></a>
                    </td>
                    <td><a href="{{ action('Admin\ProductController@show', $product->id) }}">{{ $product->name }}</a></td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>
                        <div class="col-md-6">
                            <a href ="{{ action('Admin\ProductController@edit', $member->id ) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="{{ trans('product.tooltip.update') }}"><i class="fa fa-pencil-square-o"></i></a>
                        </div>
                        <div class="col-md-6">
                            {{ Form::open(['action' => Admin\ProductController@destroy', 'class' => 'form-delete-product']) }}
                                {{ Form::hidden('productId',$product->id) }}
                                {!! Form::button('<i class="fa fa-pencil-square-o"></i>', ['class' => 'btn btn-primary btn-delete', 'type' => 'button', 'data-toggle' => 'tooltip', 'title' => trans('product.tooltip.delete')]) !!}
                            {{ Form::close() }}
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
@if (isset($products))
    {{ $products->links() }}
@endif
