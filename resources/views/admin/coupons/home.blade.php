@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-3">Code</div>
        <div class="col-md-2">Amt</div>
        <div class="col-md-2">Status</div>
        <div class="col-md-3">Action</div>
    </div>
    @foreach($main_items as $coupon)
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-3">{{$coupon->code}}</div>
        <div class="col-md-2">{{$coupon->discount}}&percnt;</div>
        <div class="col-md-2">{{ $coupon->getStatusName->name }}</div>
        <div class="col-md-3">
            <a href="{{ route('confirm_coupon',['coupon_id'=>$coupon->id])}}">delete</a>
            <a href="{{ route('edit_coupon',['coupon_id'=>$coupon->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection