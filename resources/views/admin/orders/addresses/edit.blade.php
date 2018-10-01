@extends('admin/layouts.app')
@section('content')
<form action="{{ route('admin_save_order_address') }}" method="post">
{{ csrf_field() }}
    <input type="hidden" name="order_id" value="{{ $order_id }}"/>
    <input type="hidden" name="address_type_id" value="{{ $address_type_id }}"/>
    
    <div class="form-row">
        <label for="addressName">Name:</label>
        <input type="text" id="addressName" class="form-control" name="name" value="{{ old('address_name')?old('address_name'):$address->name }}" placeholder="Name"/>
        <small class="error">{{$errors->first("address_name")}}</small>
    </div>
    <div class="form-group">
        <label for="addressEmail">Email:</label>
        <input type="email" id="addressEmail" class="form-control" name="email" value="{{ old('address_email')?old('address_email'):$address->email }}" placeholder="Email"/>
        <small class="error">{{$errors->first("address_email")}}</small>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="addressPhone1">Telephone 1:</label>
            <input type="text" id="addressPhone1" class="form-control" name="phone_number_1" value="{{ old('address_phone_number_1')?old('address_phone_number_1'):$address->phone_number_1 }}" placeholder="Phone 1"/>
            <small class="error">{{$errors->first("address_phone_number_1")}}</small>
        </div>
        <div class="form-group col-md-6">
            <label for="addressPhone2">Telephone 2:</label>
            <input type="text" id="addressPhone2" class="form-control" name="phone_number_2" value="{{ old('address_phone_number_2')?old('address_phone_number_2'):$address->phone_number_2 }}" placeholder="Phone 2"/>
            <small class="error">{{$errors->first("address_phone_number_2")}}</small>
        </div>
    </div>
    <div class="form-group">
        <label for="addressAddress1">Address 1:</label>
        <input type="text" id="addressAddress1" class="form-control" name="address_1" value="{{ old('address_address_1')?old('address_address_1'):$address->address_1 }}" placeholder="Address 1"/>
        <small class="error">{{$errors->first("address_address_1")}}</small>
    </div>
    <div class="form-group">
        <label for="addressAddress2">Address 2:</label>
        <input type="text" id="addressAddress2" class="form-control" name="address_2" value="{{ old('address_address_2')?old('address_address_2'):$address->address_2 }}" placeholder="Address 2"/>
        <small class="error">{{$errors->first("address_address_2")}}</small>
    </div>
    @include('includes.country_province_edit')

    <div class="container">
        <div class="row text-center">
            <div class="col-md-6">
                <a class="admin-new" href="{{ route('admin_edit_order',['order_id'=>$order->id]) }}">
                    Back To Product
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-new" value="Save {{$address_var}} Address"/>
            </div>
        </div>
    </div>
</form>
@endsection