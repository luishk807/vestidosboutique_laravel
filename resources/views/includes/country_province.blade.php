<script>
var getLoadStatesUrl = "{{ url('api/loadStates') }}";
var getLoadDistrictsUrl = "{{ url('api/loadDistricts') }}";
var getLoadCorregimientosUrl = "{{ url('api/loadCorregimientos') }}";
$(document).ready(function() {
    /************COUNTRY AND PROVINCE SCRIPT */
    function switchStatesDrop(){
        $.ajax({
            type: "GET",
            url:getLoadStatesUrl,
            data: {
                data:$("#addressCountry").val()
            },
            success: function (data) {
                var addressProvince = $("#addressProvince");
                addressProvince.empty();
                $.each(data, function(index,element){
                    addressProvince.append("<option value='"+element.id+"'>"+element.name+"</option>");
                });
                switchDistrictsDrop();
            }
        });
    }
    function switchDistrictsDrop(){
        $.ajax({
            type: "GET",
            data: {
                data:$("#addressProvince").val()
            },
            url:getLoadDistrictsUrl,
            success: function (data) {
                var addressDistrict = $("#addressDistrict");
                addressDistrict.empty();
                $.each(data, function(index,element){
                    addressDistrict.append("<option value='"+element.id+"'>"+element.name+"</option>");
                });
                switchCorregimientosDrop()
            }
        });
    }
    function switchCorregimientosDrop(){
        $.ajax({
            type: "GET",
            data: {
                data:$("#addressDistrict").val()
            },
            url:getLoadCorregimientosUrl,
            success: function (data) {
                var addressCorregimiento = $("#addressCorregimiento");
                addressCorregimiento.empty();
                $.each(data, function(index,element){
                    addressCorregimiento.append("<option value='"+element.id+"'>"+element.name+"</option>");
                });
            }
        });
    }
   $("#addressCountry").change(function(){
        switchStatesDrop();
   });
   $("#addressProvince").change(function(){
        switchDistrictsDrop();
   });
   $("#addressDistrict").change(function(){
        switchCorregimientosDrop();
   });
   /***END OF COUNTRY */
   switchStatesDrop()
});
</script>
<input type="hidden" value="{{ old('province_required') }}" name="province_required" id="province_required"/>
    <div class="form-row">
    <div class="form-group col-md-6">
        <label for="addressProvince">{{ __('general.form.province') }}:</label>
        <select class="custom-select" name="province" id="addressProvince">
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
        <label for="addressDistrict">{{ __('general.form.district') }}:</label>
        <select class="custom-select" name="province" id="addressDistrict">
        </select>
        <small class="error">{{$errors->first("district")}}</small>
    </div>
    <div class="form-group col-md-6">
        <label for="addressCorregimiento">{{ __('general.form.corregimiento') }}:</label>
        <select class="custom-select" name="province" id="addressCorregimiento">
        </select>
        <small class="error">{{$errors->first("corregimiento")}}</small>
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