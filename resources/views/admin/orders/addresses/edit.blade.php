@extends('admin/layouts.app')
@section('content')
<form action="{{ route('admin_save_order_address',['order_id'=>$order->id]) }}" method="post">
{{ csrf_field() }}
    <input type="hidden" name="address_type" value="{{ $address_type }}"/>
    <div class="form-row">
        <label for="addressName">Name:</label>
        <input type="text" id="addressName" class="form-control" name="address_name" value="{{ old('name')?old('name'):$address_name }}" placeholder="Name"/>
        <small class="error">{{$errors->first("address_name")}}</small>
    </div>
    <div class="form-group">
        <label for="addressEmail">Email:</label>
        <input type="email" id="addressEmail" class="form-control" name="address_email" value="{{ old('email') }}" placeholder="Email"/>
        <small class="error">{{$errors->first("address_email")}}</small>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="addressPhone1">Telephone 1:</label>
            <input type="text" id="addressPhone1" class="form-control" name="address_phone_number_1" value="{{ old('phone_number_1') }}" placeholder="Phone 1"/>
            <small class="error">{{$errors->first("address_phone_number_1")}}</small>
        </div>
        <div class="form-group col-md-6">
            <label for="addressPhone2">Telephone 2:</label>
            <input type="text" id="addressPhone2" class="form-control" name="address_phone_number_2" value="{{ old('phone_number_2') }}" placeholder="Phone 2"/>
            <small class="error">{{$errors->first("address_phone_number_2")}}</small>
        </div>
    </div>
    <div class="form-group">
        <label for="addressAddress1">Address 1:</label>
        <input type="text" id="addressAddress1" class="form-control" name="address_address_1" value="{{ old('address_1')  }}" placeholder="Address 1"/>
        <small class="error">{{$errors->first("address_address_1")}}</small>
    </div>
    <div class="form-group">
        <label for="addressAddress2">Address 2:</label>
        <input type="text" id="addressAddress2" class="form-control" name="address_address_2" value="{{ old('address_2') }}" placeholder="Address 2"/>
        <small class="error">{{$errors->first("address_address_2")}}</small>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="addressCity">City:</label>
            <input type="text" id="addressCity" class="form-control" name="address_city" value="{{ old('city') }}" placeholder="City"/>
            <small class="error">{{$errors->first("address_city")}}</small>
        </div>
        <div class="form-group col-md-6">
            <label for="addressState">State:</label>
            <input type="text" id="addressState" class="form-control" name="address_state" value="{{ old('state') }}" placeholder="State"/>
            <small class="error">{{$errors->first("address_state")}}</small>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="addressCountry">Country:</label>
            <select class="custom-select" name="address_country" id="addressCountry">
                <option value="">Select Country</option>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}">{{$country->countryName}} </option>
                @endforeach
            </select>
            <small class="error">{{$errors->first("address_country")}}</small>
        </div>
        <div class="form-group col-md-6">
            <label for="addressZip">Zip Code:</label>
            <input type="text" id="addressZip" class="form-control" name="address_zip_code" value="{{ old('zip_code') }}" placeholder="Zip Code"/>
            <small class="error">{{$errors->first("address_zip_code")}}</small>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a class="btn-block vesti_in_btn" href="{{ route('admin_edit_order',['order_id'=>$order->id]) }}">
                    Back To Product
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="btn-block vesti_in_btn" value="Save Address"/>
            </div>
        </div>
    </div>
</form>
@endsection