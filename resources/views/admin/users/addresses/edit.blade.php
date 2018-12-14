@extends('admin/layouts.app')
@section('content')
<form action="{{ route('admin_updateaddress',['address_id'=>$address_id]) }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="addressNickName">NickName:</label>
        <input type="text" id="addressNickName" class="form-control" name="nick_name" value="{{ old('nick_name') ? old('nick_name') : $address->nick_name }}" placeholder="NickName"/>
        <small class="error">{{$errors->first("nick_name")}}</small>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="addressFirstName">First Name:</label>
            <input type="text" id="addressFirstName" class="form-control" name="first_name" value="{{ old('first_name') ? old('first_name') : $address->first_name }}" placeholder="First Name"/>
            <small class="error">{{$errors->first("first_name")}}</small>
        </div>
        <div class="form-group col-md-4">
            <label for="addressMiddleName">Middle Name:</label>
            <input type="text" id="addressMiddleName" class="form-control" name="middle_name" value="{{ old('middle_name') ? old('middle_name') : $address->middle_name }}" placeholder="Middle Name"/>
            <small class="error">{{$errors->first("middle_name")}}</small>
        </div>
        <div class="form-group col-md-4">
            <label for="addressLastName">Last Name:</label>
            <input type="text" id="addressLastName" class="form-control" name="last_name" value="{{ old('last_name') ? old('last_name') : $address->last_name }}" placeholder="Last Name"/>
            <small class="error">{{$errors->first("last_name")}}</small>
        </div>
    </div>
    <div class="form-group">
        <label for="addressEmail">Email:</label>
        <input type="email" id="addressEmail" class="form-control" name="email" value="{{ old('email') ? old('email') : $address->email }}" placeholder="Email"/>
        <small class="error">{{$errors->first("email")}}</small>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="addressPhone1">Telephone 1:</label>
            <input type="text" id="addressPhone1" class="form-control" name="phone_number_1" value="{{ old('phone_number_1') ? old('phone_number_1') : $address->phone_number_1 }}" placeholder="Phone 1"/>
            <small class="error">{{$errors->first("phone_number_1")}}</small>
        </div>
        <div class="form-group col-md-6">
            <label for="addressPhone2">Telephone 2:</label>
            <input type="text" id="addressPhone2" class="form-control" name="phone_number_2" value="{{ old('phone_number_2') ? old('phone_number_2') : $address->phone_number_2 }}" placeholder="Phone 2"/>
            <small class="error">{{$errors->first("phone_number_2")}}</small>
        </div>
    </div>
    <div class="form-group">
        <label for="addressAddress1">Address 1:</label>
        <input type="text" id="addressAddress1" class="form-control" name="address_1" value="{{ old('address_1') ? old('address_1') : $address->address_1 }}" placeholder="Address 1"/>
        <small class="error">{{$errors->first("address_1")}}</small>
    </div>
    <div class="form-group">
        <label for="addressAddress2">Address 2:</label>
        <input type="text" id="addressAddress2" class="form-control" name="address_2" value="{{ old('address_2') ? old('address_2') : $address->address_2 }}" placeholder="Address 2"/>
        <small class="error">{{$errors->first("address_2")}}</small>
    </div>
    @include('includes.country_province_edit')
    <div class="form-group">
        <label for="addressAddressType">Address Type:</label>
        <select class="custom-select" name="address_type" id="addressAddressType">
            <option value="">Select Address Type</option>
            @foreach($addresstypes as $addresstype)
                <option value="{{ $addresstype->id }}"
                @if($address->address_type==$addresstype->id)
                    selected="selected"
                @endif
                >{{$addresstype->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("address_type")}}</small>
    </div>
    <div class="form-group">
        <label for="addressStatus">Status:</label>
        <select class="custom-select" name="status" id="addressStatus">
            <option value="">Select Status</option>
            @foreach($statuses as $status)
                <option value="{{ $status->id }}"
                @if($address->status==$status->id)
                    selected="selected"
                @endif
                >{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    
    <div class="container">
        <div class="row form-btn-container">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_address',['user_id'=>$user_id]) }}">
                    Back To Addresses
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Save Address"/>
            </div>
        </div>
    </div>

</form>
@endsection