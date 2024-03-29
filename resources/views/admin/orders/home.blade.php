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

    <!--start of orders-->
    @foreach($main_items as $order)
    <div class="row admin_orders_row">
        <div class="col-md-1"><input  class="form-control" type="checkbox" name="order_ids[]" value="{{ $order->id }}"></div>
        <div class="col-md-11">
            <div class="row py-3 order_admin_header">
                <div class="col">
                    <div class="row">
                        <div class="col-md-2">Client</div>
                        <div class="col-md-2">Order Placed</div>
                        <div class="col-md-2">Total</div>
                        <div class="col-md-2">Payment Type</div>
                        <div class="col-md-4 text-right">Order Number:{{$order->order_number}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"><a href="{{ route('admin_edituser',['user_id'=>$order->client->id])}}">{{$order->client->getFullName()}}</a></div>
                        <div class="col-md-2">{{date('m-d-Y', strtotime($order->purchase_date))}}</div>
                        <div class="col-md-2">${{ ($order->order_total + $order->order_tax + $order->order_shipping) - $order->order_discount }}</div>
                        <div class="col-md-2">{{ $order->getPaymentType->name }}</div>
                        <div class="col-md-4 order_action_label text-right">
                            <!--actions go here-->
                            <span><a href="{{ route('admin_confirm_delete_order',['order_id'=>$order->id])}}">Delete</a></span>
                            <span><a href="{{ route('admin_confirm_order',['order_id'=>$order->id])}}">Cancel</a></span>
                            <span><a href="{{ route('admin_edit_order',['order_id'=>$order->id])}}">Edit</a></span>
                        </div>
                    </div>
                </div>
            </div><!--end of row for order header-->
            <div class="row order_admin_grid">
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
            <div class="row order_admin_grid">
                <div class="col">
                    <!--amount paid-->
                    @php($amount_due = (($order->order_total + $order->order_tax) - $order->order_discount) - $order->paymentHistories->sum('total'))
                    <b>Amount Due: <span class="
                    @if($amount_due > 0)
                    text-danger
                    @else
                    text-success
                    @endif
                    ">${{ number_format($amount_due,2) }}</span></b> 
                </div>
            </div>
            <!--starts list of products-->
            @foreach($order->products()->get() as $order_product)
            <!--product info-->
            <div class="row order_admin_grid">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-3">
                            <!--image-->
                            <img class="img-fluid" src="

                            @if($order_product->getProduct->images->count())
                            {{asset('images/products')}}/{{$order_product->getProduct->images->first()->img_url}}
                            @else
                            {{asset('images/no-image.jpg')}}
                            @endif
                            "/>
                        </div>
                        <div class="col-md-9">
                            <!--product info-->
                            <h4>{{$order_product->getProduct->products_name}}</h4><br/>
                            <small>by {{$order_product->getProduct->getBrand->name}}</small><br/>
                            <small>{{$order_product->getProduct->product_model}}</small><br/>
                            {{$order_product->getProduct->product_detail}}<br/><br/>
                            Quantity:{{$order_product->quantity}}<br/>
                            Total:{{$order_product->getSize->total_sale}}<br/>
                            Color Name: {{$order_product->getColor->name}}<br/>
                            Size: {{$order_product->getSize->name}}<br/>
                        </div>
                    </div>
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