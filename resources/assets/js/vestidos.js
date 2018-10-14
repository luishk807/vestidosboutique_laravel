$(document).ready(function() {
    $("#main-body").fadeIn();
    var slideTimeout = null;
    function setSlider(){
        if(!slideTimeout){
            slideTimeout = setInterval(function () {
                    $.fn.fullpage.moveSlideRight();
            },5000);
        }
    }
    $("#orderUser").change(function(){
        $.ajax({
           type: "GET",
           url: urlGetAddress,
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
           url: urlGetProduct,
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
   /******PRODUCT PAGE ***/
   var color_selected = $(".product_in_colors button.selected");
   if(color_selected){
       color_selected.trigger( "click" );
       loadSizes(color_selected.attr('data-value'));
   }
   $(".color_cubes_btn_a").click(function(e){
        loadSizes($(e.target).attr("data-value"));
   });
   /*******SHOP PAGE *************/
   $(".rate-shop").rate({
        readonly:true
    });
    $("#shopPage_select").change(function(){
        $("#shop_sort_form").submit();
    });
    $(".vestidos-check").on("click",function(){
        $("#shop_sort_form").submit();
    })
    /****CART TOP HOVER****/
    // $(".nav-toggle-li").hover(function(){
    //     $(".nav-list-submenu, .nav-list-submenu ul").toggleClass("active"); 
    // })
    $(".nav-toggle-li").hover(function(){
        $(this).toggleClass("active"); 
        $(this).find("ul").toggleClass("active");
    })

     $(".navbar-vesti-cart").hover(function(){
        $(".vesti-cart-top").toggleClass("active"); 
    })
    $(".nav-item-lang").hover(function(){
        $(".vesti-lang-top").toggleClass("active"); 
    })
    /***END ***/
    var isReponsive =false;
    function initialization(){
        $('#fullpage').fullpage({
            // scrollOverflow: true,
            navigation: false,
            autoScrolling: false,
            responsiveWidth: 900,
            scrollBar: true,
            menu: '.navbar',
            afterRender: function () {
                //on page load, start the slideshow
                setSlider();
            },
            afterResponsive: function(isResponsivex){
                isReponsive = isResponsivex;
                if(isResponsivex){
                    $('#top_middle_sec_row #top_middle_img1,#top_middle_sec_row #top_middle_img2,#top_middle_sec_row #top_middle_img3').removeClass('active');
                    // $("#home_main_slider .main_slider_btn").removeClass("col").addClass("col-md-4")
                    $('.brands_txt > div').css("margin-left","auto");
                    $(".quince_thumb").addClass("active");
                }else{
                    $(".vestidos-main-nav-top").removeClass("show");
                }
            },
            afterLoad: function(anchorLink, index){
                //set slider when in slide 1
                if (index == '1' && !slideTimeout) {
                    setSlider();
                }
                if(index == 2 && !isReponsive){
                    $('#top_middle_sec_row #top_middle_img1,#top_middle_sec_row #top_middle_img2,#top_middle_sec_row #top_middle_img3').addClass('active');
                }
                // if(index == 3 && !isReponsive){
                //     $('.brands_txt > div').addClass('active');
                // }
                if(index == 5 && !isReponsive){
                    $('#quince_thumb_1').addClass('active');
                    var divs = $('.quince_thumb');
                    var index = 1;
                    var delay = setInterval( function(){
                        if ( index <= divs.length ){
                            $( divs[index] ).addClass('active');
                            index += 1;
                        }else{
                            clearInterval( delay );
                        }
                    },300);
                }
            },
            onLeave: function (index, direction) {
                //remove slider when leaving
                if (index == '1') {
                    clearInterval(slideTimeout);
                    slideTimeout =null;
                }
                
            }
        });
    }
    initialization();
    $(window).on("resize",function() {
        $('#vesti-main-nav-btn').removeClass('open');
        $(".vestidos-main-nav-top").removeClass("show");
    });
    $("#main_slider_arrow_cont .vesti-down-arrow").click(function(e){
        e.preventDefault();
        $.fn.fullpage.moveSectionDown();
    });
    $('#vesti-main-nav-btn').click(function(){
        $(this).toggleClass('open');
    });
    $(".collapse-link").click(function(){
        $(this).closest(".nav-item").toggleClass("hover");
    })
    $(".vesti-cart-quantity-input").click(function () {
        $(this).select();
    });
    $(".product_thumnb_link").click(function(e){
        e.preventDefault();
       var getImg = $($(e.target).closest("img")).attr("src");
       $(".product_main_img_in").find("img").attr("src",getImg);
    });
    $("#popup_bgOverlay").click(function(){
        closeCartPopUp();
    })
    $(".rate-view").rate({
        readonly:true
    });
    //checkout
    $(".checkout-button,.loader-button").on("click",function(){
        $(this).css("display","none");
        // $(this).prop('disabled', true);
        $("#vesti-load").css("display","block");
    });
    $(".oval-button").on("click",function(){
        $(this).css("display","none");
        // $(this).prop('disabled', true);
        $("#vesti-load-oval").css("display","block");
    });
});
function addWishlist(product_id){
    $.ajax({
        type: "GET",
        url: addWishlistUrl,
        data: {
            data:product_id
        },
        success: function(data) {
            if(data["status"]=="login"){
                window.location.href="/signin";
            }
            else if(data["status"]=="insert"){
                $(".product_main_img_in a >.vesti-svg").addClass("active");
            }else if(data["status"]=="deleted"){
                $(".product_main_img_in a > .vesti-svg").removeClass("active");
            }
        }
    });
}
function updateCart(index,quant){
    document.location='api/updateCart?key='+index+"&quantity="+quant;
}
function deleteCart(index){
    document.location='api/deleteCart?key='+index;
}
function loadSizes(color){
    if(typeof urlColorSizes !== "undefined"){
        $.ajax({
            type: "GET",
            url: urlColorSizes,
            data: {
                data:color
            },
            success: function(data) {
                var sizeContainer = $("#size-container");
                sizeContainer.empty();
                $.each(data, function(index,element){
                    sizeContainer.append("<button class='size_spheres' onclick='addCart(event)' data-class='size_spheres' data-input='product_size' data-value='"+element.id+"'>"+element.name+"</button>");
                });
            }
        });
    }
}
function addCart(event){
    event.preventDefault();
    var dataValue=$(event.target).attr("data-value");
    var hiddenInput=$(event.target).attr("data-input");
    var dataClass=$(event.target).attr("data-class");
    $("."+dataClass).removeClass("selected");
    $(event.target).addClass("selected");
    $("#"+hiddenInput).val(dataValue);
}
function checkCartSubmit(){
    if(!$("#product_color").val()){
        openCartPopUp("Please Select Color");
        return false;
    }else if(!$("#product_size").val()){
        openCartPopUp("Please Select Size");
        return false;
    }
    return true;
}
function closeCartPopUp(){
    $("#popup_bgOverlay").css("display","none");
    var div = document.getElementById('popup_text_in');
    div.innerHTML = '';
    $('body').css('overflow','auto');
}
function openCartPopUp(txt){
    $("#popup_bgOverlay").css("display","block");
    var div = document.getElementById('popup_text_in');
    div.innerHTML += txt;
    $('body').css('overflow','hidden');
}
