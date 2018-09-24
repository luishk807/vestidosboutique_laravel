<script>
var getLoadStatesUrl = "{{ url('api/loadStates') }}";
$(document).ready(()=>{
   switchStatesDrop();
});
</script>
<input type="hidden" value="{{ old('province_required') }}" name="province_required" id="province_required"/>
@if(env('PANAMA_MODE'))
    <div class="form-row">
    <div class="form-group col-md-6">
        <label for="addressProvince">{{ __('general.form.province') }}:</label>
        <select class="custom-select" name="province" id="addressProvince">
            @foreach($provinces as $province)
                <option value="{{ $province->id }}"
                @if($province->id==$old('province'))   
                    selected=selected
                @endif     
                >{{$province->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("province")}}</small>
    </div>
    <div class="form-group col-md-6">
        <label for="addressZip">{{ __('general.form.zip') }}:</label>
        <input type="text" id="addressZip" class="form-control" name="zip_code" value="{{ old('zip_code') }}" placeholder="{{ __('general.form.zip') }}"/>
        <small class="error">{{$errors->first("zip_code")}}</small>
    </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-12">
        <label for="addressCountry">{{ __('general.form.country') }}:</label>
        <select class="custom-select" name="country" id="addressCountry">
            @foreach($countries as $country)
                @if($country->id==173)
                <option value="{{ $country->id }}">{{$country->countryName}} </option>
                @endif
            @endforeach
        </select>
        <small class="error">{{$errors->first("country")}}</small>
    </div>

    </div>
    @else
    <div class="form-row">
    <div class="form-group col-md-6" id="city-switch">
        <label for="addressCity">{{ __('general.form.city') }}:</label>
        <input type="text" id="addressCity" class="form-control" name="city" value="{{ old('city') }}" placeholder="{{ __('general.form.city') }}"/>
        <small class="error">{{$errors->first("city")}}</small>
    </div>
    <div class="form-group col-md-6" id="state-switch">
        <label for="addressState">{{ __('general.form.state') }}:</label>
        <input type="text" id="addressState" class="form-control" name="state" value="{{ old('state') }}" placeholder="{{ __('general.form.state') }}"/>
        <small class="error">{{$errors->first("state")}}</small>
    </div>
    
    <div class="form-group col-md-6 hide" id="province-switch">
        <label for="addressProvince">{{ __('general.form.province') }}:</label>
        <select class="custom-select" name="province" id="addressProvince">
            @foreach($provinces as $province)
                <option value="{{ $province->id }}">{{$province->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("province")}}</small>
    </div>

    <div class="form-group col-md-6">
        <label for="addressZip">{{ __('general.form.zip') }}:</label>
        <input type="text" id="addressZip" class="form-control" name="zip_code" value="{{ old('zip_code') }}" placeholder="{{ __('general.form.zip') }}"/>
        <small class="error">{{$errors->first("zip_code")}}</small>
    </div>

    <div class="form-group col">
        <label for="addressCountry">{{ __('general.form.country') }}:</label>
        <select class="custom-select" name="country" id="addressCountry">
            @foreach($countries as $country)
                <option value="{{ $country->id }}">{{$country->countryName}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("country")}}</small>
    </div>

    </div>
@endif