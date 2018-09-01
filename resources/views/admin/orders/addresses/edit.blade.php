@extends('admin/layouts.app')
@section('content')
<form action="{{ route('admin_save_order_address') }}" method="post">
{{ csrf_field() }}
    <input type="hidden" name="order_id" value="{{ $order_id }}"/>
    <input type="hidden" name="address_type_id" value="{{ $address_type_id }}"/>
    
    <div class="form-row">
        <label for="addressName">Name:</label>
        <input type="text" id="addressName" class="form-control" name="address_name" value="{{ old('address_name')?old('address_name'):$order_address_name }}" placeholder="Name"/>
        <small class="error">{{$errors->first("address_name")}}</small>
    </div>
    <div class="form-group">
        <label for="addressEmail">Email:</label>
        <input type="email" id="addressEmail" class="form-control" name="address_email" value="{{ old('address_email')?old('address_email'):$order_address_email }}" placeholder="Email"/>
        <small class="error">{{$errors->first("address_email")}}</small>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="addressPhone1">Telephone 1:</label>
            <input type="text" id="addressPhone1" class="form-control" name="address_phone_number_1" value="{{ old('address_phone_number_1')?old('address_phone_number_1'):$order_address_phone_number_1 }}" placeholder="Phone 1"/>
            <small class="error">{{$errors->first("address_phone_number_1")}}</small>
        </div>
        <div class="form-group col-md-6">
            <label for="addressPhone2">Telephone 2:</label>
            <input type="text" id="addressPhone2" class="form-control" name="address_phone_number_2" value="{{ old('address_phone_number_2')?old('address_phone_number_2'):$order_address_phone_number_2 }}" placeholder="Phone 2"/>
            <small class="error">{{$errors->first("address_phone_number_2")}}</small>
        </div>
    </div>
    <div class="form-group">
        <label for="addressAddress1">Address 1:</label>
        <input type="text" id="addressAddress1" class="form-control" name="address_address_1" value="{{ old('address_address_1')?old('address_address_1'):$order_address_address_1 }}" placeholder="Address 1"/>
        <small class="error">{{$errors->first("address_address_1")}}</small>
    </div>
    <div class="form-group">
        <label for="addressAddress2">Address 2:</label>
        <input type="text" id="addressAddress2" class="form-control" name="address_address_2" value="{{ old('address_address_2')?old('address_address_2'):$order_address_address_2 }}" placeholder="Address 2"/>
        <small class="error">{{$errors->first("address_address_2")}}</small>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="addressCity">City:</label>
            <input type="text" id="addressCity" class="form-control" name="address_city" value="{{ old('address_city')?old('address_city'):$order_address_city }}" placeholder="City"/>
            <small class="error">{{$errors->first("address_city")}}</small>
        </div>
        <div class="form-group col-md-6">
            <label for="addressState">State:</label>
            <input type="text" id="addressState" class="form-control" name="address_state" value="{{ old('address_state')?old('address_state'):$order_address_state }}" placeholder="State"/>
            <small class="error">{{$errors->first("address_state")}}</small>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="addressCountry">Country:</label>
            <select class="custom-select" name="address_country" id="addressCountry">
                <option value="">Select Country</option>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}"
                    @if( old('address_country') && old('address_country')==$country->id)
                        selected='selected'
                    @elseif($order_address_country==$country->id)
                        selected='selected'
                    @endif
                    >{{$country->countryName}} </option>
                @endforeach
            </select>
            <small class="error">{{$errors->first("address_country")}}</small>
        </div>
        <div class="form-group col-md-6">
            <label for="addressZip">Zip Code:</label>
            <input type="text" id="addressZip" class="form-control" name="address_zip_code" value="{{ old('address_zip_code')?old('address_zip_code'):$order_address_zip_code }}" placeholder="Zip Code"/>
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
                <input type="submit" class="btn-block vesti_in_btn" value="Save {{$address_var}} Address"/>
            </div>
        </div>
    </div>
</form>
@endsection