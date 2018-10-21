@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center">
            <nav class="navbar navbar navbar-expand-lg">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('new_product_type') }}" class="nav-link">Add Product Type</a></li>
                <li class="nav-item"><a href="{{ route('show_import_product_type') }}" class="nav-link">Import Product Types</a></li>
            </ul>
            </nav>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-2">Name</div>
        <div class="col-md-2">Category</div>
        <div class="col-md-1">Status</div>
        <div class="col-md-2">Action</div>
    </div>
    @foreach($product_types as $product_type)
    <div class="row">
    <div class="col-md-1"></div>
        <div class="col-md-2">{{$product_type->name}}</div>
        <div class="col-md-2">{{$product_type->getCategory->name}}</div>
        <div class="col-md-1">{{ $product_type->getStatus->name }}</div>
        <div class="col-md-2">
             <a href="{{ route('confirm_product_type',['product_type_id'=>$product_type->id])}}">delete</a>
            <a href="{{ route('edit_product_type',['product_type_id'=>$product_type->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection