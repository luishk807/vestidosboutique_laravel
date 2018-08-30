@extends('admin/layouts.app')
@section('content')
<form action="{{ route('admin_delete_order',['order_id'=>$order->id])}}" method="post">
{{ method_field('DELETE') }}
<div class="container cancel-container">
    <div class="row">
        <div class="col text-center">
            are you sure want to delete {{ $order->order_number }}
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
    <div class="row">
        <div class="col-md-6">
                <a class="btn-block vesti_in_btn" href="{{ route('admin_orders') }}">
                    Back To Orders
                </a>
        </div>
        <div class="col-md-6">
            <input type="submit" class="btn-block vesti_in_btn" value="Delete Order"/>
        </div>
    </div>
</div>
</form>
@endsection