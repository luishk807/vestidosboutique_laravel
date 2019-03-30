@extends("layouts.sub-layout-account")
@section('content')
<div class="container container-in-space white-md-bg-in">
    <div class="row">
        <div class="col">
            <h2>{{$page_title}}</h2>
        </div>
    </div>
    <div class="container account-container remove-side-padding">

    <div class="row">
        <div class="col view-order-main">
            <div class="container">


                <div class="row ">
                    <div class="col remove-side-padding">
                        <ul class="view-order-top-list">
                            
                            @if(empty($order->cancel_reason) && $order->status != 3)
                            <li class="col-sm-5 col-md-5 col-lg-5">{{ __('general.dates_title.date_ordered') }}: {{ $order->purchase_date }}</li>
                            <li class="col-sm-5 col-md-5 col-lg-5">{{ trans_choice('general.cart_title.order',1) }}# {{ $order->order_number }}</li>
                            <li class="col-sm-2 col-md-2 col-lg-2">
                                <a href="{{ route('confirm_order_cancel',['order_id'=>$order->id])}}">{{ __('buttons.order_cancel') }}</a>
                            </li>
                            @else
                            <li class="col-sm-6 col-md-6 col-lg-6">{{ __('general.dates_title.date_ordered') }}: {{ $order->purchase_date }}</li>
                            <li class="col-sm-6 col-md-6 col-lg-6">{{ trans_choice('general.cart_title.order',1) }}# {{ $order->order_number }}</li>
                            @endif
                        </ul>
                    </div>
                </div><!--end of order header 1-->
                
                <div class="row view-order-top">
                    <div class="col-md-6 left">
                        <ul>
                            <li>{{ __('general.page_header.shipping_address') }}</li>
                            <li class="view-order-header-info">
                                {{$order_shipping->name }}<br/>
                                {{$order_shipping->address_1}} {{$order_shipping->address_2}}<br/>
                                {{$order_shipping->province_name}} {{$order_shipping->district_name}} {{$order_shipping->corregimiento_name}} {{ $order_shipping->country_name}} {{$order_shipping->zip_code}}<br/>
                                {{$order_shipping->phone_number_1}}<br/>
                                {{$order_shipping->phone_number_2}}<br/>
                                {{$order_shipping->email}}<br/>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6 right">
                        <ul>
                            <li>{{ __('general.page_header.billing_address') }}</li>
                            <li class="view-order-header-info">
                                {{$order_billing->name}}<br/>
                                {{$order_billing->address_1}} {{$order_billing->address_2}}<br/>
                                {{$order_billing->province_name}} {{$order_billing->district_name}} {{$order_billing->corregimiento_name}} {{$order->country_name}} {{$order_billing->zip_code}}<br/>
                                {{$order_billing->phone_number_1}}<br/>
                                {{$order_billing->phone_number_2}}<br/>
                                {{$order_billing->email}}<br/>
                            </li>
                        </ul>
                    </div>
                   

                </div><!--end of header 2-->
                <div class="row view-order-top">
                    <div class="col-md-6 left">
                        <ul>
                            <li>{{ __('general.page_header.payment_method') }}</li>
                            <li class="view-order-header-info">
                                <div class="container view-order-header-payment-info">
                                    @if($order->paymentHistories->count() > 0)
                                    <div class="row">
                                        <div class="col-md-5">{{__('general.payment_info.card')}}</div>
                                        <div class="col-md-7">...{{$order->paymentHistories->first()->credit_card_number}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">{{__('general.payment_info.type')}}</div>
                                        <div class="col-md-7">{{$order->paymentHistories->first()->credit_card_type}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">{{__('general.payment_info.date')}}</div>
                                        <div class="col-md-7">{{ date('Y-m-d',strtotime($order->paymentHistories->first()->created_at)) }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">{{__('general.payment_info.status')}}</div>
                                        <div class="col-md-7">{{$order->paymentHistories->first()->payment_status}}</div>
                                    </div>
                                    @else
                                    <div class="row">
                                        <div class="col-md-5">{{__('general.payment_info.payment_type')}}</div>
                                        <div class="col-md-7">{{$order->getPaymentType->name }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">{{__('general.payment_info.status')}}</div>
                                        <div class="col-md-7">{{$order->getStatusName->name }}</div>
                                    </div>
                                    @endif
                                </div>
                                
                            </li>
                        </ul>
                    </div>
                    
                    <div class="col-md-6 right">
                        <ul>
                            <li>{{ __('general.page_header.order_summary') }}</li>
                            <li class="view-order-header-info">

                                <div class="container view-order-header-total">
                                    <div class="row">
                                        <div class="col-md-7">{{ trans_choice('general.cart_title.item',1) }}(s) {{ __('general.cart_title.subtotal') }}</div>
                                        <div class="col-md-5">${{number_format($order->order_total,'2','.',',')}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7">{{ __('general.cart_title.shipping_handling') }}</div>
                                        <div class="col-md-5">${{number_format($order->order_shipping,'2','.',',')}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7">{{ __('general.cart_title.estimated_tax') }}</div>
                                        <div class="col-md-5">${{number_format($order->order_tax,'2','.',',')}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7">{{ __('general.cart_title.grand_total') }}</div>
                                        <div class="col-md-5">${{number_format($order->order_total + ($order->order_quantity * $order->order_total) + $order->order_shipping + $order->order_tax,'2','.',',')}}</div>
                                    </div>
                                </div>

                            </li>
                        </ul>
                    </div>
                </div><!--end of header 3-->
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
                                        <div class="col-md-8 col-lg-8">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-4 col-lg-4">
                                                        <img class="img-fluid" 
                                                        @if($product->getProduct->images->count()>0)
                                                        src="{{ asset('images/products') }}/{{ $product->getProduct->images->first()->img_url}}" alt="{{ $product->getProduct->images->first()->img_name }}"
                                                        @else
                                                        src="{{asset('images/no-image.jpg')}}" alt="no image" 
                                                        @endif
                                                        >
                                                    </div>
                                                    <div class="col-md-8 col-lg-8">
                                                        <strong><a href="{{ route('product_page',['product_id'=>$product->getProduct->id]) }}">{{ $product->getProduct->products_name }}</a></strong><br/>
                                                        {{ $product->getProduct->products_description }}<br/>
                                                        {{ __('general.cart_title.sell_by') }}:{{ $product->getProduct->vendor->first_name }} {{ $product->getProduct->vendor->last_name }}<br/>
                                                        {{ trans_choice('general.cart_title.quantity',1) }}:{{ $product->quantity }}<br/>
                                                        <span>${{ number_format($product->total,'2','.',',') }}</span>
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
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4">
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