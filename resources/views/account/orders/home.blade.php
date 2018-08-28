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

    <table class="table orders">
        <tbody>
            <tr>
                <td>
                    <div class="order-nav-list">
                        <ul>
                            @if(!empty($orders->previousPageUrl()))
                            <li><a href="{{ $orders->previousPageUrl()}}">&lt; Back</a></li>
                            @endif
                            <li>{{ $orders->currentPage()}} of {{ $orders->count() }}</li>
                            @if($orders->nextPageUrl())
                            <li><a href="{{ $orders->nextPageUrl() }}">Next &gt;</a></li>
                            @endif
                        </ul>
                    </div><!--end of nav container-->
                </td>
            </tr><!--end of navigator-->
            <tr>
                <td class="col orders-main-col">
                    @foreach($orders as $order)
                    <!--product list begins-->
                    <table class="table order-container-in">
                        <tbody>
                            <tr class="order-first-row">
                                <td>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Order Placed</td>
                                                <td>Total</td>
                                                <td>Ship To</td>
                                                <td>Order #:{{$order->order_number}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{$order->purchase_date}}</td>
                                                <td>${{ number_format($order->order_total,'2','.',',') }}</td>
                                                <td><a href="">...{{$order->shipping_zip_code}}</a></td>
                                                <td><a href="{{ route('view_order',['order_id'=>$order->id]) }}">Order Detail</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr class="order-product-status">
                                <td>{{$order->getStatusName->name}} 
                                @if(empty($order->cancel_reason))
                                &nbsp; &nbsp; &lbrack;<a href="{{ route('confirm_order_cancel',['order_id'=>$order->id])}}">Cancel Order</a>&rbrack;
                                @endif
                                </td>
                            </tr>
                            <!--list all products of order-->
                            @foreach($order->products as $product)
                            <tr class="order-products">
                                <td>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="order-product-info">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td width="40%">
                                                                <a href="{{ route('product_page',['product_id'=>$product->product_id])}}"><img class="img-fluid" src="
                                                                @if($product->getProduct->images->count()>0)
                                                                {{asset('images/products')}}/{{$product->getProduct->images->first()->img_url}}
                                                                @else
                                                                {{asset('images/no-image.jpg')}}
                                                                @endif
                                                                "/></a>
                                                                </td>
                                                                <td width="60%">
                                                                    <a class="product-title" href="{{ route('product_page',['product_id'=>$product->product_id])}}">{{ $product->getProduct->products_name}}</a><br/>
                                                                    <span class="product-subtitle">Model No.</span>: {{ $product->getProduct->product_model}}<br/>
                                                                    <span class="product-subtitle">By</span>: {{ $product->getProduct->vendor->getFullVendorName()}}<br/>
                                                                    <span class="product-subtitle">Quantity</span>: {{ $product->quantity}}<br/>
                                                                    <span class="product-total">${{number_format($product->getProduct->total_rent,'2','.',',')}}
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                
                                                </td>
                                                <td class="order-product-actions">
                                                    <div class="vesti_in_user_btn_pnl">
                                                        <a class="btn-block vesti_in_btn_b" href="{{ route('user_new_review',['product'=>$product->product_id])}}">Write Review</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            @endforeach
                            <!--end list of product of orders-->
                        </tbody>
                    </table>
                    @endforeach
                    <!--product list ends-->
                </td>
            </tr>
            <tr>
                <td>
                    <div class="order-nav-list">
                        <ul>
                            @if(!empty($orders->previousPageUrl()))
                            <li><a href="{{ $orders->previousPageUrl()}}">&lt; Back</a></li>
                            @endif
                            <li>{{ $orders->currentPage()}} of {{ $orders->count() }}</li>
                            @if($orders->nextPageUrl())
                            <li><a href="{{ $orders->nextPageUrl() }}">Next &gt;</a></li>
                            @endif
                        </ul>
                    </div><!--end of nav container-->
                </td>
            </tr><!--end of navigator-->
        </tbody>
    </table>

    </div>
</div><!--end of main container-->
@endsection