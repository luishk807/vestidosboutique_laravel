@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center">
            <nav class="navbar navbar navbar-expand-lg">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('new_order_products',['order_id'=>$order->id]) }}" class="nav-link">Add Products</a></li>
            </ul>
            </nav>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-3">Name</div>
        <div class="col-md-2">Quantity</div>
        <div class="col-md-2">Total</div>
        <div class="col-md-2">Status</div>
        <div class="col-md-2">Action</div>
    </div>
    @foreach($order->products()->get() as $order_product)
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-3">{{$order_product->getProduct->products_name}}</div>
        <div class="col-md-2">{{ $order_product->quantity }}</div>
        <div class="col-md-2">{{$order_product->getProduct->product_total}}</div>
        <div class="col-md-2">{{ $order_product->getStatusName->name }}</div>
        <div class="col-md-2">
            <a href="{{ route('confirm_order',['order_id'=>$order->id])}}">delete</a>
        </div>
    </div>
    @endforeach
</div>
@endsection