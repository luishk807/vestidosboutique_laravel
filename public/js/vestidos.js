function addWishlist(e){$.ajax({type:"GET",url:addWishlistUrl,data:{data:e},success:function(e){"login"==e.status?window.location.href="/signin":"insert"==e.status?$(".product_main_img_in a >.vesti-svg").addClass("active"):"deleted"==e.status&&$(".product_main_img_in a > .vesti-svg").removeClass("active")}})}function updateCart(e,t){document.location="api/updateCart?key="+e+"&quantity="+t}function deleteCart(e){document.location="api/deleteCart?key="+e}function loadDropDown(e,t,o){$.ajax({type:"GET",url:o,data:{data:$(e).val()},success:function(e){var o=$(t);o.empty(),$.each(e,function(e,t){o.append("<option value='"+t.id+"'>"+t.name+"</option>")})}})}function loadSizes(e){"undefined"!=typeof urlColorSizes&&$.ajax({type:"GET",url:urlColorSizes,data:{data:e},success:function(e){var t=$("#size-container");t.empty();var o=0;$total_size=0,$.each(e,function(e,a){0==o?(loadSizeDropDown(a.id),t.append("<button class='size_spheres selected' onclick='addCart(event)' data-class='size_spheres' data-input='product_size' data-value='"+a.id+"'>"+a.name+"</button>"),$("#product_size").val(a.id),getPriceInfo(a.id)):t.append("<button class='size_spheres' onclick='addCart(event)' data-class='size_spheres' data-input='product_size' data-value='"+a.id+"'>"+a.name+"</button>"),o++})}})}function loadSizeDropDown(e){"undefined"!=typeof urlProductQuantity&&$.ajax({type:"GET",url:urlProductQuantity,data:{data:e},success:function(e){var t=0;(e<1||!e||"object"==typeof e&&!e.length)&&(e=11),t=e>10?10:e;var o=$("#product_quantity");o.empty();for(var a=0;a<t;a++){var n=a+1;o.append("<option value='"+n+"'>"+n+"</option>")}}})}function addCart(e){e.preventDefault();var t=$(e.target).attr("data-value"),o=$(e.target).attr("data-input"),a=$(e.target).attr("data-class");$("."+a).removeClass("selected"),$(e.target).addClass("selected"),$("#"+o).val(t),"product_size"==o?(loadSizeDropDown(t),getPriceInfo(t)):"product_color"==o&&loadSizes($(e.target).attr("data-value"))}function getPriceInfo(e){"undefined"!=typeof urlLoadSizeInfo&&$.ajax({type:"GET",url:urlLoadSizeInfo,data:{data:e},success:function(e){$(".product_in_price span").text(e.total_sale),$(".shoplist-stock-txt span").removeClass(),e.stock>3?$(".shoplist-stock-txt span").addClass("stock").text(e.stock_msg):e.stock>0&&e.stock<4?$(".shoplist-stock-txt span").addClass("out-stock").text(e.stock_msg):e.stock<1&&$(".shoplist-stock-txt span").addClass("out-stock").text(e.stock_msg),e.stock>0?($("#product_out_stock_btn").css("display","none"),$("#product_addCart_btn").css("display","block")):($("#product_out_stock_btn").css("display","block"),$("#product_addCart_btn").css("display","none"))}})}function checkCartSubmit(){return $("#product_color").val()?!!$("#product_size").val()||(openCartPopUp("Please Select Size"),!1):(openCartPopUp("Please Select Color"),!1)}function closeCartPopUp(){$("#popup_bgOverlay").css("display","none"),document.getElementById("popup_text_in").innerHTML="",$("body").css("overflow","auto")}function openCartPopUp(e){$("#popup_bgOverlay").css("display","block"),document.getElementById("popup_text_in").innerHTML+=e,$("body").css("overflow","hidden")}$(document).ready(function(){function e(){t||(t=setInterval(function(){$.fn.fullpage.moveSlideRight()},5e3))}$("#main-body").fadeIn();var t=null;$("#orderUser").change(function(){$.ajax({type:"GET",url:urlGetAddress,data:{data:$(this).val()},success:function(e){var t=$("#orderShipAddress"),o=$("#orderBillingAddress");t.empty(),o.empty(),t.append("<option value=''>Select Shipping Address</option>"),o.append("<option value=''>Select Billing Address</option>"),$.each(e,function(e,a){console.log(e+" and "+a),t.append("<option value='"+a.id+"'>"+a.nick_name+" [ "+a.zip_code+" ]</option>"),o.append("<option value='"+a.id+"'>"+a.nick_name+" [ "+a.zip_code+" ]</option>")})}})}),$("#orderProduct").change(function(){$.ajax({type:"GET",url:urlGetProduct,data:{data:$(this).val()},success:function(e){var t=$("#orderTotal");t.val(""),t.val(e.product_total)}})});var o=$(".product_in_colors button.selected");o&&(o.trigger("click"),loadSizes(o.attr("data-value"))),$(".rate-shop").rate({readonly:!0}),$("#shopPage_select").change(function(){$("#shop_sort_form").submit()}),$(".vestidos-check").on("click",function(){$("#shop_sort_form").submit()}),$(".nav-toggle-li").hover(function(){$(this).toggleClass("active"),$(this).find("ul").toggleClass("active")}),$(".navbar-vesti-cart").hover(function(){$(".vesti-cart-top").toggleClass("active")}),$(".nav-item-lang").hover(function(){$(".vesti-lang-top").toggleClass("active")});var a=!1;!function(){$("#fullpage").fullpage({navigation:!1,autoScrolling:!1,responsiveWidth:900,scrollBar:!0,menu:".navbar",afterRender:function(){e()},afterResponsive:function(e){a=e,e?($("#top_middle_sec_row #top_middle_img1,#top_middle_sec_row #top_middle_img2,#top_middle_sec_row #top_middle_img3").removeClass("active"),$(".brands_txt > div").css("margin-left","auto"),$(".quince_thumb").addClass("active")):$(".vestidos-main-nav-top").removeClass("show")},afterLoad:function(o,n){if("1"!=n||t||e(),2!=n||a||$("#top_middle_sec_row #top_middle_img1,#top_middle_sec_row #top_middle_img2,#top_middle_sec_row #top_middle_img3").addClass("active"),5==n&&!a){$("#quince_thumb_1").addClass("active");var l=$(".quince_thumb"),n=1,s=setInterval(function(){n<=l.length?($(l[n]).addClass("active"),n+=1):clearInterval(s)},300)}},onLeave:function(e,o){"1"==e&&(clearInterval(t),t=null)}})}(),$(window).on("resize",function(){$("#vesti-main-nav-btn").removeClass("open"),$(".vestidos-main-nav-top").removeClass("show")}),$("#main_slider_arrow_cont .vesti-down-arrow").click(function(e){e.preventDefault(),$.fn.fullpage.moveSectionDown()}),$("#vesti-main-nav-btn").click(function(){$(this).toggleClass("open")}),$(".collapse-link").click(function(){$(this).closest(".nav-item").toggleClass("hover")}),$(".vesti-cart-quantity-input").click(function(){$(this).select()}),$(".product_thumnb_link").click(function(e){e.preventDefault();var t=$($(e.target).closest("img")).attr("src");$(".product_main_img_in").find("img").attr({src:t,"data-large-img-url":t})}),$("#popup_bgOverlay").click(function(){closeCartPopUp()}),$(".rate-view").rate({readonly:!0}),$(".checkout-button,.loader-button").on("click",function(){$(this).css("display","none"),$("#vesti-load").css("display","block")}),$(".oval-button").on("click",function(){$(this).css("display","none"),$("#vesti-load-oval").css("display","block")})});var Event=function(){"use strict";this.attach=function(e,t,o,a){var n="",l=void 0===a||a,s=null;return void 0===window.addEventListener?(n="on"+e,s=function(e,o){return t.attachEvent(e,o),o}):(n=e,s=function(e,o,a){return t.addEventListener(e,o,a),o}),s.apply(t,[n,function(e){var t=e||event,a=t.srcElement||t.target;o(t,a)},l])},this.detach=function(e,t,o,a){var n="",l=void 0===a||a;void 0===window.removeEventListener?(n="on"+e,t.detachEvent(n,o)):(n=e,t.removeEventListener(n,o,l))},this.stop=function(e){e.cancelBubble=!0,e.stopPropagation&&e.stopPropagation()},this.prevent=function(e){e.preventDefault?e.preventDefault():e.returnValue=!1}},Magnifier=function(e,t){"use strict";var o=t||{},a=null,n={x:0,y:0,w:0,h:0,lensW:0,lensH:0,lensBgX:0,lensBgY:0,largeW:0,largeH:0,largeL:0,largeT:0,zoom:2,zoomMin:1.1,zoomMax:5,mode:"outside",largeWrapperId:void 0!==o.largeWrapper?o.largeWrapper.id||null:null,status:0,zoomAttached:!1,zoomable:void 0!==o.zoomable&&o.zoomable,onthumbenter:void 0!==o.onthumbenter?o.onthumbenter:null,onthumbmove:void 0!==o.onthumbmove?o.onthumbmove:null,onthumbleave:void 0!==o.onthumbleave?o.onthumbleave:null,onzoom:void 0!==o.onzoom?o.onzoom:null},l={t:0,l:0,x:0,y:0},s=0,i=0,r="",d=null,u=null,c=void 0!==o.zoom?o.zoom:n.zoom,m=void 0!==o.zoomMin?o.zoomMin:n.zoomMin,p=void 0!==o.zoomMax?o.zoomMax:n.zoomMax,g=o.mode||n.mode,h={},v=!1,f=0,b=function(e){var t=[],o=null,a=0,n="",l=0,s=0;if(document.getElementsByClassName)t=document.getElementsByClassName(e);else for(o=document.getElementsByTagName("*"),a=o.length,n=new RegExp("(^|\\s)"+e+"(\\s|$)"),s;l<a;l+=1)n.test(o[l].className)&&(t[s]=o[l],s+=1);return t},_=function(e){var t="",o=e.charAt(0),a=null;if("#"!==o&&"."!==o||(t=e.substr(1,e.length)),""!==t)switch(o){case"#":a=document.getElementById(t);break;case".":a=b(t)}return a},$=function(e,t){var o=document.createElement("div");o.id=t+"-lens",o.className="magnifier-loader",e.parentNode.appendChild(o)},z=function(){d.style.left=l.l+"px",d.style.top=l.t+"px",d.style.width=n.lensW+"px",d.style.height=n.lensH+"px",d.style.backgroundPosition="-"+n.lensBgX+"px -"+n.lensBgY+"px",u.style.left="-"+n.largeL+"px",u.style.top="-"+n.largeT+"px",u.style.width=n.largeW+"px",u.style.height=n.largeH+"px"},y=function(e,t,o,a){var n=_("#"+e+"-lens"),l=null;1===h[e].status?(l=document.createElement("div"),l.className="magnifier-loader-text",n.className="magnifier-loader hidden",l.appendChild(document.createTextNode("Loading...")),n.appendChild(l)):2===h[e].status&&(n.className="magnifier-lens hidden",n.removeChild(n.childNodes[0]),n.style.background="url("+t.src+") no-repeat 0 0 scroll",o.id=e+"-large",o.style.width=h[e].largeW+"px",o.style.height=h[e].largeH+"px",o.className="magnifier-large hidden","inside"===h[e].mode?n.appendChild(o):a.appendChild(o)),n.style.width=h[e].lensW+"px",n.style.height=h[e].lensH+"px"},x=function(){var e=l.x-n.x,t=l.y-n.y,o=0,a=0;v=!(e<0||t<0||e>n.w||t>n.h),a=e-n.lensW/2,o=t-n.lensH/2,"inside"!==n.mode&&(e<n.lensW/2&&(a=0),t<n.lensH/2&&(o=0),e-n.w+n.lensW/2>0&&(a=n.w-(n.lensW+2)),t-n.h+n.lensH/2>0&&(o=n.h-(n.lensH+2))),l.l=Math.round(a),l.t=Math.round(o),n.lensBgX=l.l+1,n.lensBgY=l.t+1,"inside"===n.mode?(n.largeL=Math.round(e*(n.zoom-n.lensW/n.w)),n.largeT=Math.round(t*(n.zoom-n.lensH/n.h))):(n.largeL=Math.round(n.lensBgX*n.zoom*(n.largeWrapperW/n.w)),n.largeT=Math.round(n.lensBgY*n.zoom*(n.largeWrapperH/n.h)))},w=function(e){var t=e.wheelDelta>0||e.detail<0?.1:-.1,o=n.onzoom,s=1,i=0,r=0;e.preventDefault&&e.preventDefault(),e.returnValue=!1,n.zoom=Math.round(10*(n.zoom+t))/10,n.zoom>=n.zoomMax?n.zoom=n.zoomMax:n.zoom>=n.zoomMin?(n.lensW=Math.round(n.w/n.zoom),n.lensH=Math.round(n.h/n.zoom),"inside"===n.mode?(i=n.w,r=n.h):(i=n.largeWrapperW,r=n.largeWrapperH,s=n.largeWrapperW/n.w),n.largeW=Math.round(n.zoom*i),n.largeH=Math.round(n.zoom*r),x(),z(),null!==o&&o({thumb:a,lens:d,large:u,x:l.x,y:l.y,zoom:Math.round(n.zoom*s*10)/10,w:n.lensW,h:n.lensH})):n.zoom=n.zoomMin},C=function(){n=h[r],d=_("#"+r+"-lens"),2===n.status?(d.className="magnifier-lens",!1===n.zoomAttached&&(void 0!==n.zoomable&&!0===n.zoomable&&(e.attach("mousewheel",d,w),window.addEventListener&&d.addEventListener("DOMMouseScroll",function(e){w(e)})),n.zoomAttached=!0),u=_("#"+r+"-large"),u.className="magnifier-large"):1===n.status&&(d.className="magnifier-loader")},k=function(){if(n.status>0){var e=n.onthumbleave;null!==e&&e({thumb:a,lens:d,large:u,x:l.x,y:l.y}),-1===d.className.indexOf("hidden")&&(d.className+=" hidden",a.className=n.thumbCssClass,null!==u&&(u.className+=" hidden"))}},M=function(){if(i!==n.status&&C(),n.status>0){a.className=n.thumbCssClass+" opaque",1===n.status?d.className="magnifier-loader":2===n.status&&(d.className="magnifier-lens",u.className="magnifier-large",u.style.left="-"+n.largeL+"px",u.style.top="-"+n.largeT+"px"),d.style.left=l.l+"px",d.style.top=l.t+"px",d.style.backgroundPosition="-"+n.lensBgX+"px -"+n.lensBgY+"px";var e=n.onthumbmove;null!==e&&e({thumb:a,lens:d,large:u,x:l.x,y:l.y})}i=n.status},W=function(e,t){var o=e.getBoundingClientRect(),a=0,n=0;t.x=o.left,t.y=o.top,t.w=Math.round(o.right-t.x),t.h=Math.round(o.bottom-t.y),t.lensW=Math.round(t.w/t.zoom),t.lensH=Math.round(t.h/t.zoom),"inside"===t.mode?(a=t.w,n=t.h):(a=t.largeWrapperW,n=t.largeWrapperH),t.largeW=Math.round(t.zoom*a),t.largeH=Math.round(t.zoom*n)};this.attach=function(e){if(void 0===e.thumb)throw{name:"Magnifier error",message:"Please set thumbnail",toString:function(){return this.name+": "+this.message}};var t=_(e.thumb),o=0;if(void 0!==t.length)for(o;o<t.length;o+=1)e.thumb=t[o],this.set(e);else e.thumb=t,this.set(e)},this.setThumb=function(e){a=e},this.set=function(t){if(void 0!==h[t.thumb.id])return a=t.thumb,!1;var o=new Image,i=new Image,v=t.thumb,b=v.id,z=null,w=null,E=_("#"+t.largeWrapper)||_("#"+v.getAttribute("data-large-img-wrapper"))||_("#"+n.largeWrapperId),N=t.zoom||v.getAttribute("data-zoom")||c,S=t.zoomMin||v.getAttribute("data-zoom-min")||m,H=t.zoomMax||v.getAttribute("data-zoom-max")||p,B=t.mode||v.getAttribute("data-mode")||g,P=void 0!==t.onthumbenter?t.onthumbenter:n.onthumbenter,A=void 0!==t.onthumbleave?t.onthumbleave:n.onthumbleave,D=void 0!==t.onthumbmove?t.onthumbmove:n.onthumbmove,I=void 0!==t.onzoom?t.onzoom:n.onzoom;if(w=void 0===t.large?null!==t.thumb.getAttribute("data-large-img-url")?t.thumb.getAttribute("data-large-img-url"):t.thumb.src:t.large,null===E&&"inside"!==B)throw{name:"Magnifier error",message:"Please specify large image wrapper DOM element",toString:function(){return this.name+": "+this.message}};void 0!==t.zoomable?z=t.zoomable:null!==v.getAttribute("data-zoomable")?z="true"===v.getAttribute("data-zoomable"):void 0!==n.zoomable&&(z=n.zoomable),""===v.id&&(b=v.id="magnifier-item-"+s,s+=1),$(v,b),h[b]={zoom:N,zoomMin:S,zoomMax:H,mode:B,zoomable:z,thumbCssClass:v.className,zoomAttached:!1,status:0,largeUrl:w,largeWrapperId:"outside"===B?E.id:null,largeWrapperW:"outside"===B?E.offsetWidth:null,largeWrapperH:"outside"===B?E.offsetHeight:null,onzoom:I,onthumbenter:P,onthumbleave:A,onthumbmove:D},e.attach("mouseover",v,function(e,t){0!==n.status&&k(),r=t.id,a=t,C(),W(a,n),l.x=e.clientX,l.y=e.clientY,x(),M();var o=n.onthumbenter;null!==o&&o({thumb:a,lens:d,large:u,x:l.x,y:l.y})},!1),e.attach("mousemove",v,function(e,t){f=1}),e.attach("load",o,function(){h[b].status=1,W(v,h[b]),y(b),e.attach("load",i,function(){h[b].status=2,y(b,v,i,E)}),i.src=h[b].largeUrl}),o.src=v.src},e.attach("mousemove",document,function(e){l.x=e.clientX,l.y=e.clientY,x(),!0===v?M():(0!==f&&k(),f=0)},!1),e.attach("scroll",window,function(){null!==a&&W(a,n)})};