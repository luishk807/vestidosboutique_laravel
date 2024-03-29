@extends('admin/layouts.app')
@section('content')
<form action="{{ route('admin_cancel_order',['order_id'=>$order->id])}}" method="post">
{{ method_field('DELETE') }}
<div class="container cancel-container">
    <div class="row">
        <div class="col text-center">
            are you sure want to cancel {{ $order->order_number }}
        </div>
    </div>
    <div class="row">
        <div class="col text-center">
            <label class="cancelReasonSelect" for="cancelRason">Please choose reason for cancellation:</label>
            <select class="custom-select cancelReasonSelect" name="cancel_reason" id="cancelRason">
                @foreach($cancel_reasons as $cancel_reason)
                    <option value="{{$cancel_reason->id}}">{{$cancel_reason->name}}</option>
                @endforeach
            </select>
            <small class="error">{{$errors->first("cancel_reason")}}</small>
        </div>
    </div>
    <div class="row form-btn-container">
        <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_orders') }}">
                    Back To Orders
                </a>
        </div>
        <div class="col-md-6">
            <input type="submit" class="admin-btn" value="Cancel Order"/>
        </div>
    </div>
</div>
</form>
@endsection