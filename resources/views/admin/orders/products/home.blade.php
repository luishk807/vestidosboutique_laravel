@extends('admin/layouts.app')
@section('content')
<div class="container">
    <form action="{{ route('admin_save_order_products',['order_id'=>$order->id]) }}" method="post">
    <div class="row">
        <div class="col text-right">
            <input class="admin-btn" type="submit" value="Save Product">
        </div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5">Description</div>
        <div class="col-md-1">Qty</div>
        <div class="col-md-2">Total</div>
        <div class="col-md-3">Status</div>
    </div>
    @foreach($order->products()->get() as $indexKey=>$order_product)
    <div class="row">
        <div class="col-md-1"><input type="checkbox" class="custom-checkbox" name="order_product[{{$indexKey}}][id]" value="{{ $order_product->id}}"></div>
        <div class="col-md-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                    <img class="img-fluid" src="{{ asset('images/products')}}/{{ $order_product->getProduct->images->first()->img_url}}" alt />
                    </div>
                    <div class="col-md-7">
                    {{$order_product->getProduct->products_name}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-1">{{$order_product->quantity}}</div>
        <div class="col-md-2">{{$order_product->total}}</div>
        <div class="col-md-3">
            <select name="order_product[{{$indexKey}}][status]">
                @foreach($statuses as $status)
                <option value="{{$status->id}}"
                    @if($order_product->status==$status->id)
                    selected=selected
                    @endif
                    >{{$status->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    @endforeach
    <div class="row">
        <div class="col text-right">
            <input class="admin-btn" type="submit" value="Save Product">
        </div>
    </div>
    </form>
</div>
@endsection