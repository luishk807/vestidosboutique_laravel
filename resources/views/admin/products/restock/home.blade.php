@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center">
            <nav class="navbar navbar navbar-expand-lg">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('admin') }}" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="{{ route('edit_product',['product_id'=>$product_id]) }}" class="nav-link">Back to Edit</a></li>
                <li class="nav-item"><a href="{{ route('new_size',['product_id'=>$product_id]) }}" class="nav-link">Add Restock Data</a></li>
            </ul>
            </nav>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-3">Date</div>
        <div class="col-md-2">Quantity</div>
        <div class="col-md-2">Vendor</div>
        <div class="col-md-3"></div>
    </div>
    @foreach($restocks as $restock)
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-3">{{$restock->restock_date}}</div>
        <div class="col-md-2">{{$restock->quantity}}</div>
        <div class="col-md-2">{{ $restock->vendor->first_name }} {{ $restock->vendor->last_name }}</div>
        <div class="col-md-3">
            <a href="{{ route('confirm_restock',['restock_id'=>$restock->id])}}">delete</a>
            <a href="{{ route('edit_restock',['restock_id'=>$restock->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection