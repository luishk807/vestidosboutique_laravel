@extends("layouts.sub-layout-account")
@section('content')
<div class="container container-in-space white-md-bg-in">
    <div class="row">
        <div class="col">
            <h2>{{$page_title}}</h2>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <P>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vehicula eros vitae lorem finibus faucibus. Morbi vitae blandit diam, id interdum risus. Cras sodales felis augue, efficitur suscipit magna aliquet at. 
            </P>
        </div>
    </div>
    <div class="container account-container">


<form action="{{ route('createaddress',['user_id'=>$user_id]) }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="addressNickName">{{ __('general.form.nickname') }}:</label>
        <input type="text" id="addressNickName" class="form-control" name="nick_name" value="{{ old('nick_name') }}" placeholder="{{ __('general.form.nickname') }}"/>
        <small class="error">{{$errors->first("nick_name")}}</small>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="addressFirstName">{{ __('general.form.first_name') }}:</label>
            <input type="text" id="addressFirstName" class="form-control" name="first_name" value="{{ old('first_name') }}" placeholder="{{ __('general.form.first_name') }}"/>
            <small class="error">{{$errors->first("first_name")}}</small>
        </div>
        <div class="form-group col-md-4">
            <label for="addressMiddleName">{{ __('general.form.middle_name') }}:</label>
            <input type="text" id="addressMiddleName" class="form-control" name="middle_name" value="{{ old('middle_name') }}" placeholder="{{ __('general.form.middle_name') }}"/>
            <small class="error">{{$errors->first("middle_name")}}</small>
        </div>
        <div class="form-group col-md-4">
            <label for="addressLastName">{{ __('general.form.last_name') }}:</label>
            <input type="text" id="addressLastName" class="form-control" name="last_name" value="{{ old('last_name')  }}" placeholder="{{ __('general.form.last_name') }}"/>
            <small class="error">{{$errors->first("last_name")}}</small>
        </div>
    </div>
    <div class="form-group">
        <label for="addressEmail">{{ __('general.form.email') }}:</label>
        <input type="email" id="addressEmail" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ __('general.form.email') }}"/>
        <small class="error">{{$errors->first("email")}}</small>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="addressPhone1">{{ __('general.form.telephone') }} 1:</label>
            <input type="text" id="addressPhone1" class="form-control" name="phone_number_1" value="{{ old('phone_number_1') }}" placeholder="{{ __('general.form.telephone') }} 1"/>
            <small class="error">{{$errors->first("phone_number_1")}}</small>
        </div>
        <div class="form-group col-md-6">
            <label for="addressPhone2">{{ __('general.form.telephone') }} 2:</label>
            <input type="text" id="addressPhone2" class="form-control" name="phone_number_2" value="{{ old('phone_number_2') }}" placeholder="{{ __('general.form.telephone') }} 2"/>
            <small class="error">{{$errors->first("phone_number_2")}}</small>
        </div>
    </div>
    <div class="form-group">
        <label for="addressAddress1">{{ trans_choice('general.form.address',1) }} 1:</label>
        <input type="text" id="addressAddress1" class="form-control" name="address_1" value="{{ old('address_1')  }}" placeholder="{{ trans_choice('general.form.address',1) }} 1"/>
        <small class="error">{{$errors->first("address_1")}}</small>
    </div>
    <div class="form-group">
        <label for="addressAddress2">{{ trans_choice('general.form.address',1) }} 2:</label>
        <input type="text" id="addressAddress2" class="form-control" name="address_2" value="{{ old('address_2') }}" placeholder="{{ trans_choice('general.form.address',1) }} 2"/>
        <small class="error">{{$errors->first("address_2")}}</small>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="addressCity">{{ __('general.form.city') }}:</label>
            <input type="text" id="addressCity" class="form-control" name="city" value="{{ old('city') }}" placeholder="{{ __('general.form.city') }}"/>
            <small class="error">{{$errors->first("city")}}</small>
        </div>
        <div class="form-group col-md-6">
            <label for="addressState">{{ __('general.form.state') }}:</label>
            <input type="text" id="addressState" class="form-control" name="state" value="{{ old('state') }}" placeholder="{{ __('general.form.state') }}"/>
            <small class="error">{{$errors->first("state")}}</small>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="addressCountry">{{ __('general.form.country') }}:</label>
            <select class="custom-select" name="country" id="addressCountry">
                <option value="">{{ __('general.form.select_country') }}</option>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}">{{$country->countryName}} </option>
                @endforeach
            </select>
            <small class="error">{{$errors->first("country")}}</small>
        </div>
        <div class="form-group col-md-6">
            <label for="addressZip">{{ __('general.form.zip') }}:</label>
            <input type="text" id="addressZip" class="form-control" name="zip_code" value="{{ old('zip_code') }}" placeholder="{{ __('general.form.zip') }}"/>
            <small class="error">{{$errors->first("zip_code")}}</small>
        </div>
    </div>
    <div class="form-group">
        <label for="addressAddressType">{{ __('general.page_header.address_type') }}:</label>
        <select class="custom-select" name="address_type" id="addressAddressType">
            <option value="">{{ __('general.page_header.select_address_type') }}</option>
            @foreach($addresstypes as $addresstype)
                <option value="{{ $addresstype->id }}">{{$addresstype->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("address_type")}}</small>
    </div>
    
    <div class="container">
        <div class="row">
            <div class="col">
                <div id="vesti-load"><img src="{{ asset('/images/vesti_load.gif') }}"/></div>
                <input type="submit" class="btn-block vesti_in_btn loader-button" value="{{ __('buttons.create') }}"/>
            </div>
        </div>
    </div>

</form>

    </div>
</div><!--end of main container-->
@endsection