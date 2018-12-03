@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row container-title">
        <div class="col-md-2"></div>
        <div class="col-md-2">Name</div>
        <div class="col-md-2">Total</div>
        <div class="col-md-2">Description</div>
        <div class="col-md-2">Status</div>
        <div class="col-md-2">Action</div>
    </div>
    @foreach($shipping_lists as $shipping_list)
    <div class="row container-data row-even">
        <div class="col-md-2"><input  class="form-control" type="checkbox" name="shipping_list_ids[]" value="{{ $shipping_list->id }}"></div>
        <div class="col-md-2">{{$shipping_list->name}}</div>
        <div class="col-md-2">{{$shipping_list->total}}</div>
        <div class="col-md-2">{{$shipping_list->description}}</div>
        <div class="col-md-2">{{$shipping_list->getStatusName->name }}</div>
        <div class="col-md-2 container-button">
            <a href="{{ route('confirm_shipping_list',['shipping_list_id'=>$shipping_list->id])}}">delete</a>
            <a href="{{ route('edit_shipping_list',['shipping_list_id'=>$shipping_list->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection