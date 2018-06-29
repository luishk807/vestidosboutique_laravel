@extends('admin/layouts.app')
@section('content')
<script>
$(document).ready(function(){
    $("#orderUser").change(function(){
         $.ajax({
            type: "GET",
            url: "{{ url('api/addressDropDown') }}",
            data: {
                data:$(this).val()
            },
            success: function(data) {
                var orderShipAddress = $("#orderShipAddress");
                var orderBillingAddress = $("#orderBillingAddress");
                orderShipAddress.empty();
                orderBillingAddress.empty();
                orderShipAddress.append("<option value=''>Select Shipping Address</option>");
                orderBillingAddress.append("<option value=''>Select Billing Address</option>");
                $.each(data, function(index,element){
                    console.log(index+" and "+element);
                    orderShipAddress.append("<option value='"+element.id+"'>"+element.nick_name+" [ "+element.zip_code+" ]</option>");
                    orderBillingAddress.append("<option value='"+element.id+"'>"+element.nick_name+" [ "+element.zip_code+" ]</option>");
                });
                console.log("THISS",data);
            }
        });

        
    });
});
</script>
<form action="{{ route('create_order') }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="orderUser">User:</label>
        <select class="custom-select" name="user" id="orderUser">
            <option value="">Select User</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{$user->getFullName()}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("user")}}</small>
    </div>
    <div class="form-group">
        <label for="orderProduct">Product:</label>
        <select class="custom-select" name="product" id="orderProduct">
            <option value="">Select Product</option>
            @foreach($products as $product)
                <option value="{{ $product->id }}">{{$product->products_name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("product")}}</small>
    </div>
    <div class="form-group">
        <label for="orderDoo">Date of Purchase:</label>
        <input type="date" id="orderDoo" min="1950-01-01" class="form-control" name="purchase_date" value="{{ old('purchase_date')}}" placeholder="Date of Purchase"/>
        <small class="error">{{$errors->first("purchase_date")}}</small>
    </div>
    <div class="form-group">
        <label for="orderDos">Date of Shipping:</label>
        <input type="date" id="orderDos" min="1950-01-01" class="form-control" name="shipping_date" value="{{ old('shipping_date')}}" placeholder="Date of Shipping"/>
        <small class="error">{{$errors->first("shipping_date")}}</small>
    </div>
    <div class="form-group">
        <label for="orderShipAddress">Shipping Address:</label>
        <select class="custom-select" name="ship_address" id="orderShipAddress">
            <option value="">Select Shipping Address</option>
        </select>
        <small class="error">{{$errors->first("ship_address")}}</small>
    </div>
    <div class="form-group">
        <label for="orderBillingAddress">Billing Address:</label>
        <select class="custom-select" name="billing_address" id="orderBillingAddress">
            <option value="">Select Billing Address</option>
        </select>
        <small class="error">{{$errors->first("bill_address")}}</small>
    </div>

    <div class="form-group">
        <label for="orderTotal">Total:</label>
        <input type="number" id="orderTotal" class="form-control" name="order_total" min="0" step="0.01" value="" placeholder="0.00"/>
        <small class="error">{{$errors->first("order_total")}}</small>
    </div>
    <div class="form-group">
        <label for="orderQuantity">Quantity:</label>
        <input type="text" id="orderQuantity" class="form-control" name="order_quantity" value="" placeholder="Quantity"/>
        <small class="error">{{$errors->first("order_quantity")}}</small>
    </div>
    <div class="form-group">
        <label for="orderTax">Total Tax:</label>
        <input type="number" id="orderTax" class="form-control" name="order_tax" min="0" step="0.01" value="" placeholder="0.00"/>
        <small class="error">{{$errors->first("order_tax")}}</small>
    </div>
    <div class="form-group">
        <label for="orderShipping">Total Shipping:</label>
        <input type="number" id="orderShipping" class="form-control" name="order_shipping" min="0" step="0.01" value="" placeholder="0.00"/>
        <small class="error">{{$errors->first("order_shipping")}}</small>
    </div>


    <div class="form-group">
        <label for="orderStatus">Status:</label>
        <select class="custom-select" name="status" id="orderStatus">
            <option value="">Select Status</option>
            @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{$status->name}} </option>
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
                <input type="submit" class="btn-block vesti_in_btn" value="Create Order"/>
            </div>
        </div>
    </div>
</form>
@endsection