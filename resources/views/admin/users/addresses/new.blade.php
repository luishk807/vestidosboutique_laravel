@extends('admin/layouts.app')
@section('content')

<form action="{{ route('admin_createaddress',['user_id'=>$user_id]) }}" method="post">
{{ csrf_field() }}
<div class="form-row">
        <div class="form-group col-md-4">
            <label for="addressFirstName">First Name:</label>
            <input type="text" id="addressFirstName" class="form-control" name="first_name" value="" placeholder="First Name"/>
            <small class="error">{{$errors->first("first_name")}}</small>
        </div>
        <div class="form-group col-md-4">
            <label for="addressMiddleName">Middle Name:</label>
            <input type="text" id="addressMiddleName" class="form-control" name="middle_name" value="" placeholder="Middle Name"/>
            <small class="error">{{$errors->first("middle_name")}}</small>
        </div>
        <div class="form-group col-md-4">
            <label for="addressLastName">Last Name:</label>
            <input type="text" id="addressLastName" class="form-control" name="last_name" value="" placeholder="Last Name"/>
            <small class="error">{{$errors->first("last_name")}}</small>
        </div>
    </div>
    <div class="form-group">
        <label for="addressEmail">Email:</label>
        <input type="text" id="addressEmail" class="form-control" name="email" value="" placeholder="Email"/>
        <small class="error">{{$errors->first("email")}}</small>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="addressPhone1">Telephone 1:</label>
            <input type="text" id="addressPhone1" class="form-control" name="phone_number_1" value="" placeholder="Phone 1"/>
            <small class="error">{{$errors->first("phone_number_1")}}</small>
        </div>
        <div class="form-group col-md-6">
            <label for="addressPhone2">Telephone 2:</label>
            <input type="text" id="addressPhone2" class="form-control" name="phone_number_2" value="" placeholder="Phone 2"/>
            <small class="error">{{$errors->first("phone_number_2")}}</small>
        </div>
    </div>
    <div class="form-group">
        <label for="addressAddress1">Address 1:</label>
        <input type="text" id="addressAddress1" class="form-control" name="address_1" value="" placeholder="Address 1"/>
        <small class="error">{{$errors->first("address_1")}}</small>
    </div>
    <div class="form-group">
        <label for="addressAddress2">Address 2:</label>
        <input type="text" id="addressAddress2" class="form-control" name="address_2" value="" placeholder="Address 2"/>
        <small class="error">{{$errors->first("address_2")}}</small>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="addressCity">City:</label>
            <input type="text" id="addressCity" class="form-control" name="city" value="" placeholder="City"/>
            <small class="error">{{$errors->first("city")}}</small>
        </div>
        <div class="form-group col-md-6">
            <label for="addressState">State:</label>
            <input type="text" id="addressState" class="form-control" name="state" value="" placeholder="State"/>
            <small class="error">{{$errors->first("state")}}</small>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="addressCountry">Country:</label>
            <select class="custom-select" name="country" id="addressCountry">
                <option value="">Select Country</option>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}">{{$country->countryName}} </option>
                @endforeach
            </select>
            <small class="error">{{$errors->first("country")}}</small>
        </div>
        <div class="form-group col-md-6">
            <label for="addressZip">Zip Code:</label>
            <input type="text" id="addressZip" class="form-control" name="zip_code" value="" placeholder="Zip Code"/>
            <small class="error">{{$errors->first("zip_code")}}</small>
        </div>
    </div>
    <div class="form-group">
        <label for="addressAddressType">Address Type:</label>
        <select class="custom-select" name="address_type" id="addressAddressType">
            <option value="">Select Address Type</option>
            @foreach($addresstypes as $addresstype)
                <option value="{{ $addresstype->id }}">{{$addresstype->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("address_type")}}</small>
    </div>
    <div class="form-group">
        <label for="addressStatus">Status:</label>
        <select class="custom-select" name="status" id="addressStatus">
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
                <a class="btn-block vesti_in_btn" href="{{ route('admin_address',['user_id'=>$user_id]) }}">
                    Back To Brands
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="btn-block vesti_in_btn" value="Create Address"/>
            </div>
        </div>
    </div>
</form>
@endsection