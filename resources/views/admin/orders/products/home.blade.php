@extends('admin/layouts.app')
@section('content')
<div class="container">
    <form action="{{ route('admin_save_order_products',['order_id'=>$order->id]) }}" method="post">
    <div class="row">
        <div class="col text-right">
            <input class="admin-btn" type="submit" value="Save Product">
        </div>
    </div>
    <div class="row container-title">
        <div class="col-md-4">Description</div>
        <div class="col-md-2">Color</div>
        <div class="col-md-1">Size</div>
        <div class="col-md-1">Qty</div>
        <div class="col-md-1">Total</div>
        <div class="col-md-3">Status</div>
    </div>
    @foreach($order->products()->get() as $indexKey=>$order_product)
    <div class="row container-data row-even">
        <div class="col-md-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                    <img class="img-fluid" 
                    @if($order_product->getProduct->images->count()>0)
                    src="{{ asset('images/products')}}/{{ $order_product->getProduct->images->first()->img_url}}"
                    @else
                    src="{{asset('images/no-image.jpg')}}" 
                    @endif
                     alt />
                    </div>
                    <div class="col-md-7">
                    {{$order_product->getProduct->products_name}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">{{$order_product->getColor->name }}</div>
        <div class="col-md-1">{{$order_product->getSize->name }}</div>
        <div class="col-md-1">{{$order_product->quantity}}</div>
        <div class="col-md-1">{{$order_product->total}}</div>
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