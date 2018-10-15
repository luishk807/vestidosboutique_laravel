@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center">
            <nav class="navbar navbar navbar-expand-lg">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('admin') }}" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="{{ route('edit_product',['product_id'=>$product_id]) }}" class="nav-link">Back to Edit</a></li>
                <li class="nav-item"><a href="{{ route('new_size',['product_id'=>$product_id]) }}" class="nav-link">Add Product Size</a></li>
                <li class="nav-item"><a href="{{ route('show_import_size',['product_id'=>$product_id]) }}" class="nav-link">Import Sizes</a></li>
            </ul>
            </nav>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-2">Color</div>
        <div class="col-md-2">Size</div>
        <div class="col-md-2">Stock</div>
        <div class="col-md-2">Status</div>
        <div class="col-md-2">Action</div>
    </div>
    @foreach($sizes as $size)
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-2">{{$size->color_name}}</div>
        <div class="col-md-2">{{$size->name}}</div>
        <div class="col-md-2">{{$size->stock}}</div>
        <div class="col-md-2">{{ $size->status_name }}</div>
        <div class="col-md-2">
            <a href="{{ route('confirm_size',['size_id'=>$size->id])}}">delete</a>
            <a href="{{ route('edit_size',['size_id'=>$size->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection