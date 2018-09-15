@extends("layouts.sub-layout-account")
@section('content')
<style>
/* VIEW ORDER PAGE */
.view-order-main .dates-ul{
  list-style-type: none;
  border: none;
  padding: 0px;
  margin: 0px;
}
.view-order-main .dates-ul .dates-cont{
  border:none;
  padding:0px;
  margin: 1px 0;
}
.view-order-main .dates-ul .dates-cont .dates .title{
 font-weight:bold;
 font-size:.8rem;
}

.view-order-header-info{
    padding: 0px;
    font-size: .8rem;
    font-family: Arial;
}
.view-order-header-total{
    padding-left:0px;
    padding-right:0px;
}
.view-order-top,
.view-order-items,
.view-order-header-total{
    background-color:white !important;
}

.view-order-top-list,
.view-order-top ul{
    list-style-type: none;
    margin: 0px;
    padding: 0px;
}
.view-order-top-list li{
    float: left;
    padding: 5px 2px;
    font-weight:bold;
    display:block;
}
.view-order-top-list li:first-child{
    padding: 5px 2px 5px 0px;
}
.view-order-top-list li:not(:first-child){
    border-left:1px solid rgba(0,0,0,.1);
    padding: 5px 10px;
}
.view-order-items .data .desc{
    padding:5px;
}
.view-order-items .data .action{
    padding:4px;
}
.view-order-items .data .action .btn-block{
    font-size: .8rem;
}
.view-order-list{
    list-style-type: none;
    margin: 0px;
    padding: 0px;
}
.view-order-list li{
    border-top:1px solid rgba(0,0,0,.1);
padding: 15px 0px;
    margin: 10px 0px;
}
.view-order-list .header{
  font-size: 1.1rem;
margin: 5px 0px;
text-align:left;
}
/*************************************************/
/*          IPAD PORTRAIT                       */
/************************************************/
@media only screen 
and (min-device-width : 768px) 
and (max-device-width : 1024px) 
and (orientation : portrait) {
    .view-order-top-list li{
        font-size:.8rem;
    }
}
</style>
<div class="container container-in-space white-md-bg-in">
    <div class="row">
        <div class="col">
            <h2>{{$page_title}}</h2>
        </div>
    </div>
    <div class="container account-container">

    <div class="row">
        <div class="col view-order-main">
            <div class="container">


                <div class="row">
                    <div class="col">
                        <ul class="view-order-top-list">
                            <li class="col-md-6">{{ __('general.dates_title.date_ordered') }}: {{ $order->purchase_date }}</li>
                            <li class="col-md-6">{{ trans_choice('general.cart_title.order',1) }}# {{ $order->order_number }}</li>
                            @if(empty($order->cancel_reason) && $order->status != 3)
                            <li class="col-md-6">
                                <a href="{{ route('confirm_order_cancel',['order_id'=>$order->id])}}">{{ __('buttons.order_cancel') }}</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div><!--end of order header 1-->
                
                <div class="row view-order-top">
                    <div class="col-md-5">
                        
                        <ul>
                            <li>{{ __('general.page_header.shipping_address') }}</li>
                            <li class="view-order-header-info">
                                {{$order->shipping_name}}<br/>
                                {{$order->shipping_address_1}} {{$order->shipping_address_2}}<br/>
                                {{$order->shipping_city}} {{$order->shipping_state}} {{$order->getShippingCountry->countryCode}} {{$order->shipping_zip_code}}<br/>
                                {{$order->shipping_phone_number_1}}<br/>
                                {{$order->shipping_phone_number_2}}<br/>
                                {{$order->shipping_email}}<br/>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-2">
                        <ul>
                            <li>{{ __('general.page_header.payment') }}</li>
                            <li class="view-order-header-info">
                                {{ $order->credit_card_type }}...{{$order->credit_card_number}}
                            </li>
                        </ul>
                    </div>
                    
                    <div class="col-md-5">
                        <ul>
                            <li>{{ __('general.page_header.order_summary') }}</li>
                            <li class="view-order-header-info">

                                <div class="container view-order-header-total">
                                    <div class="row">
                                        <div class="col">{{ trans_choice('general.cart_title.item',1) }}(s) {{ __('general.cart_title.subtotal') }}</div>
                                        <div class="col">${{number_format($order->order_total,'2','.',',')}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col">{{ __('general.cart_title.shipping_handling') }}</div>
                                        <div class="col">${{number_format($order->order_shipping,'2','.',',')}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col">{{ __('general.cart_title.estimated_tax') }}</div>
                                        <div class="col">${{number_format($order->order_tax,'2','.',',')}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col">{{ __('general.cart_title.grand_total') }}</div>
                                        <div class="col">${{number_format($order->order_total + ($order->order_quantity * $order->order_total) + $order->order_shipping + $order->order_tax,'2','.',',')}}</div>
                                    </div>
                                </div>

                            </li>
                        </ul>
                    </div>

                </div><!--end of header 2-->

                <div class="row">
                    <div class="col">
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
                    </div>
                </div><!--end of product listing-->

            </div>
        </div>
    </div>




    </div>
</div><!--end of main container-->
@endsection