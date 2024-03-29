@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row container-title">
        <div class="col-md-2"></div>
        <div class="col-md-2">Color</div>
        <div class="col-md-1">Size</div>
        <div class="col-md-1">Sale</div>
        <div class="col-md-1">Rent</div>
        <div class="col-md-1">Stock</div>
        <div class="col-md-2">Status</div>
        <div class="col-md-2">Action</div>
    </div>
    @foreach($main_items as $size)
    <div class="row container-data row-even">
        <div class="col-md-2"><input  class="form-control" type="checkbox" name="size_ids[]" value="{{ $size->id }}"></div>
        <div class="col-md-2">{{$size->color_name}}</div>
        <div class="col-md-1">{{$size->name}}</div>
        <div class="col-md-1">{{$size->total_sale}}</div>
        <div class="col-md-1">{{$size->total_rent}}</div>
        <div class="col-md-1">{{$size->stock}}</div>
        <div class="col-md-2">{{ $size->status_name }}</div>
        <div class="col-md-2 container-button">
            <a href="{{ route('confirm_size',['size_id'=>$size->id])}}">delete</a>
            <a href="{{ route('edit_size',['size_id'=>$size->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection