@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row container-title">
        <div class="col-md-1"></div>
        <div class="col-md-2">Name</div>
        <div class="col-md-2">Category</div>
        <div class="col-md-1">Status</div>
        <div class="col-md-2">Action</div>
    </div>
    @foreach($product_types as $product_type)
    <div class="row container-data row-even">
    <div class="col-md-1"><input  class="form-control" type="checkbox" name="product_type_ids[]" value="{{ $product_type->id }}"></div>
        <div class="col-md-2">{{$product_type->name}}</div>
        <div class="col-md-2"></div>
        <div class="col-md-1">{{ $product_type->getStatus->name }}</div>
        <div class="col-md-2 container-button">
             <a href="{{ route('confirm_product_type',['product_type_id'=>$product_type->id])}}">delete</a>
            <a href="{{ route('edit_product_type',['product_type_id'=>$product_type->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection