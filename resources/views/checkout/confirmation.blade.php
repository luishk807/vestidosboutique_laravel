@extends("layouts.sub-layout")
@section('content')
<style>

</style>
<div class="main_sub_body main_body_height">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-9 container-in-center">
            <div>
               <div class="container-in-space">
                        <!--content-->
                        <div class="row">
                            <div class="col checkout-header">
                                <ul>
                                @foreach($checkout_menus as $checkoutKey=>$checkout_menu)
                                    @if($checkout_menu["name"]==$checkout_header_key)
                                    <li class="active">
                                        <div class="checkout-arrow-down"></div>
                                    @else
                                    <li>
                                    @endif
                                    @if($checkout_menu_prev_link && $checkout_menu["name"]==$checkout_header_key)
                                    <a href="{{ $checkout_menu_prev_link }}">
                                        {{$checkoutKey+1}}. {{$checkout_menu["name"]}}
                                    </a>
                                    @else
                                        {{$checkoutKey+1}}. {{$checkout_menu["name"]}}
                                    @endif
                                    </li>
                                @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-md-12 text-center">
                               <span id="session_msg" class="error">
                               @if(count($errors) > 0)
                                    @foreach ($errors->all() as $error)
                                    {{ $error }}<br/>
                                    @endforeach
                                @endif
                               </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7 checkout-confirm-info-cont">
                                <!--start of confirm container-->
                                <div class="container">
                                    <div class="row">
                                        <div class="col checkout-subtitle-confirm">
                                            {{$page_title}}
                                        </div>
                                    </div>
                                    <div class="row checkout-status-confirm">
                                        <div class="col-12 col-lg-4 col-md-6 col-sm-12">
                                            <img src="{{ asset('images') }}/{{ $thankyou_img }}" class="vesti-svg vestidos-icons-confirm-b"/>

                                        </div>
                                        <div class="col-12 col-lg-8 col-md-6 col-sm-12 checkout-confirm-text">
                                            {{ $thankyou_msg }}
                                        </div>
                                    </div>
                                    @if($thankyou_status)
                                    <div class="row">
                                        <div class="col">
                                            <div class="container checkout-confirm-order-details">
                                                <!--order header-->
                                                <div class="row header1">
                                                    <div class="col">
                                                        {{ trans_choice('general.cart_title.order',1)}}: {{$last_order->order_number}}
                                                    </div>
                                                </div>
                                                <div class="row header2">
                                                    <div class="col">
                                                        {{ __('general.cart_title.subtotal') }}
                                                    </div>
                                                    <div class="col">
                                                        ${{number_format($last_order->order_total,'2','.',',')}}
                                                    </div>
                                                </div>
                                                <div class="row header2">
                                                    <div class="col">
                                                        {{ __('general.product_title.tax') }}
                                                    </div>
                                                    <div class="col">
                                                        ${{number_format($last_order->order_tax,'2','.',',')}}
                                                    </div>
                                                </div>
                                                <div class="row header2">
                                                    <div class="col">
                                                        {{ __('general.cart_title.shipping') }}
                                                    </div>
                                                    <div class="col">
                                                        ${{number_format($last_order->order_shipping,'2','.',',')}}
                                                    </div>
                                                </div>
                                                <div class="row header3">
                                                    <div class="col">
                                                        {{ __('general.cart_title.grand_total') }}
                                                    </div>
                                                    <div class="col">
                                                        ${{number_format($last_order->order_tax,'2','.',',')}}
                                                    </div>
                                                </div>
                                                <!--end of header-->
                                                <!--listing products-->
                                                @foreach($last_order->products as $product)
                                                <div class="row checkout-confirm-order-details-data">
                                                    <div class="col-lg-2">
                                                            <img class="img-fluid" 
                                                            @if($product->getProduct->images->count()>0)
                                                            src="{{ asset('/images/products') }}/{{ $product->getProduct->images->first()->img_url }}"
                                                            @else
                                                            src="{{asset('images/no-image.jpg')}}" 
                                                            @endif
                                                             alt width="100%"/>
                                                    </div>
                                                    <div class="col-lg-7">
                                                        <span class="title">{{$product->getProduct->products_name}}</span><br/>
                                                        {{ __('general.vendor') }}:{{ $product->getProduct->vendor->first_name." ".$product->getProduct->vendor->last_name}}
                                                    </div>
                                                    <div class="col-lg-3">
                                                        ${{number_format($product->getProduct->total_rent,'2','.',',')}}
                                                    </div>
                                                </div>
                                                @endforeach
                                                <!--end of listing-->
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div><!--end of confirm container-->
                            </div><!--end of form-->
                        </div>
                        <div class="row">
                            <div class="col-md-4 checkout-btn-pnl">
                                <a class="btn-block vesti_in_btn_oval checkout_next" href="{{ route('home_page') }}"/>{{$checkout_btn_name}}</a>
                            </div>
                        </div>
                        <!--end of content-->
               </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection