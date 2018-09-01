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
    <div class="row">
        <div class="col text-center">
            <nav class="navbar navbar navbar-expand-lg">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <div class="text-left order-address-panels">
                            <p><span class="title">Shipping Address</span> [<a href="{{ route('admin_edit_order_address',['order_id'=>$order->id,'address_type_id'=>1]) }}">Edit</a>]</p>
                            {{$order->shipping_name}}<br/>
                            {{$order->shipping_address_1}} {{$order->shipping_address_2}}<br/>
                            {{$order->shipping_city}}, {{$order->shipping_state}} {{$order->shipping_country}} {{$order->shipping_zip_code}}<br/>
                            <br/>
                            Email: {{$order->shipping_email}}<br/>
                            Phone 1:{{$order->shipping_phone_number_1}}<br/>
                            Phone 2:{{$order->shipping_phone_number_2}}
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="text-left order-address-panels">
                            <p><span class="title">Billing Address</span> [<a href="{{ route('admin_edit_order_address',['order_id'=>$order->id,'address_type_id'=>2]) }}">Edit</a>]</p>
                            {{$order->billing_name}}<br/>
                            {{$order->billing_address_1}} {{$order->billing_address_2}}<br/>
                            {{$order->billing_city}}, {{$order->billing_state}} {{$order->billing_country}} {{$order->billing_zip_code}}<br/>
                            <br/>
                            Email: {{$order->billing_email}}<br/>
                            Phone 1:{{$order->billing_phone_number_1}}<br/>
                            Phone 2:{{$order->billing_phone_number_2}}
                        </div>
                    </li>
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
    <div class="form-group">
        <label for="orderRefund">Total Refund:</label>
        <input type="number" id="orderRefund" class="form-control" name="order_total_refund" min="0" step="0.01" value="{{ $order->order_total_refund }}" placeholder="0.00"/>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_orders') }}">
                    Back To Orders
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Save Order"/>
            </div>
        </div>
    </div>

</form>
@endsection