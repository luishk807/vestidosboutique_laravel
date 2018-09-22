<script>
var getLoadStatesUrl = "{{ url('api/loadStates') }}";
$(document).ready(()=>{
    function switchStatesDrop(){
        $.ajax({
           type: "GET",
           url: getLoadStatesUrl,
           data: {
               data:$("#addressCountry").val()
           },
           success: function(data) {
               if(data.length>0){
                   $("#province-switch").removeClass("hide");
                   $("#state-switch").addClass('hide');
                   $("#city-switch").addClass('hide');
                   $("#addressCity").val("");
                    var orderShipAddress = $("#addressProvince");
                    orderShipAddress.empty();
                    $.each(data, function(index,element){
                        orderShipAddress.append("<option value='"+element.id+"'>"+element.name+"</option>");
                    });
               }else{
                   $("#province-switch").addClass("hide");
                   $("#state-switch").removeClass('hide');
                   $("#city-switch").removeClass('hide');
                   var orderShipAddress = $("#addressProvince");
                    orderShipAddress.empty();
               }
           }
       }); 
    }
    $("#addressCountry").change(function(){
        switchStatesDrop();
   });
   switchStatesDrop();
});
</script>
<style>
.hide{
    display:none;
}
</style>
@if(env('PANAMA_MODE'))
    <div class="form-row">
    <div class="form-group col-md-6">
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
            <option value="233">United States</option>
            <option value="38">Canada</option>
            <option value="173">Panama</option>
            <option value="" disabled>&#45&#45&#45&#45&#45&#45</option>
            @foreach($countries as $country)
                <option value="{{ $country->id }}">{{$country->countryName}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("country")}}</small>
    </div>

    </div>
@endif