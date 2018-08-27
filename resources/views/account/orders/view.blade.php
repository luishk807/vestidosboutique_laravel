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
                            <li>Ordered Date: {{ $order->purchase_date }}</li>
                            <li>Order# {{ $order->order_number }}</li>
                        </ul>
                    </td>
                    <td class="text-right"></td>
                </tr>
                <tr>
                    <td>
                        <table class="table view-order-top">
                            <thead>
                                <tr>
                                    <th>Shipped Address</th>
                                    <th>Payment Method</th>
                                    <th>Order Summary</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="view-order-header-info">
                                    <td>
                                        {{$order->shipping_name}}<br/>
                                        {{$order->shipping_address_1}} {{$order->shipping_address_2}}<br/>
                                        {{$order->shipping_city}} {{$order->shipping_state}} {{$order->shipping_country}} {{$order->shipping_zip_code}}<br/>
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
                                                    <td>Item(s) Subtotal</td>
                                                    <td>${{number_format($order->order_total,'2','.',',')}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Shipping Handling</td>
                                                    <td>${{number_format($order->order_shipping,'2','.',',')}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Estimated Tax to be collected</td>
                                                    <td>${{number_format($order->order_total * $order->order_tax,'2','.',',')}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Grand Total</td>
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
                                            By:{{ $product->getProduct->vendor->first_name }} {{ $product->getProduct->vendor->last_name }}<br/>
                                            <span>${{ number_format($product->getProduct->total_rent,'2','.',',') }}</span>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="vesti_in_btn_pnl">
                                                <a class="btn-block vesti_in_btn_b" href="">Write Review</a>
                                            </div>
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