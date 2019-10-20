@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row container-title">
        <div class="col-md-1"></div>
        <div class="col-md-2">Name</div>
        <div class="col-md-2">Main</div>
        <div class="col-md-2">Total</div>
        <div class="col-md-2">Status</div>
        <div class="col-md-3">Action</div>
    </div>
    @foreach($deliveries as $delivery)
    <div class="row container-data row-even">
        <div class="col-md-1"><input  class="form-control" type="checkbox" name="delivery_ids[]" value="{{ $delivery->id }}"></div>
        <div class="col-md-2">{{$delivery->name}}</div>
        <div class="col-md-2">{{ $delivery->main ? 'Yes':'No'}}</div>
        <div class="col-md-2">{{$delivery->total}}</div>
        <div class="col-md-2">{{$delivery->getStatusName->name}}</div>
        <div class="col-md-3 container-button">
            <a href="{{ route('confirm_delete_product_delivery',['delivery_id'=>$delivery->id])}}">delete</a>
            <a href="{{ route('edit_product_delivery',['delivery_id'=>$delivery->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection