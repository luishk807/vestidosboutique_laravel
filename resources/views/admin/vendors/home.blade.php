@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row container-title">
        <div class="col-md-2"></div>
        <div class="col-md-3">Company Name</div>
        <div class="col-md-3">Name</div>
        <div class="col-md-2">Status</div>
        <div class="col-md-2">Action</div>
    </div>
    @foreach($main_items as $vendor)
    <div class="row container-data row-even">
        <div class="col-md-2"><input  class="form-control" type="checkbox" name="vendor_ids[]" value="{{ $vendor->id }}"></div>
        <div class="col-md-3">{{$vendor->company_name}}</div>
        <div class="col-md-3">{{$vendor->first_name}} {{$vendor->last_name}}</div>
        <div class="col-md-2">{{ $vendor->getStatusName->name }}</div>
        <div class="col-md-2 container-button">
            <a href="{{ route('confirm_vendor',['vendor_id'=>$vendor->id])}}">delete</a>
            <a href="{{ route('edit_vendor',['vendor_id'=>$vendor->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection