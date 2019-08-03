@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row container-title">
        <div class="col-md-1"></div>
        <div class="col-md-3">Name</div>
        <div class="col-md-2">Description</div>
        <div class="col-md-2">Card?</div>
        <div class="col-md-2">Status</div>
        <div class="col-md-2">Action</div>
    </div>
    @foreach($main_items as $payment_type)
    <div class="row container-data row-even">
        <div class="col-md-1"><input  class="form-control" type="checkbox" name="payment_types_ids[]" value="{{ $payment_type->id }}"></div>
        <div class="col-md-3">{{$payment_type->name}}</div>
        <div class="col-md-2">{{$payment_type->description}}</div>
        <div class="col-md-2">{{$payment_type->is_credit_card ? 'Yes':'No'}}</div>
        <div class="col-md-2">{{$payment_type->getStatusName->name }}</div>
        <div class="col-md-2 container-button">
            <a href="{{ route('confirm_payment',['payment_id'=>$payment_type->id])}}">delete</a>
            <a href="{{ route('edit_payment',['payment_id'=>$payment_type->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection