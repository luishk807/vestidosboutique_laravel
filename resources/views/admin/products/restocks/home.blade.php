@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-2">Model</div>
        <div class="col-md-2">Color</div>
        <div class="col-md-1">Size</div>
        <div class="col-md-1">Date</div>
        <div class="col-md-1">Quantity</div>
        <div class="col-md-2">Vendor</div>
        <div class="col-md-2"></div>
    </div>
    @foreach($restocks as $restock)
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-2">{{$restock->product->product_model}}</div>
        <div class="col-md-2">{{$restock->getColor->name}}</div>
        <div class="col-md-1">{{$restock->getSize->name}}</div>
        <div class="col-md-1">{{$restock->restock_date}}</div>
        <div class="col-md-1">{{$restock->quantity}}</div>
        <div class="col-md-2">{{ $restock->vendor->first_name }} {{ $restock->vendor->last_name }}</div>
        <div class="col-md-2">
            <a href="{{ route('confirm_restock',['restock_id'=>$restock->id])}}">delete</a>
            <a href="{{ route('edit_restock',['restock_id'=>$restock->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection