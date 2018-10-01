function switchStatesDropByIndex(indx){
    var getLoadStatesUrl = $("#loadStateUrl").val();
    $.ajax({
        type: "GET",
        url:getLoadStatesUrl,
        data: {
            data:$("#addressCountry_"+indx).val()
        },
        success: function (data) {
            var addressProvince = $("#addressProvince_"+indx);
            addressProvince.empty();
            $.each(data, function(index,element){
                addressProvince.append("<option value='"+element.id+"'>"+element.name+"</option>");
            });
            switchDistrictsDropByIndex(indx);
        }
    });
}
function switchDistrictsDropByIndex(indx){
    var getLoadDistrictsUrl = $("#loadDistrictUrl").val();
    $.ajax({
        type: "GET",
        data: {
            data:$("#addressProvince_"+indx).val()
        },
        url:getLoadDistrictsUrl,
        success: function (data) {
            var addressDistrict = $("#addressDistrict_"+indx);
            addressDistrict.empty();
            $.each(data, function(index,element){
                addressDistrict.append("<option value='"+element.id+"'>"+element.name+"</option>");
            });
            switchCorregimientosDropByIndex(indx)
        }
    });
}
function switchCorregimientosDropByIndex(indx){
    var getLoadCorregimientosUrl = $("#loadCorregimientoUrl").val();
    $.ajax({
        type: "GET",
        data: {
            data:$("#addressDistrict_"+indx).val()
        },
        url:getLoadCorregimientosUrl,
        success: function (data) {
            var addressCorregimiento = $("#addressCorregimiento_"+indx);
            addressCorregimiento.empty();
            $.each(data, function(index,element){
                addressCorregimiento.append("<option value='"+element.id+"'>"+element.name+"</option>");
            });
        }
    });
}
$(document).ready(function() {
    $('.no-submit').on('click', function(e) {
        // Prevent the default action of the clicked item. In this case that is submit
        e.preventDefault();
        return false;
    });
    $(".rate-view").rate({
        readonly:true
    });
    $("#orderUser").change(function(){
        $.ajax({
           type: "GET",
           url: getAddressUrl,
           data: {
               data:$(this).val()
           },
           success: function(data) {
               var orderShipAddress = $("#orderShipAddress");
               var orderBillingAddress = $("#orderBillingAddress");
               orderShipAddress.empty();
               orderBillingAddress.empty();
               orderShipAddress.append("<option value=''>Select Shipping Address</option>");
               orderBillingAddress.append("<option value=''>Select Billing Address</option>");
               $.each(data, function(index,element){
                   console.log(index+" and "+element);
                   orderShipAddress.append("<option value='"+element.id+"'>"+element.nick_name+" [ "+element.zip_code+" ]</option>");
                   orderBillingAddress.append("<option value='"+element.id+"'>"+element.nick_name+" [ "+element.zip_code+" ]</option>");
               });
           }
       }); 
   });

   $("#orderProduct").change(function(){
        $.ajax({
           type: "GET",
           url: getProductUrl,
           data: {
               data:$(this).val()
           },
           success: function(data) {
               var orderShipAddress = $("#orderTotal");
               orderShipAddress.val("");
               orderShipAddress.val(data.product_total);
           }
       }); 
   });
});