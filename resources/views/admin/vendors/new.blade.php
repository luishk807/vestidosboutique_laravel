@extends('admin/layouts.app')
@section('content')
<form action="{{ route('create_vendor') }}" method="post">
{{ csrf_field() }}
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="vendorCompany">Company Name:</label>
            <input type="text" id="vendorCompany" class="form-control" name="company_name" value="" placeholder="Company Name"/>
            <small class="error">{{$errors->first("company_name")}}</small>
        </div>
        <div class="form-group col-md-4">
            <label for="vendorFirstName">First Name:</label>
            <input type="text" id="vendorFirstName" class="form-control" name="first_name" value="" placeholder="First Name"/>
            <small class="error">{{$errors->first("first_name")}}</small>
        </div>
        <div class="form-group col-md-4">
            <label for="vendorMiddleName">Middle Name:</label>
            <input type="text" id="vendorMiddleName" class="form-control" name="middle_name" value="" placeholder="Middle Name"/>
            <small class="error">{{$errors->first("middle_name")}}</small>
        </div>
        <div class="form-group col-md-4">
            <label for="vendorLastName">Last Name:</label>
            <input type="text" id="vendorLastName" class="form-control" name="last_name" value="" placeholder="Last Name"/>
            <small class="error">{{$errors->first("last_name")}}</small>
        </div>
    </div>
    <div class="form-group">
        <label for="vendorEmail">Email:</label>
        <input type="text" id="vendorEmail" class="form-control" name="email" value="" placeholder="Email"/>
        <small class="error">{{$errors->first("email")}}</small>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="vendorPhone1">Telephone 1:</label>
            <input type="text" id="vendorPhone1" class="form-control" name="phone_number_1" value="" placeholder="Phone 1"/>
            <small class="error">{{$errors->first("phone_number_1")}}</small>
        </div>
        <div class="form-group col-md-6">
            <label for="vendorPhone2">Telephone 2:</label>
            <input type="text" id="vendorPhone2" class="form-control" name="phone_number_2" value="" placeholder="Phone 2"/>
            <small class="error">{{$errors->first("phone_number_2")}}</small>
        </div>
    </div>
    <div class="form-group">
        <label for="vendorAddress1">Address 1:</label>
        <input type="text" id="vendorAddress1" class="form-control" name="address_1" value="" placeholder="Address 1"/>
        <small class="error">{{$errors->first("address_1")}}</small>
    </div>
    <div class="form-group">
        <label for="vendorAddress2">Address 2:</label>
        <input type="text" id="vendorAddress2" class="form-control" name="address_2" value="" placeholder="Address 2"/>
        <small class="error">{{$errors->first("address_2")}}</small>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="vendorCity">City:</label>
            <input type="text" id="vendorCity" class="form-control" name="city" value="" placeholder="City"/>
            <small class="error">{{$errors->first("city")}}</small>
        </div>
        <div class="form-group col-md-6">
            <label for="vendorState">State:</label>
            <input type="text" id="vendorState" class="form-control" name="state" value="" placeholder="State"/>
            <small class="error">{{$errors->first("state")}}</small>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="vendorCountry">Country:</label>
            <select class="custom-select" name="country" id="vendorCountry">
                <option value="">Select Country</option>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}">{{$country->countryName}} </option>
                @endforeach
            </select>
            <small class="error">{{$errors->first("country")}}</small>
        </div>
        <div class="form-group col-md-6">
            <label for="vendorZip">Zip Code:</label>
            <input type="text" id="vendorZip" class="form-control" name="zip_code" value="" placeholder="Zip Code"/>
            <small class="error">{{$errors->first("zip_code")}}</small>
        </div>
    </div>
    <div class="form-group">
        <label for="vendorStatus">Status:</label>
        <select class="custom-select" name="status" id="vendorStatus">
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
                <a class="admin-btn" href="{{ route('admin_vendors') }}">
                    Back To Vendors
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Create Vendor"/>
            </div>
        </div>
    </div>
</form>
@endsection