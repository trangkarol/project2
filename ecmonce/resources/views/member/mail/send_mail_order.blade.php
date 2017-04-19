<h3>{{ trans('mail.lbl-header') }} <strong>{{ Auth::user()->name }}</strong></h3>
<div>
    <h5>{{ trans('mail.lbl-content') }}</h5>
    <ul>
        @foreach ($order->orderDeatils as $orderDeatil)
            <li>{{ $loop->iteration. ' '}}<strong>{{ $orderDeatil->product->name }}</strong>. {{ trans('mail.lbl-number').': '. $orderDeatil->number }} <strong>{{ $orderDeatil->total_price_format }}</strong></li>
        @endforeach
    </ul>
    <h6>{{ trans('mail.lbl-content') }} <strong>{{ $order->total_price_format }}</strong></h6>
</div>
