@extends('admin/layouts.app')
@section('content')


<form action="{{ route('create_tax') }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="taxName">Code Name:</label>
        <input type="text" id="taxName" class="form-control" name="name" value="{{ old('name')}}" placeholder="Tax Name"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="taxTotal">Tax Total:</label>
        <input type="number" id="taxTotal" class="form-control" name="tax" min="0" step="0.01" value="" placeholder="0.00"/>
    </div>
    <div class="form-group">
        <label for="taxStatus">Status:</label>
        <select class="custom-select" name="status" id="taxStatus">
            @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    <div class="form-group">
        <label for="taxCountry">Country:</label>
        <select class="custom-select" name="country" id="taxCountry">
            <option value="">Select Country</option>
            @foreach($countries as $country)
                {{old('country')}}
                <option value="{{ $country->id }}"
                @if(old('country')==$country->id)
                selected
                @endif
                >{{$country->countryName}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("country")}}</small>
    </div>
    <div class="container">
        <div class="row form-btn-container">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_taxes') }}">
                    Back To Taxes
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Create Tax"/>
            </div>
        </div>
    </div>
</form>
@endsection