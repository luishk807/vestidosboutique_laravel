@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center">
            <nav class="navbar navbar navbar-expand-lg">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('new_product') }}" class="nav-link">Add Product</a></li>
            </ul>
            </nav>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-2">Image</div>
        <div class="col-md-3">Name</div>
        <div class="col-md-1">Brand</div>
        <div class="col-md-1">Stock</div>
        <div class="col-md-1">Category</div>
        <div class="col-md-1">Status</div>
        <div class="col-md-2">Action</div>
    </div>
    @foreach($products as $product)
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-2"><img src="
        @if(!is_null($product->images))
            {{asset('images/products')}}/{{$product->images->first()->img_url}}
        @endif
        " class="img-fluid"/></div>
        <div class="col-md-3">{{$product->products_name}}</div>
        <div class="col-md-1">{{$product->getBrand->name }}</div>
        <div class="col-md-1">{{$product->product_stock > 0 ? "In Stock" : "Out of Stock"}}</div>
        <div class="col-md-1">{{$product->getCategory->name}}</div>
        <div class="col-md-1">{{ $product->getStatus->name }}</div>
        <div class="col-md-2">
            <a href="{{ route('confirm_product',['product_id'=>$product->id])}}">delete</a>
            <a href="{{ route('edit_product',['product_id'=>$product->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection