@extends('admin/layouts.app')
@section('content')
<style>
.confirm-data-row{
    border-top:1px solid rgba(0,0,0,.1);
    margin:5px 0px;
    padding:10px 0px;
}
.confirm-data-key{
    font-size:1.2rem;
}
</style>
<div class="container">
    <div class="row">
        <div class="col text-center">
            <strong>Please confirm the data.  Uncheck undesired data.</strong>
        </div>
    </div>
</div>
<form action="{{ route('save_import_vendor_confirm') }}" method="post">
{{ csrf_field() }}
    <div class="container">
        @foreach($data_confirm as $indexKey=>$vendor)
        <div class="row confirm-data-row">
            <div class="col-md-1">
                <span class="confirm-data-key">{{ 1+ $indexKey }}&#46;</span>&nbsp;<input type="checkbox" checked name="vendor_confirm[{{$indexKey}}][key]" id="productcheck{{$indexKey}}" value="{{ $indexKey }}"/>
            </div>
            <div class="col-md-11">
                <div class="container">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="vendorFirstName">First Name:</label>
                            <input type="text" id="vendorFirstName" class="form-control" name="vendor_confirm[{{$indexKey}}][first_name]" value="{{ $vendor['first_name'] }}" placeholder="First Name"/>
                            <small class="error">{{$errors->first("first_name")}}</small>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="vendorMiddleName">Middle Name:</label>
                            <input type="text" id="vendorMiddleName" class="form-control" name="vendor_confirm[{{$indexKey}}][middle_name]" value="{{ $vendor['middle_name'] }}" placeholder="Middle Name"/>
                            <small class="error">{{$errors->first("middle_name")}}</small>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="vendorLastName">Last Name:</label>
                            <input type="text" id="vendorLastName" class="form-control" name="vendor_confirm[{{$indexKey}}][last_name]" value="{{ $vendor['last_name'] }}" placeholder="Last Name"/>
                            <small class="error">{{$errors->first("last_name")}}</small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="vendorPhone1">Telephone 1:</label>
                            <input type="text" id="vendorPhone1" class="form-control" name="vendor_confirm[{{$indexKey}}][phone_number_1]" value="{{ $vendor['phone_number_1'] }}" placeholder="Phone 1"/>
                            <small class="error">{{$errors->first("phone_number_1")}}</small>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="vendorPhone2">Telephone 2:</label>
                            <input type="text" id="vendorPhone2" class="form-control" name="vendor_confirm[{{$indexKey}}][phone_number_2]" value="{{ $vendor['phone_number_2'] }}" placeholder="Phone 2"/>
                            <small class="error">{{$errors->first("phone_number_2")}}</small>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="vendorEmail">Email:</label>
                            <input type="text" id="vendorEmail" class="form-control" name="vendor_confirm[{{$indexKey}}][email]" value="{{ $vendor['email'] }}" placeholder="Email"/>
                            <small class="error">{{$errors->first("email")}}</small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="vendorAddress1">Address 1:</label>
                            <input type="text" id="vendorAddress1" class="form-control" name="vendor_confirm[{{$indexKey}}][address_1]" value="{{ $vendor['address_1'] }}" placeholder="Address 1"/>
                            <small class="error">{{$errors->first("address_1")}}</small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="vendorAddress2">Address 2:</label>
                            <input type="text" id="vendorAddress2" class="form-control" name="vendor_confirm[{{$indexKey}}][address_2]" value="{{ $vendor['address_2'] }}" placeholder="Address 2"/>
                            <small class="error">{{$errors->first("address_2")}}</small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="vendorCity">City:</label>
                            <input type="text" id="vendorCity" class="form-control" name="vendor_confirm[{{$indexKey}}][city]" value="{{ $vendor['city'] }}" placeholder="City"/>
                            <small class="error">{{$errors->first("city")}}</small>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="vendorState">State:</label>
                            <input type="text" id="vendorState" class="form-control" name="vendor_confirm[{{$indexKey}}][state]" value="{{ $vendor['state'] }}" placeholder="State"/>
                            <small class="error">{{$errors->first("state")}}</small>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="vendorCountry">Country:</label>
                            <select class="custom-select" name="vendor_confirm[{{$indexKey}}][country]" id="vendorCountry">
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}"
                                    @if($vendor['country_id']==$country->id)
                                        selected="selected"
                                    @endif
                                    >{{$country->countryName}} </option>
                                @endforeach
                            </select>
                            <small class="error">{{$errors->first("country")}}</small>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="vendorZip">Zip Code:</label>
                            <input type="text" id="vendorZip" class="form-control" name="vendor_confirm[{{$indexKey}}][zip_code]" value="{{ $vendor['zip_code'] }}" placeholder="Zip Code"/>
                            <small class="error">{{$errors->first("zip_code")}}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="container">
        <div class="row text-center">
            <div class="col-md-6">
                <a href="{{ route('show_import_vendor') }}" class="admin-btn">Back To Import</a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Confirm Import"/>
            </div>
        </div>
    </div>
</form>
@endsection