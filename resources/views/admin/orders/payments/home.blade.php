@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-1 text-center"></div>
        <div class="col-md-2 text-center">By</div>
        <div class="col-md-2 text-center">Method</div>
        <div class="col-md-2 text-center">Total</div>
        <div class="col-md-2 text-center">Status</div>
        <div class="col-md-2 text-center">Date</div>
        <div class="col-md-1 text-center">Action</div>
    </div>
    @foreach($main_items as $payment)
    <div class="row container-data row-even">
        <div class="col-md-1 text-center"><input  class="form-control" type="checkbox" name="payment_ids[]" value="{{ $payment->id }}"/></div>
        <div class="col-md-2 text-center">{{ $payment->getUser->first_name }} {{ $payment->getUser->last_name }}</div>
        <div class="col-md-2 text-center">{{ $payment->payment_method }}</div>
        <div class="col-md-2 text-center">{{ $payment->total }}</div>
        <div class="col-md-2 text-center">{{ $payment->payment_status ? $payment->payment_status : 'Completed' }}</div>
        <div class="col-md-2 text-center">{{ date('M d, Y', strtotime($payment->created_at)) }}</div>
        <div class="col-md-1 text-center">
            <a href="{{ route('confirm_admin_order_payment',['payment_id'=>$payment->id])}}">delete</a>
        </div>
    </div>
    @endforeach
</div>
@endsection