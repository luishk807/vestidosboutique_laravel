function on_searchProduct_(event){
    $("#on_searchBar_result").hide();
    if(event.target.value.length > 3){
        $.ajax({
            type: "GET",
            url: "/api/searchProductList",
            data: {
                data:event.target.value
            },
            success: function(data) {
                if(data.length>0){
                    $("#on_searchBar_result").show();
                    var listul=$("#on_searchBar_result ul");
                   listul.empty();
                    $.each(data, function(index,element){
                        listul.append('<li><a class="on_search_item" href="" data="'+element.id+'">'+element.products_name+' '+' '+element.product_model+' '+element.brand_name+'</a></li>');
                    });
                    $(".on_search_item").on("click",function(e){
                        e.preventDefault();
                        var prd_id = $(e.target).attr("data");
                        location.href="/admin/orders/products/new?data="+prd_id;
                    })
                }
            }
        });
    }
}
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
                $.each(data.colors, function(index,element){
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
                if(data < 1 || !data || (typeof data == "object" && !data.length)){
                    // if out of stock , set 10 for pre-orders
                    data = 11;
                }
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
                var data_stock = data["stock"];
                if(data_stock < 1 || !data_stock){
                    // if out of stock , set 10 for pre-orders
                    data_stock = 11;
                }
                total_size = data_stock > 10 ? 10 : data_stock;
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
function openRadioContent(content){
    var is_credit = $(content).attr("credit-card");
    if(is_credit=="yes"){
        $("#is_credit_card").val("yes");
    }else{
        $("#is_credit_card").val("no");
    }
    $("."+content.attr("class-content")).hide();
    $("div[target-data='"+content.attr("target-data")+"']").show();
}
function applyDiscount(){
    var discount = $("#coupon_code").val();
    if(discount.length){
        $.ajax({
           type: "GET",
           url: "/api/applyDiscount",
           data: {
               data:discount,
               type:"add",
           },
           success: function(data) {
               if(!data["status"]){
                $("#coupon_section .error").text(data["msg"]);
                return;
               }
               window.location.reload();
           }
       }); 
    }
}
function clearCouponError(){
    $("#coupon_section .error").text("");
}
function removeDiscount(){
    var discount = $("#discount_total").val();
    if(!discount){
        return;
    }
    $.ajax({
        type: "GET",
        url: "/api/removeDiscount",
        data: "",
        success: function(data) {
            if(data){
            window.location.reload();
            }
        }
    });
}
// popupmodal 
function openModalAlert(){
    $("html,body").css("overflow","hidden");
    $("#modal-black-bg").fadeIn();
}
function closeModalAlert(){
    $("#modal-black-bg").fadeOut();
    $("html,body").css("overflow","auto");
}
//end
$(document).ready(function() {
    // admin radio buttons checkout
    $("input.vestidos_collapse_radio:checked").each(function(){
        openRadioContent($(this));
    })
    $("input.vestidos_collapse_radio").click(function(e){
        openRadioContent($(e.target))
    })

    // popup modal
    $("#modal-close-pnl a").hover(function(){
        $("#modal-close-pnl a div").removeClass("img_rerotate").stop(true,true).addClass("img_rotate")
    },function(){
        $("#modal-close-pnl a div").removeClass("img_rotate").stop(true,true).addClass("img_rerotate")
    }) 


    $(".alert_test_link").on("click",function(){
        var id = $(this).attr("data");
        $.ajax({
            type: "GET",
            url: "/api/getAlertInfo",
            data: {
                data:id
            },
            success: function(data) {
            if(!$.isEmptyObject(data)){
                $(".modal-admin-section #modal-title-pnl").text(data.title);
                $(".modal-admin-section #modal-in-pnl #line_1").text(data.line_1);
                $(".modal-admin-section #modal-in-pnl #line_2").text(data.line_2);
                if(data.line_2){
                        $(".modal-admin-section #modal-in-pnl #line_2").show();
                }else{
                    $(".modal-admin-section #modal-in-pnl #line_2").hide();
                }
                if(data.action_link){
                        $(".modal-admin-section #modal-in-pnl #action_link").show();
                }else{
                    $(".modal-admin-section #modal-in-pnl #action_link").hide();
                }
                $(".modal-admin-section #modal-in-pnl .modal-in-link").text(data.action_text);
                $(".modal-admin-section #modal-in-pnl .modal-in-link").attr("href",data.action_link);
                var action_tab = data.action_tab == 0 ? "_self":"_blank";
                $(".modal-admin-section #modal-in-pnl .modal-in-link").attr("target",action_tab);
                setTimeout(function(){
                    openModalAlert();
                })
            }
            }
        }); 
    });
    // end of popup
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

   // admin order page
   $(".no_adminAddCartProduct").on("click",function(e){
    e.preventDefault();
    var parentSec = $(e.target).parent().parent().parent();
    var color = parentSec.find(".no_color_select").val();
    var size = parentSec.find(".no_size_select").val();
    var quantity = parentSec.find(".no_quantity_select").val();
    var prd_id = $(e.target).parent().attr('data');
    var error_msg = $(e.target).parent().attr('data-error');
    if(!color || !size || !quantity){
        alert(error_msg);
        return;
    }else{
            $.ajax({
                type: "GET",
                url: "/admin/orders/products/new/cart/add",
                data: {
                    id:prd_id,
                    size:size,
                    quantity:quantity,
                    color:color,
                },
                success: function(data) {
                if(data.status.status){
                    location.href="/admin/orders/products/new"
                }
                }
            });
        }
    })
    $(".no_adminRemoveCartProduct").on("click",function(e){
        e.preventDefault();
        var prd_id = $(e.target).parent().attr("data");
        $.ajax({
            type: "GET",
            url: "/admin/orders/products/new/cart/remove",
            data: {
                id:prd_id,
            },
            success: function(data) {
                if(data.status.status){
                    location.reload();
                }
            }
        });
    })
    $(".no_update_select").on("change",function(e){
        var quantity = $(e.target).val();
        var prd_id = $(e.target).find('option:selected').attr("data");
        $.ajax({
            type: "GET",
            url: "/admin/orders/products/new/cart/update",
            data: {
                id:prd_id,
                quantity:quantity,
            },
            success: function(data) {
                if(data.status.status){
                    location.reload();
                }
            }
        });
    })
    $(".no_color_select").on("change",function(e){
        var size = $(e.target).parent().parent().find(".no_size_select");
        $(e.target).parent().parent().find(".no_price_input").text('');
        var color = $(e.target).val();
        $.ajax({
            type: "GET",
            url: "/api/loadSizes",
            data: {
                data:color
            },
            success: function(data) {
                size.empty();
                size.append("<option value=''>Select Size</option>");
                $.each(data.colors, function(index,element){
                    size.append("<option price="+element.total_sale+" value='"+element.id+"'>"+element.name+"</option>");
                });
            }
        });
    })
    $(".no_size_select").on("change",function(e){
        var product_quantity = $(e.target).parent().parent().find(".no_quantity_select");
        $(e.target).parent().parent().find(".no_price_input").text('');
        product_quantity.empty();
        for(var i=0;i<=9;i++){
            var data_index =i+1;
            product_quantity.append("<option value='"+data_index+"'>"+data_index+"</option>");
        }
    })
    $(".no_quantity_select").on("change",function(e){
        var product_quantity = $(e.target).parent().parent().find(".no_quantity_select").val();
        var sizeContainer = $(e.target).parent().parent().find(".no_size_select");
        var price = sizeContainer.find('option:selected').attr("price");
        if(product_quantity && price){
            var total = parseInt(product_quantity) * price;
            var total_container = $(e.target).parent().parent().find(".no_price_input")
            total_container.text("");
            total_container.text("$"+total); 
        }
    })
});