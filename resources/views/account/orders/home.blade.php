@extends("layouts.sub-layout-account")
@section('content')
<style>
.order-nav-list{
    text-align:right;
}
.order-nav-list ul{
    list-style-type: none;
    margin: 0px;
    padding: 0px;
    
}
.order-nav-list li{

    display: inline-block;
    padding: 5px;
}





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
.view-order-main td,
.view-order-main th{
    border-top:none !important;
    border-bottom:none !important;
}
.account-container,
.view-order-main,
.view-order-main td{
    padding:0px;
}
.view-order-header-info td{
    padding: 6px 10px;
    font-size: .8rem;
    font-family: Arial;
}
.view-order-header-info td:nth-child(2){
    text-align:center;
}
.view-order-header-total tr:first-child td{
    border-top:none !important;
}
.view-order-header-total td:nth-child(1),
.view-order-header-total th:nth-child(1){
    text-align:left;
}
.view-order-header-total td:nth-child(2),
.view-order-header-total th:nth-child(2){
    text-align:right;
}
.view-order-top,
.view-order-items,
.view-order-header-total{
    background-color:white !important;
}

.view-order-top-list{
    list-style-type: none;
    margin: 0px;
    padding: 0px;
}
.view-order-top-list li{
    float: left;
padding: 5px 10px;
font-weight:bold;

}
.view-order-top-list li:not(:first-child){
    border-left:1px solid rgba(0,0,0,.1)
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
/* cancel confirm */
.cancel-container .row{
  margin:20px 0px;
}
.cancel-container .row h3{
  font-size:1.5rem;
}
.cancel-container .row:last-child{
  margin-top:40px;
}



/* ACCOUNT ORDER */
.result-mg{
  text-align: center;
  font-weight: bold;
  font-size: 1rem;
}
.result-mg.success{
  color: green;
}
.result-mg.error{
  color: red;
}
.order-product-status{
    margin:10px 0px;
}
.order-product-status .td{
  background-color:white;
  font-weight:bold;
  font-size:1rem;
}
.orders-main-col{
padding:0px !important;
}
.order-container{
padding:0px;
width:100%;
}
.order-container .td{
border-top:none;
}
.order-container .order-products{
    padding:10px;
}
.order-container .order-products:not(:first-child){
border-top:1px solid rgba(0,0,0,.1);
}
.order-container .order-products table,
.order-container .order-products td{
background-color:white;
}
.order-container .order-container-in{
border: 1px solid rgba(0,0,0,.1);
margin-top:30px;
}
.order-container .order-container-in .order-first-row{
border-bottom: 1px solid rgba(0,0,0,.1);
background-color:#f5f8fa;
padding:10px 0px;
}
.order-container .order-container-in .order-first-row .header:nth-child(2) p{
padding: .1rem .75rem;
}
.order-container .order-container-in .order-first-row .header:nth-child(1) p{
padding-bottom: .2rem;
}

.order-container .order-products .order-product-info .product-subtitle{
font-size: .75rem;
}
.order-container .order-products .order-product-info .product-total{
color:red;
}
.order-container .order-products .order-product-info .product-title{
font-size:1.2rem;
color:black;
font-weight:bold;
text-decoration:none;
}
.order-container .order-products .order-product-info .product-title:hover{
text-decoration:underline;
}
</style>
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
                        <li>{{ $orders->currentPage()}} of {{ $orders->count() }}</li>
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
                    <div class="col-md-3 col-lg-3 col-sm-10 header">
                        <p>{{ __('general.dates_title.date_ordered') }}</p>
                        <p>{{$order->purchase_date}}</p>
                    </div>
                    <div class="col-md-1 col-lg-2 col-sm-10 header">
                        <p>
                            {{ trans_choice('general.cart_title.total',1) }}
                        </p>
                        <p>${{ number_format($order->order_total,'2','.',',') }}</p>
                    </div>
                    <div class="col-md-3  col-lg-3 col-sm-10 header">
                        <p>
                            {{ __('general.page_header.shipping_address') }}
                        </p>
                        <p><a href="">...{{$order->shipping_zip_code}}</a></p>
                    </div>
                    <div class="col-md-3  col-lg-4 col-sm-10 header">
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
                        <li>{{ $orders->currentPage()}} of {{ $orders->count() }}</li>
                        @if($orders->nextPageUrl())
                        <li><a href="{{ $orders->nextPageUrl() }}">{{ __('pagination.next') }} &gt;</a></li>
                        @endif
                    </ul>

            </div>
        </div>



    </div>
</div><!--end of main container-->
@endsection