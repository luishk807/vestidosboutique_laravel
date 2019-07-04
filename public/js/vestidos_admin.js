function searchBarProductName(event){
    $("#search-result-holder").hide();
    if(event.target.value.length > 3){
        $.ajax({
            type: "GET",
            url: "/api/searchProductList",
            data: {
                data:event.target.value
            },
            success: function(data) {
                if(data.length>0){
                    $("#search-result-holder").show();
                    var listul=$("#search-result-holder ul");
                    listul.empty();
                    $.each(data, function(index,element){
                        var purl = "/admin/products/edit/"+element.id;
                        listul.append('<li><a href="'+purl+'">'+element.products_name+' '+' '+element.product_model+' '+element.brand_name+'</a></li>');
                    });
                    setTimeout(function(){
                        var test = $("#search-result-holder ul li").children();
                        $.each(test,function(elem,data){
                            searchlist.push(data);
                        })
                    },50)
                }
            }
        });
    }
}
function inputSearchKeyDown(event){
    event.stopPropagation();
    if(event.keyCode==9){
        setTimeout(function(){
            if(searchlist[0]){
                searchlist[0].focus();
            }
        },100)
    }
}
function searchOnKeyDown(event){
    event.preventDefault();
    event.stopPropagation();
    var current = searchlist.indexOf(event.target) !== -1 ? searchlist.indexOf(event.target) : null;
    var setFocus = false;
    var newIndex = null;
    if(event.keyCode==40){
        if(searchlist[current+1] && current <= searchlist.length){
            setFocus = true;
            newIndex = current+1;
        }
    }else if(event.keyCode==38){
        if(searchlist[current-1]){
            setFocus = true;
            newIndex = current-1;
        }
    }else if(event.keyCode==13){
        if(searchlist[current]){
            searchlist[current].click();
        }
    }else if(event.keyCode==27){
        $("#search-result-holder").hide();
        setTimeout(function(){
            $("#search-input-text").focus();
            $("#search-input-text").val("");
        })

    }
    if(setFocus && searchlist[newIndex]){
        searchlist[newIndex].focus();
    }
}
var searchlist = [];
$(document.body).click(function (e) {
    if($("#search-result-holder").is(":visible")){
        $("#search-result-holder").hide();
    }
});

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
function loadDropDown(select1, select2,url){
    $.ajax({
        type: "GET",
        url: url,
        data: {
            data:$(select1).val()
        },
        success: function(data) {
            var product_quantity = $(select2);
            product_quantity.empty();
            $.each(data, function(index,element){
                product_quantity.append("<option value='"+element.id+"'>"+element.name+"</option>");
            });
        }
    });
}
function loadColorDropDown(select1, select2,size_id,url){
    $.ajax({
        type: "GET",
        url: url,
        data: {
            data:$(select1).val()
        },
        success: function(data) {
            var product_quantity = $(select2);
            product_quantity.empty();
            var sizeContainer = $(size_id);
            sizeContainer.empty();
            sizeContainer.append("<option value=''>Select Size</option>");
            product_quantity.append("<option value=''>Select Color</option>");
            $.each(data, function(index,element){
                product_quantity.append("<option value='"+element.id+"'>"+element.name+"</option>");
            });
        }
    });
}
function loadSizes(color,ind){
    if(typeof urlColorSizes !== "undefined"){
        $.ajax({
            type: "GET",
            url: urlColorSizes,
            data: {
                data:color
            },
            success: function(data) {
                var sizeContainer = $("#size_drop_"+ind);
                sizeContainer.empty();
                sizeContainer.append("<option value=''>Select Size</option>");
                $.each(data, function(index,element){
                    sizeContainer.append("<option value='"+element.id+"'>"+element.name+"</option>");
                });
            }
        });
    }
}
function loadSizeDropDown(size,ind){
    if(typeof urlProductQuantity !== "undefined"){
        $.ajax({
            type: "GET",
            url: urlProductQuantity,
            data: {
                data:size
            },
            success: function(data) {
                var total_size = 0;
                total_size = data > 10 ? 10 : data;
                var product_quantity = $("#quantity_drop_"+ind);
                product_quantity.empty();
                for(var i=0;i<total_size;i++){
                    var data_index =i+1;
                    product_quantity.append("<option value='"+data_index+"'>"+data_index+"</option>");
                }
            }
        });
    }
}
function loadSizeDropDownArray(size,ind){
    if(typeof urlProductQuantityArray !== "undefined"){
        $.ajax({
            type: "GET",
            url: urlProductQuantityArray,
            data: {
                data:size
            },
            success: function(data) {
                var total_size = 0;
                total_size = data["stock"] > 10 ? 10 : data["stock"];
                var product_quantity = $("#quantity_drop_"+ind);
                product_quantity.empty();
                $("#admin_new_order_total").text("");
                $("#admin_new_order_total").text("$"+data["total"]);
                for(var i=0;i<total_size;i++){
                    var data_index =i+1;
                    product_quantity.append("<option value='"+data_index+"'>"+data_index+"</option>");
                }
            }
        });
    }
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
    $('.delete_button').click(function(event) {
        event.preventDefault();
        $("#custom_home_form").submit();
    });
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