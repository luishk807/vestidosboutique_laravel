@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center">
            <nav class="navbar navbar navbar-expand-lg">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="{{ route('admin_orders') }}" class="nav-link">Back to Orders</a></li>
                    <li class="nav-item"><a href="{{ route('admin_order_products',['order_id'=>$order_id]) }}" class="nav-link">[{{ $order->products()->count()}}] View products</a></li>
                </ul>
            </nav>
            
        </div>
    </div>
</div>
<form action="{{ route('admin_edit_order',['order_id'=>$order_id]) }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="orderUser">Client:</label>
        <select class="custom-select" name="user" id="orderUser">
            <option value="">Select User</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}"
                @if($order->user_id==$user->id)
                    selected="selected"
                @endif
                >{{$user->getFullName()}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("user")}}</small>
    </div>
    <div class="form-group">
        <label for="orderDoo">Date of Purchase:</label>
        <input type="date" id="orderDoo" min="1950-01-01" class="form-control" name="purchase_date" value="{{ old('purchase_date') ? old('purchase_date') : $order->purchase_date }}" placeholder="Date of Purchase"/>
        <small class="error">{{$errors->first("purchase_date")}}</small>
    </div>
    <div class="form-group">
        <label for="orderDos">Date of Shipping:</label>
        <input type="date" id="orderDos" min="1950-01-01" class="form-control" name="shipping_date" value="{{ old('shipping_date') ? old('shipping_date') : $order->shipping_date }}" placeholder="Date of Shipping"/>
        <small class="error">{{$errors->first("shipping_date")}}</small>
    </div>
    <div class="form-group">
        <label for="orderShipAddress">Shipping Method:</label>
        <select class="custom-select" name="shipping_method" id="orderShipAddress">
            <option value="">Select Shipping Address</option>
            @foreach($shipping_lists as $shipping_info)
                <option value="{{ $shipping_info->id }}"
                @if($order->order_shipping_type==$shipping_info->id)
                    selected="selected"
                @endif
                >{{ $shipping_info->total}} - {{ $shipping_info->name}} [ {{ $shipping_info->description }} ] </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("shipping_method")}}</small>
    </div>
    <div class="form-group">
        <label for="orderTotal">Total:</label>
        <input type="number" id="orderTotal" class="form-control" name="order_total" min="0" step="0.01" value="{{ old('order_total') ? old('order_total') : $order->order_total }}" placeholder="0.00"/>
        <small class="error">{{$errors->first("order_total")}}</small>
    </div>
    <div class="form-group">
        <label for="orderTax">Total Tax:</label>
        <input type="number" id="orderTax" class="form-control" name="order_tax" min="0" step="0.01" value="{{ old('order_tax') ? old('order_tax') : $order->order_tax }}" placeholder="0.00"/>
        <small class="error">{{$errors->first("order_tax")}}</small>
    </div>
    <div class="form-group">
        <label for="orderShipping">Total Shipping:</label>
        <input type="number" id="orderShipping" class="form-control" name="order_shipping" min="0" step="0.01" value="{{ old('order_shipping') ? old('order_shipping') : $order->order_shipping }}" placeholder="0.00"/>
        <small class="error">{{$errors->first("order_shipping")}}</small>
    </div>
    <div class="form-group">
        <label for="orderStatus">Status:</label>
        <select class="custom-select" name="status" id="orderStatus">
            <option value="">Select Status</option>
            @foreach($statuses as $status)
                <option value="{{ $status->id }}"
                @if($order->status==$status->id)
                    selected="selected"
                @endif
                >{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a class="btn-block vesti_in_btn" href="{{ route('admin_orders') }}">
                    Back To Orders
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="btn-block vesti_in_btn" value="Save Order"/>
            </div>
        </div>
    </div>

</form>
@endsection