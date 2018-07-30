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
    /****CART TOP HOVER****/
    $("#vesti-navbar-top-link").hover(function(){
        $(".submenu-panel").removeClass("open");
        $(".vesti-cart-top").toggleClass("active"); 
    })
    $(".vesti-cart-top").hover(function(){
        $(".submenu-panel").removeClass("open");
        $(this).toggleClass("active"); 
    })
    /***END ***/
    var isReponsive =false;
    function initialization(){
        $('#fullpage').fullpage({
            // scrollOverflow: true,
            navigation: true,
            responsiveWidth: 900,
            menu: '.navbar',
            afterRender: function () {
                //on page load, start the slideshow
                setSlider();
            },
            afterResponsive: function(isResponsivex){
                isReponsive = isResponsivex;
                if(isResponsivex){
                    $('#top_middle_sec_row #top_middle_img1,#top_middle_sec_row #top_middle_img2,#top_middle_sec_row #top_middle_img3').removeClass('active');
                    $("#home_main_slider .main_slider_btn").removeClass("col").addClass("col-md-4")
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
        $(".submenu-panel").removeClass("open");
        $('#vesti-main-nav-btn').removeClass('open');
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
    var current=null;
    var menu_id=null;
    $(".vest-maincolor-left .nav-item a").click(function(){
        if(current){
            menu_id=$(this).attr("menu-target");
            $("#"+current).toggleClass("open");
            if(menu_id != current){
                current = null;
                setTimeout(function(){
                    $(".submenu-panel").not(this).removeClass("open");
                    $("#"+menu_id).toggleClass("open");
                },100)
            }
        }else{
            menu_id=current=$(this).attr("menu-target");
            $(".submenu-panel").not(this).removeClass("open");
            $("#"+menu_id).toggleClass("open");
        }

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
