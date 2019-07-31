@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row container-title">
        <div class="col-md-2"></div>
        <div class="col-md-3">Country</div>
        <div class="col-md-2">Name</div>
        <div class="col-md-2">Tax</div>
        <div class="col-md-3">Status</div>
    </div>
    @foreach($taxes as $tax)
    <div class="row container-data row-even">
        <div class="col-md-2"></div>
        <div class="col-md-3">{{$tax->getCountry->name}}/div>
        <div class="col-md-2">{{$tax->code}}</div>
        <div class="col-md-2">{{$tax->tax}}</div>
        <div class="col-md-3 container-button">
            <a href="{{ route('confirm_delete_tax',['tax_id'=>$tax->id])}}">delete</a>
            <a href="{{ route('edit_tax',['tax_id'=>$tax->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection