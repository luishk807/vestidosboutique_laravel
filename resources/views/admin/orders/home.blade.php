@extends('admin/layouts.app')
@section('content')
<style>
.admin_orders_row{
    margin-bottom:20px;
}
.order_action_label span:not(:first-child){
    border-left:1px solid rgba(0,0,0,.1);
    padding-left:5px;
}
.order_admin_header{
    background-color:#ddd;
}
.order_admin_grid{
    border-left:1px #ddd solid;
    border-right:1px #ddd solid;
    border-bottom:1px #ddd solid;
    padding:10px 0px;
}
</style>
<div class="container">
    <div class="row">
        <div class="col text-center">
            <nav class="navbar navbar navbar-expand-lg">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('admin_new_order') }}" class="nav-link">Add Order</a></li>
            </ul>
            </nav>
            
        </div>
    </div>
    <!--start of orders-->
    @foreach($orders as $order)
    <div class="row admin_orders_row">
        <div class="col">
            <div class="row py-3 order_admin_header">
                <div class="col">
                    <div class="row">
                        <div class="col-md-2">Client</div>
                        <div class="col-md-2">Order Placed</div>
                        <div class="col-md-2">Total</div>
                        <div class="col-md-2">Ship To</div>
                        <div class="col-md-4 text-right">Order Number:{{$order->order_number}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">{{$order->client->getFullName()}}</div>
                        <div class="col-md-2">{{$order->purchase_date}}</div>
                        <div class="col-md-2">${{$order->order_total}}</div>
                        <div class="col-md-2">{{ $order->shipping_zip_code }}</div>
                        <div class="col-md-4 order_action_label text-right">
                            <!--actions go here-->
                            <span><a href="{{ route('admin_confirm_order',['order_id'=>$order->id])}}">delete</a></span>
                            <span><a href="{{ route('admin_edit_order',['order_id'=>$order->id])}}">edit</a></span>
                        </div>
                    </div>
                </div>
            </div><!--end of row for order header-->
            <!--starts list of products-->
            @foreach($order->products()->get() as $order_product)
            <!--product info-->
            <div class="row order_admin_grid">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col">
                            <!--delivered date-->
                            {{ $order->getStatusName->name }}
                            @if($order->status==3 || $order->status==12)
                                {{$order->delivered_date}}
                            @elseif($order->status==10)
                                {{$order->shipped_date}}
                            @elseif($order->status==2)
                                {{$order->cancelled_date}}
                            @endif
                            <!--noticed if product was dilvered-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <!--image-->
                                    <img class="img-fluid" src="

                                    @if($order_product->getProduct->images->count())
                                    {{asset('images/products')}}/{{$order_product->getProduct->images->first()->img_url}}
                                    @else
                                    {{asset('images/no-image.jpg')}}
                                    @endif
                                    "/>
                                </div>
                                <div class="col">
                                    <!--product info-->
                                    <h4>{{$order_product->getProduct->products_name}}</h4><br/>
                                    <small>by {{$order_product->getProduct->getBrand->name}}</small><br/>
                                    <small>{{$order_product->getProduct->product_model}}</small><br/>
                                    {{$order_product->getProduct->product_detail}}<br/>
                                    {{$order_product->getProduct->total_rent}}<br/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="col-md-2">
                    <!--buttons for actions-->
                    <a href="{{ route('admin_confirm_order',['order_id'=>$order->id])}}" class="btn-block vesti_in_btn">Remove</a>
                    <!--remove-->
                </div>
            </div>
            <!--end of product info-->
            @endforeach
            <!--end of list of products-->
        </div>
    </div><!--end of order detail-->
    @endforeach
    <!--end of row orders-->


</div>
@endsection