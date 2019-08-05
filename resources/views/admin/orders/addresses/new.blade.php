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
<script>
    $(document).ready(()=>{
        switchStatesDropByIndex(0);
        switchStatesDropByIndex(1);
    })
</script>
<form action="{{ route('admin_create_new_order_address') }}" method="post">
{{ csrf_field() }}
    <input type="hidden" value="{{ url('api/loadStates') }}" id="loadStateUrl">
    <input type="hidden" value="{{ url('api/loadDistricts') }}" id="loadDistrictUrl">
    <input type="hidden" value="{{ url('api/loadCorregimientos') }}" id="loadCorregimientoUrl">
    @if($main_config->allow_shipping)
    <div class="container admin-address-container">
        <div class="row container-title">
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
    @endif
    @foreach($address_types as $addressindex=>$address_type)
    @if($address_type->id != '1' || ($address_type->id == '1' && $main_config->allow_shipping))
    <input type="hidden" name="addresses[{{$addressindex}}][address_type]" value="{{ $address_type->id }}"/>
    <div class="container admin-address-container">
        <div class="row container-data row-even">
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
                        <label for="addressProvince_{{ $addressindex }}">{{ __('general.form.province') }}:</label>
                        <select class="custom-select" onChange="switchDistrictsDropByIndex('{{ $addressindex }}')" name="addresses[{{$addressindex}}][province]" id="addressProvince_{{ $addressindex }}">
                            @foreach($provinces as $province)
                                <option value="{{ $province->id }}"
                                @if($province->id==old('province'))   
                                    selected=selected
                                @endif     
                                >{{$province->name}} </option>
                            @endforeach
                        </select>
                        <small class="error">{{$errors->first("province")}}</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="addressDistrict_{{ $addressindex }}">{{ __('general.form.district') }}:</label>
                        <select class="custom-select" onChange="switchCorregimientosDropByIndex('{{ $addressindex }}')" name="addresses[{{$addressindex}}][district]" id="addressDistrict_{{ $addressindex }}">
                        </select>
                        <small class="error">{{$errors->first("district")}}</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="addressCorregimiento_{{ $addressindex }}">{{ __('general.form.corregimiento') }}:</label>
                        <select class="custom-select" name="addresses[{{$addressindex}}][corregimiento]" id="addressCorregimiento_{{ $addressindex }}">
                        </select>
                        <small class="error">{{$errors->first("corregimiento")}}</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="addressZip_{{ $addressindex }}">{{ __('general.form.zip') }}:</label>
                        <input type="text" id="addressZip" class="form-control" name="addresses[{{$addressindex}}][zip_code]" value="{{ old('zip_code') }}" placeholder="{{ __('general.form.zip') }}"/>
                        <small class="error">{{$errors->first("zip_code")}}</small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="addressCountry_{{ $addressindex }}">{{ __('general.form.country') }}:</label>
                        <select class="custom-select" name="addresses[{{$addressindex}}][country]" id="addressCountry_{{ $addressindex }}">
                            @foreach($countries as $country)
                                @if($country->id==173)
                                <option value="{{ $country->id }}">{{$country->countryName}} </option>
                                @endif
                            @endforeach
                        </select>
                        <small class="error">{{$errors->first("country")}}</small>
                    </div>
                </div>
                @endif
            </div><!--end of form cols-->
        </div>
    </div>
    @endif
    
    @endforeach
    <div class="container">
        <div class="row form-btn-container">
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