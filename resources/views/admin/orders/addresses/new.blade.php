@extends('admin/layouts.app')
@section('content')
<style>
.admin-address-container{
    margin:20px 0px;
}
.admin-address-container .header h3{
    text-decoration:underline;
}
</style>
<div class="container">
    <div class="row">
        <div class="col">
            <a href="{{ route('admin_newaddress',['user_id'=>$user->id])}}">Add New Address</a>
        </div>
    </div>
</div>
<form action="{{ route('admin_create_new_order_address') }}" method="post">
{{ csrf_field() }}
    <div class="container admin-address-container">
        <div class="row">
            <div class="col header">
                <h3>Delivery Address</h3>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <select class="custom-select" name="shipping_list">
                        @foreach($shipping_lists as $shipping_list)
                        <option value="{{ $shipping_list->id }}">{{ $shipping_list->name }} - {{ $shipping_list->total }}</option>
                        @endforeach
                    </select>
                    <small class="error">{{$errors->first("address_2")}}</small>
                </div>
            </div>
        </div>
    </div>
    @foreach($address_types as $addressindex=>$address_type)
    <input type="hidden" name="addresses[{{$addressindex}}][address_type]" value="{{ $address_type->id }}"/>
    <div class="container admin-address-container">
        <div class="row">
            <div class="col header">
                <h3>{{ $address_type->name }} Address</h3>
            </div>
        </div>
        <div class="row">
            <div class="col">
                @if($user->getAddresses()->count() > 0)
                <div class="form-row">
                    <select class="custom-select" name="addresses[{{$addressindex}}][user_address_id]">
                        @foreach($user->getAddresses()->get() as $user_address)
                        <option value="{{ $user_address->id }}">{{ $user_address->nick_name }} - {{ $user_address->address_1 }} {{ $user_address->zip_code }}</option>
                        @endforeach
                    </select>
                </div>
                @else
                <div class="form-row">
                    <label for="addressName">Name:</label>
                    <input type="text" id="addressName" class="form-control" name="addresses[{{$addressindex}}][name]" value="{{ old('name') }}" placeholder="Name"/>
                    <small class="error">{{$errors->first("name")}}</small>
                </div>
                <div class="form-group">
                    <label for="addressEmail">Email:</label>
                    <input type="email" id="addressEmail" class="form-control" name="addresses[{{$addressindex}}][email]" value="{{ old('email') }}" placeholder="Email"/>
                    <small class="error">{{$errors->first("email")}}</small>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="addressPhone1">Telephone 1:</label>
                        <input type="text" id="addressPhone1" class="form-control" name="addresses[{{$addressindex}}][phone_number_1]" value="{{ old('phone_number_1') }}" placeholder="Phone 1"/>
                        <small class="error">{{$errors->first("phone_number_1")}}</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="addressPhone2">Telephone 2:</label>
                        <input type="text" id="addressPhone2" class="form-control" name="addresses[{{$addressindex}}][phone_number_2]" value="{{ old('phone_number_2') }}" placeholder="Phone 2"/>
                        <small class="error">{{$errors->first("phone_number_2")}}</small>
                    </div>
                </div>
                <div class="form-group">
                    <label for="addressAddress1">Address 1:</label>
                    <input type="text" id="addressAddress1" class="form-control" name="addresses[{{$addressindex}}][address_1]" value="{{ old('address_1')  }}" placeholder="Address 1"/>
                    <small class="error">{{$errors->first("address_1")}}</small>
                </div>
                <div class="form-group">
                    <label for="addressAddress2">Address 2:</label>
                    <input type="text" id="addressAddress2" class="form-control" name="addresses[{{$addressindex}}][address_2]" value="{{ old('address_2') }}" placeholder="Address 2"/>
                    <small class="error">{{$errors->first("address_2")}}</small>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="addressCity">City:</label>
                        <input type="text" id="addressCity" class="form-control" name="addresses[{{$addressindex}}][city]" value="{{ old('city') }}" placeholder="City"/>
                        <small class="error">{{$errors->first("city")}}</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="addressState">State:</label>
                        <input type="text" id="addressState" class="form-control" name="addresses[{{$addressindex}}][state]" value="{{ old('state') }}" placeholder="State"/>
                        <small class="error">{{$errors->first("state")}}</small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="addressCountry">Country:</label>
                        <select class="custom-select" name="addresses[{{$addressindex}}][country]" id="addressCountry">
                            <option value="">Select Country</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{$country->countryName}} </option>
                            @endforeach
                        </select>
                        <small class="error">{{$errors->first("country")}}</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="addressZip">Zip Code:</label>
                        <input type="text" id="addressZip" class="form-control" name="addresses[{{$addressindex}}][zip_code]" value="{{ old('zip_code') }}" placeholder="Zip Code"/>
                        <small class="error">{{$errors->first("zip_code")}}</small>
                    </div>
                </div>
                @endif
            </div><!--end of form cols-->
        </div>
    </div>

    
    @endforeach
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_new_order') }}">
                    Back To Product
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Proceed To Select Products"/>
            </div>
        </div>
    </div>
</form>
@endsection