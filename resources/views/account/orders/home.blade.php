@extends("layouts.sub-layout-account")
@section('content')
<div class="container container-in-space white-md-bg-in">
    <div class="row">
        <div class="col">
            <h2>{{$page_title}}</h2>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <P>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vehicula eros vitae lorem finibus faucibus. Morbi vitae blandit diam, id interdum risus. Cras sodales felis augue, efficitur suscipit magna aliquet at. 
            </P>
        </div>
    </div>
    <div class="container order-container">

        <div class="row">
            <div class="col order-nav-list">
                    <ul>
                        @if(!empty($orders->previousPageUrl()))
                        <li><a href="{{ $orders->previousPageUrl()}}">&lt; {{ __('pagination.previous') }}</a></li>
                        @endif
                        <li>{{ $orders->currentPage()}} {{ __('pagination.of') }} {{ $orders->count() }}</li>
                        @if($orders->nextPageUrl())
                        <li><a href="{{ $orders->nextPageUrl() }}">{{ __('pagination.next') }} &gt;</a></li>
                        @endif
                    </ul>

            </div>
        </div>
        @foreach($orders as $order)
        <div class="row orders-main-col">
            <div class="container order-container-in">
                <div class="row order-first-row text-center">
                    <div class="col-md-6 col-lg-3 col-sm-10 header">
                        <p>{{ __('general.dates_title.date_ordered') }}</p>
                        <p>{{$order->purchase_date}}</p>
                    </div>
                    <div class="col-md-6 col-lg-2 col-sm-10 header">
                        <p>
                            {{ trans_choice('general.cart_title.total',1) }}
                        </p>
                        <p>${{ number_format($order->order_total,'2','.',',') }}</p>
                    </div>
                    <div class="col-md-6  col-lg-3 col-sm-10 header">
                        <p>
                            {{ __('general.page_header.shipping_address') }}
                        </p>
                        <p><a href="">...{{$order->shipping_zip_code}}</a></p>
                    </div>
                    <div class="col-md-6  col-lg-4 col-sm-10 header">
                        <p>
                            {{ trans_choice('general.cart_title.order',1) }} #:{{$order->order_number}}
                        </p>
                        <p><a href="{{ route('view_order',['order_id'=>$order->id]) }}">{{ __('buttons.order_detail') }}</a></p>
                    </div>
                </div><!---end of order header-->
                <div class="row order-product-status">
                    <div class="col td">
                        {{$order->getStatusName->name}} 
                        @if(empty($order->cancel_reason) && $order->status != 3 )
                            &nbsp; &nbsp; &lbrack;<a href="{{ route('confirm_order_cancel',['order_id'=>$order->id])}}">{{ __('buttons.order_cancel') }}</a>&rbrack;
                        @endif
                    </div>
                </div>
                <!--list of products-->
                @foreach($order->products as $product)
                <div class="row order-products">
                    <div class="col-md-8 col-lg-8 col-sm-10 order-product-info">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('product_page',['product_id'=>$product->product_id])}}"><img class="img-fluid" src="
                                    @if($product->getProduct->images->count()>0)
                                    {{asset('images/products')}}/{{$product->getProduct->images->first()->img_url}}
                                    @else
                                    {{asset('images/no-image.jpg')}}
                                    @endif
                                    "/></a>
                                </div>
                                <div class="col">
                                    <a class="product-title" href="{{ route('product_page',['product_id'=>$product->product_id])}}">{{ $product->getProduct->products_name}}</a><br/>
                                    <span class="product-subtitle">{{ __('general.product_title.model_id') }}</span>: {{ $product->getProduct->product_model}}<br/>
                                    <span class="product-subtitle">{{ __('general.cart_title.sell_by') }}</span>: {{ $product->getProduct->vendor->getFullVendorName()}}<br/>
                                    <span class="product-subtitle">{{ trans_choice('general.cart_title.quantity',1) }}</span>: {{ $product->quantity}}<br/>
                                    <span class="product-total">${{number_format($product->getProduct->total_rent,'2','.',',')}}
                                    </span>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-10 order-product-actions">
                    
                        @if(!$product->getProduct->is_rated())
                        <div class="vesti_in_user_btn_pnl">
                            <a class="btn-block vesti_in_btn_b" href="{{ route('user_new_review',['product'=>$product->product_id])}}">{{ __('buttons.write_review') }}</a>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
                <!--end of list of products-->
            </div>
        </div><!--product list ends-->
        @endforeach

        <div class="row">
            <div class="col order-nav-list">
                    <ul>
                        @if(!empty($orders->previousPageUrl()))
                        <li><a href="{{ $orders->previousPageUrl()}}">&lt; {{ __('pagination.previous') }}</a></li>
                        @endif
                        <li>{{ $orders->currentPage()}} {{ __('pagination.of') }} {{ $orders->count() }}</li>
                        @if($orders->nextPageUrl())
                        <li><a href="{{ $orders->nextPageUrl() }}">{{ __('pagination.next') }} &gt;</a></li>
                        @endif
                    </ul>

            </div>
        </div>



    </div>
</div><!--end of main container-->
@endsection