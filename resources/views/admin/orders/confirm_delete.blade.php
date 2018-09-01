@extends('admin/layouts.app')
@section('content')
<form action="{{ route('admin_delete_order',['order_id'=>$order->id])}}" method="post">
{{ method_field('DELETE') }}
<div class="container cancel-container">
    <div class="row">
        <div class="col text-center">
            <h3>&#60;&#60;&#60;&#60;Warning&#62;&#62;&#62;&#62;</h3><Br/>
            Unlike, cancelling an order, deleting an order will permantely delete order this order and its history.<br/><br/>
            Are you sure want to delete {{ $order->order_number }}<br/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_orders') }}">
                    Back To Orders
                </a>
        </div>
        <div class="col-md-6">
            <input type="submit" class="admin-btn" value="Delete Order"/>
        </div>
    </div>
</div>
</form>
@endsection