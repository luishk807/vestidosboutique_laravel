@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center">
            <nav class="navbar navbar navbar-expand-lg">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('admin') }}" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="{{ route('edit_product',['product_id'=>$product_id]) }}" class="nav-link">Back to Edit</a></li>
                <li class="nav-item"><a href="{{ route('new_rate',['product_id'=>$product_id]) }}" class="nav-link">Add Product Rate</a></li>
            </ul>
            </nav>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-3">Name</div>
        <div class="col-md-2">Rate</div>
        <div class="col-md-3">Status</div>
        <div class="col-md-3">Action</div>
    </div>
    @foreach($rates as $rate)
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-3">{{$rate->user->getFullName()}}</div>
        <div class="col-md-2"><div class='rate-view' data-rate-value="{{$rate->user_rate}}"></div></div>
        <div class="col-md-3">{{ $rate->getStatusName->name }}</div>
        <div class="col-md-3">
            <a href="{{ route('confirm_rate',['rate_id'=>$rate->id])}}">delete</a>
            <a href="{{ route('edit_rate',['rate_id'=>$rate->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection