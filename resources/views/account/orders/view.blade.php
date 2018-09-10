@extends("layouts.sub-layout-account")
@section('content')
<div class="container container-in-space white-md-bg-in">
    <div class="row">
        <div class="col">
            <h2>{{$page_title}}</h2>
        </div>
    </div>
    <div class="container account-container">


    <table class="table view-order-main">
        <tbody>
                <tr>
                    <td>
                        <ul class="view-order-top-list">
                            <li>{{ __('general.dates_title.date_ordered') }}: {{ $order->purchase_date }}</li>
                            <li>{{ trans_choice('general.cart_title.order',1) }}# {{ $order->order_number }}</li>
                            @if(empty($order->cancel_reason) && $order->status != 3)
                            <li>
                                <a href="{{ route('confirm_order_cancel',['order_id'=>$order->id])}}">{{ __('buttons.order_cancel') }}</a>
                            </li>
                            @endif
                        </ul>
                    </td>
                    <td class="text-right"></td>
                </tr>
                <tr>
                    <td>
                        <table class="table view-order-top">
                            <thead>
                                <tr>
                                    <th>{{ __('general.page_header.shipping_address') }}</th>
                                    <th>{{ __('general.page_header.payment_method') }}</th>
                                    <th>{{ __('general.page_header.order_summary') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="view-order-header-info">
                                    <td>
                                        {{$order->shipping_name}}<br/>
                                        {{$order->shipping_address_1}} {{$order->shipping_address_2}}<br/>
                                        {{$order->shipping_city}} {{$order->shipping_state}} {{$order->getShippingCountry->countryCode}} {{$order->shipping_zip_code}}<br/>
                                        {{$order->shipping_phone_number_1}}<br/>
                                        {{$order->shipping_phone_number_2}}<br/>
                                        {{$order->shipping_email}}<br/>
                                    </td>
                                    <td>
                                        {{ $order->credit_card_type }}...{{$order->credit_card_number}}
                                    </td>
                                    <td>
                                        <table class="table view-order-header-total">
                                            <tbody>
                                                <tr>
                                                    <td>{{ trans_choice('general.cart_title.item',1) }}(s) {{ __('general.cart_title.subtotal') }}</td>
                                                    <td>${{number_format($order->order_total,'2','.',',')}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ __('general.cart_title.shipping_handling') }}</td>
                                                    <td>${{number_format($order->order_shipping,'2','.',',')}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ __('general.cart_title.estimated_tax') }}</td>
                                                    <td>${{number_format($order->order_tax,'2','.',',')}}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('general.cart_title.grand_total') }}</td>
                                                    <th>${{number_format($order->order_total + ($order->order_quantity * $order->order_total) + $order->order_shipping + $order->order_tax,'2','.',',')}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <ul class="view-order-list">
                            @foreach($order->products as $product)
                            <li>
                                <div class="container">
                                    <div class="row">
                                        <div class="col header">
                                            <strong>{{ $product->getStatusName->name }}</strong>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img class="img-fluid" src="{{ asset('images/products') }}/{{ $product->getProduct->images->first()->img_url}}" alt="{{ $product->getProduct->images->first()->img_name }}">
                                        </div>
                                        <div class="col-md-6">
                                                <strong><a href="{{ route('product_page',['product_id'=>$product->getProduct->id]) }}">{{ $product->getProduct->products_name }}</a></strong><br/>
                                            {{ $product->getProduct->products_description }}<br/>
                                            {{ __('general.cart_title.sell_by') }}:{{ $product->getProduct->vendor->first_name }} {{ $product->getProduct->vendor->last_name }}<br/>
                                            {{ trans_choice('general.cart_title.quantity',1) }}:{{ $product->quantity }}<br/>
                                            <span>${{ number_format($product->getProduct->total_rent,'2','.',',') }}</span>
                                            <br/>
                                            <ul class="dates-ul">
                                                @if(!empty($product->cancelled_date))
                                                <li class="dates-cont">
                                                    <span class="dates"><span class="title">{{ __('general.dates_title.cancelled_date') }}:</span>{{ $product->cancelled_date }}</span>
                                                </li>
                                                @elseif(!empty($product->returned_date))
                                                <li class="dates-cont">
                                                    <span class="dates"><span class="title">{{ __('general.dates_title.returned_date') }}:</span>{{ $product->returned_date }}</span>
                                                </li>
                                                @elseif(!empty($product->delivered_date))
                                                <li class="dates-cont">
                                                    <span class="dates"><span class="title">{{ __('general.dates_title.delivered_date') }}:</span>{{ $product->delivered_date }}</span>
                                                </li>
                                                @elseif(!empty($product->shipped_date))
                                                <li class="dates-cont">
                                                    <span class="dates"><span class="title">{{ __('general.dates_title.shipped_date') }}:</span>{{ $product->shipped_date }}</span>
                                                </li>
                                                @endif
                                            </ul>
                                           
                                        </div>
                                        <div class="col-md-3">
                                            @if(!$product->getProduct->is_rated())
                                            <div class="vesti_in_btn_pnl">
                                                <a class="btn-block vesti_in_btn_b" href="{{ route('user_new_review',['product'=>$product->product_id])}}">{{ __('buttons.write_review') }}</a>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
        </tbody>
    </table>


    </div>
</div><!--end of main container-->
@endsection