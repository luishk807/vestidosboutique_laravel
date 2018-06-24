@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center">
        <h1>{{$page_title}}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col text-center">
            <nav class="navbar navbar navbar-expand-lg">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('admin') }}" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="{{ route('new_product') }}" class="nav-link">Add Product</a></li>
            </ul>
            </nav>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4">Name</div>
        <div class="col-md-3">Status</div>
        <div class="col-md-3">Action</div>
    </div>
    @foreach($products as $product)
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4">{{$product->name}}</div>
        <div class="col-md-3">{{ $product->getStatusName->name }}</div>
        <div class="col-md-3">
            <a href="{{ route('confirm_product',['product_id'=>$product->id])}}">delete</a>
            <a href="{{ route('edit_product',['product_id'=>$product->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection