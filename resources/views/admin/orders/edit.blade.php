@extends('admin/layouts.app')
@section('content')
<form action="{{ route('edit_order',['order_id'=>$order_id]) }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="orderUser">User:</label>
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
        <label for="orderProduct">Product:</label>
        <select class="custom-select" name="product" id="orderProduct">
            <option value="">Select Product</option>
            @foreach($products as $product)
                <option value="{{ $product->id }}"
                @if($order->product_id==$product->id)
                    selected="selected"
                @endif
                >{{$product->products_name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("product")}}</small>
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
        <label for="orderShipAddress">Shipping Address:</label>
        <select class="custom-select" name="ship_address" id="orderShipAddress">
            <option value="">Select Shipping Address</option>
            @foreach($ship_addresses as $ship_address)
                <option value="{{ $ship_address->id }}"
                @if($order->ship_address_id==$ship_address->id)
                    selected="selected"
                @endif
                >{{$ship_address->nick_name}} [ {{ $ship_address->zip_code }} ] </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("ship_address")}}</small>
    </div>
    <div class="form-group">
        <label for="orderBillingAddress">Billing Address:</label>
        <select class="custom-select" name="bill_address" id="orderBillingAddress">
            <option value="">Select Billing Address</option>
            @foreach($bill_addresses as $bill_address)
                <option value="{{ $bill_address->id }}"
                @if($order->bill_address_id==$bill_address->id)
                    selected="selected"
                @endif
                >{{$bill_address->nick_name}} [ {{ $bill_address->zip_code }} ] </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("bill_address")}}</small>
    </div>

    <div class="form-group">
        <label for="orderTotal">Total:</label>
        <input type="number" id="orderTotal" class="form-control" name="order_total" min="0" step="0.01" value="{{ old('order_total') ? old('order_total') : $order->order_total }}" placeholder="0.00"/>
        <small class="error">{{$errors->first("order_total")}}</small>
    </div>
    <div class="form-group">
        <label for="orderQuantity">Quantity:</label>
        <input type="text" id="orderQuantity" class="form-control" name="order_quantity" value="{{ old('order_quantity') ? old('order_quantity') : $order->order_quantity }}" placeholder="Quantity"/>
        <small class="error">{{$errors->first("order_quantity")}}</small>
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