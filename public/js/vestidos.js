function addWishlist(t){$.ajax({type:"GET",url:addWishlistUrl,data:{data:t},success:function(t){"login"==t.status?window.location.href="/signin":"insert"==t.status?$(".product_main_img_in a >.vesti-svg").addClass("active"):"deleted"==t.status&&$(".product_main_img_in a > .vesti-svg").removeClass("active")}})}function updateCart(t,e){document.location="api/updateCart?key="+t+"&quantity="+e}function deleteCart(t){document.location="api/deleteCart?key="+t}function addCart(t){t.preventDefault();var e=$(t.target).attr("data-value"),a=$(t.target).attr("data-input"),o=$(t.target).attr("data-class");$("."+o).removeClass("selected"),$(t.target).addClass("selected"),$("#"+a).val(e)}function checkCartSubmit(){return $("#product_color").val()?!!$("#product_size").val()||(openCartPopUp("Please Select Size"),!1):(openCartPopUp("Please Select Color"),!1)}function closeCartPopUp(){$("#popup_bgOverlay").css("display","none"),document.getElementById("popup_text_in").innerHTML="",$("body").css("overflow","auto")}function openCartPopUp(t){$("#popup_bgOverlay").css("display","block"),document.getElementById("popup_text_in").innerHTML+=t,$("body").css("overflow","hidden")}$(document).ready(function(){function t(){e||(e=setInterval(function(){$.fn.fullpage.moveSlideRight()},5e3))}$("#main-body").fadeIn();var e=null;$("#orderUser").change(function(){$.ajax({type:"GET",url:urlGetAddress,data:{data:$(this).val()},success:function(t){var e=$("#orderShipAddress"),a=$("#orderBillingAddress");e.empty(),a.empty(),e.append("<option value=''>Select Shipping Address</option>"),a.append("<option value=''>Select Billing Address</option>"),$.each(t,function(t,o){console.log(t+" and "+o),e.append("<option value='"+o.id+"'>"+o.nick_name+" [ "+o.zip_code+" ]</option>"),a.append("<option value='"+o.id+"'>"+o.nick_name+" [ "+o.zip_code+" ]</option>")})}})}),$("#orderProduct").change(function(){$.ajax({type:"GET",url:urlGetProduct,data:{data:$(this).val()},success:function(t){var e=$("#orderTotal");e.val(""),e.val(t.product_total)}})}),$(".rate-shop").rate({readonly:!0}),$("#shopPage_select").change(function(){$("#shop_sort_form").submit()}),$(".vestidos-check").on("click",function(){$("#shop_sort_form").submit()}),$(".nav-toggle-li").hover(function(){$(this).toggleClass("active"),$(this).find("ul").toggleClass("active")}),$(".navbar-vesti-cart").hover(function(){$(".vesti-cart-top").toggleClass("active")}),$(".nav-item-lang").hover(function(){$(".vesti-lang-top").toggleClass("active")});var a=!1;!function(){$("#fullpage").fullpage({navigation:!1,autoScrolling:!1,responsiveWidth:900,scrollBar:!0,menu:".navbar",afterRender:function(){t()},afterResponsive:function(t){a=t,t?($("#top_middle_sec_row #top_middle_img1,#top_middle_sec_row #top_middle_img2,#top_middle_sec_row #top_middle_img3").removeClass("active"),$(".brands_txt > div").css("margin-left","auto"),$(".quince_thumb").addClass("active")):$(".vestidos-main-nav-top").removeClass("show")},afterLoad:function(o,n){if("1"!=n||e||t(),2!=n||a||$("#top_middle_sec_row #top_middle_img1,#top_middle_sec_row #top_middle_img2,#top_middle_sec_row #top_middle_img3").addClass("active"),5==n&&!a){$("#quince_thumb_1").addClass("active");var i=$(".quince_thumb"),n=1,s=setInterval(function(){n<=i.length?($(i[n]).addClass("active"),n+=1):clearInterval(s)},300)}},onLeave:function(t,a){"1"==t&&(clearInterval(e),e=null)}})}(),$(window).on("resize",function(){$("#vesti-main-nav-btn").removeClass("open"),$(".vestidos-main-nav-top").removeClass("show")}),$("#main_slider_arrow_cont .vesti-down-arrow").click(function(t){t.preventDefault(),$.fn.fullpage.moveSectionDown()}),$("#vesti-main-nav-btn").click(function(){$(this).toggleClass("open")}),$(".collapse-link").click(function(){$(this).closest(".nav-item").toggleClass("hover")}),$(".vesti-cart-quantity-input").click(function(){$(this).select()}),$(".product_thumnb_link").click(function(t){t.preventDefault();var e=$($(t.target).closest("img")).attr("src");$(".product_main_img_in").find("img").attr("src",e)}),$("#popup_bgOverlay").click(function(){closeCartPopUp()}),$(".rate-view").rate({readonly:!0}),$(".checkout-button,.loader-button").on("click",function(){$(this).css("display","none"),$("#vesti-load").css("display","block")}),$(".oval-button").on("click",function(){$(this).css("display","none"),$("#vesti-load-oval").css("display","block")})});