@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center">
            <nav class="navbar navbar navbar-expand-lg">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('new_order') }}" class="nav-link">Add Order</a></li>
            </ul>
            </nav>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-2">Name</div>
        <div class="col-md-2">Order Date</div>
        <div class="col-md-2">Ship Date</div>
        <div class="col-md-2">Grand Total</div>
        <div class="col-md-1">Status</div>
        <div class="col-md-2">Action</div>
    </div>
    @foreach($orders as $order)
    <div class="row">

        <div class="col-md-1"></div>
        <div class="col-md-2">{{$order->client->getFullName()}}</div>
        <div class="col-md-2">{{$order->purchase_date}}</div>
        <div class="col-md-2">{{$order->shipping_date}}</div>
        <div class="col-md-2">{{ $order->order_quantity * $order->order_total }}</div>
        <div class="col-md-1">{{ $order->getStatusName->name }}</div>
        <div class="col-md-2">
            <a href="{{ route('confirm_order',['order_id'=>$order->id])}}">delete</a>
            <a href="{{ route('edit_order',['order_id'=>$order->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection