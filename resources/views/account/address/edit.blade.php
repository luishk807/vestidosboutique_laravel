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


<form action="{{ route('updateaddress',['address_id'=>$address_id]) }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="addressNickName">{{ __('general.form.nickname') }}:</label>
        <input type="text" id="addressNickName" class="form-control" name="nick_name" value="{{ old('nick_name') ? old('nick_name') : $address->nick_name }}" placeholder="{{ __('general.form.nickname') }}"/>
        <small class="error">{{$errors->first("nick_name")}}</small>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="addressFirstName">{{ __('general.form.first_name') }}:</label>
            <input type="text" id="addressFirstName" class="form-control" name="first_name" value="{{ old('first_name') ? old('first_name') : $address->first_name }}" placeholder="{{ __('general.form.first_name') }}"/>
            <small class="error">{{$errors->first("first_name")}}</small>
        </div>
        <div class="form-group col-md-4">
            <label for="addressMiddleName">{{ __('general.form.middle_name') }}:</label>
            <input type="text" id="addressMiddleName" class="form-control" name="middle_name" value="{{ old('middle_name') ? old('middle_name') : $address->middle_name }}" placeholder="{{ __('general.form.middle_name') }}"/>
            <small class="error">{{$errors->first("middle_name")}}</small>
        </div>
        <div class="form-group col-md-4">
            <label for="addressLastName">{{ __('general.form.last_name') }}:</label>
            <input type="text" id="addressLastName" class="form-control" name="last_name" value="{{ old('last_name') ? old('last_name') : $address->last_name }}" placeholder="{{ __('general.form.last_name') }}"/>
            <small class="error">{{$errors->first("last_name")}}</small>
        </div>
    </div>
    <div class="form-group">
        <label for="addressEmail">{{ __('general.form.email') }}:</label>
        <input type="email" id="addressEmail" class="form-control" name="email" value="{{ old('email') ? old('email') : $address->email }}" placeholder="{{ __('general.form.email') }}"/>
        <small class="error">{{$errors->first("email")}}</small>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="addressPhone1">{{ __('general.form.telephone') }} 1:</label>
            <input type="text" id="addressPhone1" class="form-control" name="phone_number_1" value="{{ old('phone_number_1') ? old('phone_number_1') : $address->phone_number_1 }}" placeholder="{{ __('general.form.telephone') }} 1"/>
            <small class="error">{{$errors->first("phone_number_1")}}</small>
        </div>
        <div class="form-group col-md-6">
            <label for="addressPhone2">{{ __('general.form.telephone') }} 2:</label>
            <input type="text" id="addressPhone2" class="form-control" name="phone_number_2" value="{{ old('phone_number_2') ? old('phone_number_2') : $address->phone_number_2 }}" placeholder="{{ __('general.form.telephone') }} 2"/>
            <small class="error">{{$errors->first("phone_number_2")}}</small>
        </div>
    </div>
    <div class="form-group">
        <label for="addressAddress1">{{ trans_choice('general.form.address',1) }} 1:</label>
        <input type="text" id="addressAddress1" class="form-control" name="address_1" value="{{ old('address_1') ? old('address_1') : $address->address_1 }}" placeholder="A{{ trans_choice('general.form.address',1) }} 1"/>
        <small class="error">{{$errors->first("address_1")}}</small>
    </div>
    <div class="form-group">
        <label for="addressAddress2">{{ trans_choice('general.form.address',1) }} 2:</label>
        <input type="text" id="addressAddress2" class="form-control" name="address_2" value="{{ old('address_2') ? old('address_2') : $address->address_2 }}" placeholder="{{ trans_choice('general.form.address',1) }} 2"/>
        <small class="error">{{$errors->first("address_2")}}</small>
    </div>
    @include('includes.country_province_edit')
    <div class="form-group">
        <label for="addressAddressType">{{ __('general.page_header.address_type') }}:</label>
        <select class="custom-select" name="address_type" id="addressAddressType">
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
    
    <div class="container">
        <div class="row">
            <div class="col">
                <a href="{{ route('confirmaddress',['address_id'=>$address->id])}}" class="btn-block vesti_in_btn">{{ __('buttons.delete') }}</a>
            </div>
            <div class="col">
                <div id="vesti-load"><img src="{{ asset('/images/vesti_load.gif') }}"/></div>
                <input type="submit" class="btn-block vesti_in_btn loader-button" value="{{ __('buttons.save') }}"/>
            </div>
        </div>
    </div>

</form>

    </div>
</div><!--end of main container-->
@endsection