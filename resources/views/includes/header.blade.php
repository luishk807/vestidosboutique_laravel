<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" type="text/css" href="{{ asset('js/vendor/fullpage/jquery.fullPage.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
     <title>Vestidos Boutique - {{ $page_title }}</title>


 <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

<script type="text/javascript" src="{{ asset('js/vendor/fullpage/jquery.fullPage.js') }}"></script>
<script src="{{ asset('js/vendor/rater/rater.js') }}" charset="utf-8"></script>
<script src="{{ asset('js/vestidos.js') }}"></script>
<script>
    var addWishlistUrl = "{{ url('api/saveWishlist') }}";
</script>
<style>
.nav-item.mobile a{
    padding:12px 18px !important;
}
.nav-item.mobile ul{
    background-color:#851a1d;
}
.nav-item.mobile .nav-list a{
    display:block;
    padding:5px 18px !important;
}
/*************************************************/
/*           PHONE PORTRAIT                      */
/************************************************/
@media only screen 
and (min-device-width : 375px) 
and (max-device-width : 812px)
and (-webkit-device-pixel-ratio : 3) { 
    /*****************MAIN SLIDER*********************/
    #main_slider_arrow_cont{
       display:block;
    }
    #main_slider_arrow_cont{
      display:none !important;
    }
    .main_slider_in,
    .main_slider_txt{
        text-align:center;
    }
    
    #home_main_slider .container .row{
        padding:10px 0px;
    }
    #home_main_slider .main_slider_btn{
        text-align:center
    }
    #home_main_slider .slide{
        position:relative;
    }
    #home_main_slider .text-cont{
        position: absolute;
        bottom:50px !important;
    }
    .main_slider_txt span:nth-child(3), 
    .main_slider_txt span:nth-child(1) {
        font-size: 2.5rem !important;
        color: white;
        text-shadow: 0px 2px 8px black;
    }
    #home_main_slider .slide{
        position:relative;
    }
    .btn-vesti-slide{
        border: 1px solid #a2191d;
        padding: 10px 80px;
        font-size: 1.5rem;
        margin: 20px 0;
        background-color: #a2191d;
        color:white;
    }

   /****************HOME PAGE *****************/
    #top_middle_img1 img,
    #top_middle_img2 img,
    #top_middle_img3 img{
        width:100%;
    }
    .brands_img img,
   .quince_img img{
       width:100%;
   }
   .brands_img img,
   .quince_img img{
       display:block;
   }
    #brands_section{
        background-image:none;
    }
    #fp-nav, .fp-controlArrow{
        display:none !important;
    }
    #brands_section .brands_txt div:last-child{
        text-align:center;
    }

    #top_middle_sec{
        padding-top: 26px;
    }
    #top_middle_sec .intro .row > div{
        padding:0px !important;
    }
    .top_middle_sec_title2{
        font-size:1rem;
        line-height:2rem;
    }
    #top_middle_sec_row{
        position:relative;
        height:auto;
    }
    #top_middle_sec_row #top_middle_img1,
    #top_middle_sec_row #top_middle_img2,
    #top_middle_sec_row #top_middle_img3{
        position:relative;
        top:0px;
        left:0px !important;

        -webkit-transition: left 1s;
        -moz-transition: left 1s;
        -o-transition: left 1s;
        transition: left 1s;
    }
    .top_middle_sec_title{
        font-size:2rem;
    }
    #brands_section .fp-tableCell,
    #quince_main .fp-tableCell{
        min-height: 500px !important;
        height: auto !important;
    }
    #brands_section > div,
    #quince_main > div{
        vertical-align: top;
    }
    #brands_section,
    #quince_main{
        height:auto !important;
    }
    #brands_section .brands_txt div:first-child{
        font-size:2rem;
    }
    #brands_section .brands_txt div:last-child{
        font-size:1rem;
    }
    .quince-select-title{
        font-size:2rem;
    }
    #quince_main .quince_txt div:first-child{
        font-size:2rem;
    }
    #quince_main .quince_txt div:last-child{
        font-size:1rem;
    }
 
    #top_middle_sec .intro .row > div{
        padding:0px !important;
    }
    #top_middle_img1,
    #top_middle_img2,
    #top_middle_img3{
        margin:10px auto;
        width:auto;
    }


  /***********ABOUT PAGE**************/
    .col-lg-9{
        padding:0px;
    }
    .container-in-space{
        width:auto !important;
        margin: 50px auto 0px auto !important;
    }
  /*********** CART PAGE **************/
    .cart-container-in h2{
        position:static;
    }
    .cart-container-in .cart-item-header{
        display:none;
    }
    .cart-container-in .cart-item-img{
        width:100%;
    }
    .cart-item-items .cart-item-1 .col:nth-child(2) div p{
        line-height: 1rem;
    }
    .vesti-cart-quantity-input{
        border:none;
    }
    .cart-item-items .cart-item-1 .col:nth-child(2) div p:not(:first-child){
        line-height: 1rem;
        margin: 5px 0px;
    }

    /*****************USER ACCOUNT**************/
    #user-account-menu{
        display:none;
    }


}
/*************************************************/
/*          IPAD PORTRAIT                       */
/************************************************/
@media only screen 
and (min-device-width : 768px) 
and (max-device-width : 1024px) 
and (orientation : portrait) {

   /************USER ACOUNT ************/
        #user-body .white-md-bg-in{
        padding:50px 0px;
    }

    

    /**********MAIN SLIDER*****************/

    .main_slider_in{
        text-align:center;
    }
    .main_slider_btn{
        text-align:center;
    }
    .main_slider_txt{
        text-align:center;
    }

    .btn-vesti-slide {
        border: 1px solid #a2191d;
        padding: 10px 80px;
        font-size: 1.5rem;
        margin: 20px 0;
        background-color: #a2191d;
        color: white;
    }

    .btn-vesti-slide:hover{
        border:1px solid #a2191d;
        background-color:white;
        color:#a2191d;
    }
    #home_main_slider .text-cont{
        position: absolute;
        bottom: 200px;
        font-size: 3rem;
        color: white;
    }
    .main_slider_txt span:nth-child(3), 
    .main_slider_txt span:nth-child(1) {
        font-size: 3rem;
        color: white;
        text-shadow: 0px 2px 8px black;
    }

    /***************HOME PAGE*****************/
    #brands_section{
        background-position-x: -450px;
    }
     #top_middle_sec_row #top_middle_img1{
     left:0px;
     }
     #top_middle_sec_row #top_middle_img2{
     left:240px;
     }
     #top_middle_sec_row #top_middle_img3{
     left:478px;
     }
     #top_middle_sec_row {
        height: 400px;
    }
    #brands_section .brands_txt div:last-child {
        text-align: right;
        max-width: 548px;
    }
    #quince_main {
        background-position-x: -500px;
    }
}
/*************************************************/
/*          IPAD LANDSCAPE                       */
/************************************************/
@media only screen 
and (min-device-width : 768px) 
and (max-device-width : 1024px) 
and (orientation : landscape) {

    #brands_section{
        background-position-x: -200px;
    }
    #brands_section .brands_txt div:first-child {
        font-size: 3rem;
    }
    #brands_section .text-left .brands_txt{
    text-align: left!important;
    margin-left: 300px;
    }
    #brands_section .brands_txt div:last-child {
    font-size: 1.5rem;
    }
    #top_middle_sec{
        margin:50px 0px;
    }
    #top_middle_sec_row{
        height:550px;
    }

    #top_middle_sec_row #top_middle_img1.active{
     left:0px;
     }
     #top_middle_sec_row #top_middle_img2.active{
     left:320px;
     }
     #top_middle_sec_row #top_middle_img3.active{
     left:640px;
     }

     
}
/*************************************************/
/*          IPHONE LANDSCAPE                     */
/************************************************/
@media only screen and (max-device-width: 812px) and (orientation: landscape) {

    /**************MAIN SLIDER**************/
    #top_middle_sec_row .vesti-new-txt-a, #quince_selec_sec .vesti-new-txt-a {
        top: 12px !important;
        left: 9px !important;
    }
    #home_main_slider .text-cont{
        max-width:100% !important;
    }
    #main_slider_arrow_cont{
        display:none;
    }
    .main_slider_txt{
     padding-top: 20px;
    }
    .fp-controlArrow.fp-prev, .fp-controlArrow.fp-next{
        display:none;
    }

    #home_main_slider .fp-tableCell{
     vertical-align: middle;
    }
    #home_main_slider .main_slider_btn{
     text-align: center;
    }
    #home_main_slider .container .main_slider_txt span:nth-child(1),
    #home_main_slider .container .main_slider_txt span:nth-child(3){
     font-size: 2rem !important;
    }
    #home_main_slider .container .main_slider_txt .main_slider_in{
     padding-right: 33px;
    }
    .slide-slide{
        background-position: top center;
       }
    .btn-vesti-slide{
     padding: 5px 53px;
     font-size: 1rem;
    }

    /************HOME PAGE *************/
    #quince_main {
    background-image:none;
}
    #top_middle_sec #top_middle_sec_row img{
        width:220px;
    }
    #top_middle_sec .container{
        max-width:770px;
    }
    #top_middle_sec #top_middle_sec_row{
     height: 381px;
    }
     #top_middle_sec_row #top_middle_img1{
     left:0px;
     }
     #top_middle_sec_row #top_middle_img2{
     left:240px;
     }
     #top_middle_sec_row #top_middle_img3{
     left:478px;
     }
     #top_middle_sec_row .vesti-heart-link{
         right: 8px;
     }
     #top_middle_sec_row .vesti-new-txt-a,
     #quince_selec_sec .vesti-new-txt-a{
         font-size: .8rem;
         top: 12px;
         left: 24px;
     }
     #top_middle_sec_row .vesti-new-border-a,
     #quince_selec_sec .vesti-new-border-a{
         border-top: 70px solid #a2191d;
         border-right: 70px solid transparent;
     }
     #fp-nav{
         display:none
     }
     #top_middle_sec .top_middle_sec_title2{
         font-size: 1.6rem;
     }
     .brands_txt > div,
     .quince_txt > div{
         max-width: 412px;
     }
     .brands_txt>div{
         margin-left: auto !important;
     }
     #brands_section .brands_txt div:first-child,
     #quince_main .quince_txt div:first-child{
         font-size: 2rem;
         text-align: left;
     }
     #quince_main,
     #brands_section{
         padding-bottom:20px !important;
     }
     #brands_section .brands_txt div:last-child,
     #quince_main .quince_txt div:last-child{
         font-size: 1rem;
     }
     #quince_selec_sec .quince-select-title{
         font-size: 2rem;
     }
     /***********ABOUT PAGE**************/
    .col-lg-9{
        padding:0px;
    }
    .container-in-space{
        width:auto !important;
        margin: 50px auto 0px auto !important;
    }
    /**** CART PAGE *****/
      .cart-container-in h2{
        position:static;
    }
    .cart-container-in .cart-item-img{
        width:100%;
    }
    .cart-item-items .cart-item-1 .col:nth-child(2) div p{
        line-height: 1rem;
    }
    .cart-item-items .cart-item-1 .col:nth-child(2) div p:not(:first-child){
        line-height: 1rem;
        margin: 5px 0px;
    }
    /*****************USER ACCOUNT**************/
    #user-account-menu{
        display:none;
    }

 }
</style>
<script>
$(document).ready(function(){
    $("#vesti-navbar-top-lang,#nav-item-events").click(function(e){
        e.preventDefault();
    });
});
</script>
</head>
<body id="main-body">
<div class="pos-f-t" >
     <!-- <div id="vestidos-top-news" class="container-fluid navbar-fixed-top">
        <div class="row">
            <div class="col">
              Order Now for Free Shipping
            </div>
        </div>
     </div> -->
    <nav class="navbar vest-maincolor vestidos-main-nav navbar-inverse navbar-fixed-top navbar-expand-md navbar-light">
        <div class="vest-maincolor-container container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand text-white" href="/" >
                    <img src="{{ asset('images/logo_text_only_white.svg') }}" class="vesti-svg vestidos-logo"/>
                </a>
            </div>
            <button id='vesti-main-nav-btn' class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="vest-maincolor-left navbar-nav mr-auto">
                     <li class="nav-item">
                        <a class="nav-link text-white playfair-display-italic" href="{{ route('shop_page') }}">{{ __('header.shop') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white playfair-display-italic" href="{{ route('about_page')}}">{{ __('header.about') }}</a>
                    </li>
                    <li class="nav-item nav-toggle-li">
                        <a id="nav-item-events" class="nav-link text-white playfair-display-italic dropdown-toggle" href="#">{{ __('header.event') }}</a>
                        <ul class="nav-list-submenu">
                            <li>
                                <ul>
                                    <!-- @foreach($categories as $category)
                                    <li><a href="{{ $category->id }}">{{$category->name}}</a></li>
                                    @endforeach -->
                                    <li><a href="">testing</a></li>
                                    <li><a href="">testing</a></li>
                                    <li><a href="">testing</a></li>

                                    <li><a href="">testing</a></li>
                                    <li><a href="">testing</a></li>
                                    <li><a href="">testing</a></li>
                                    <li><a href="">testing</a></li>
                                    <li><a href="">testing</a></li>
                                    <li><a href="">testing</a></li>
                                </ul>

                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white playfair-display-italic" href="{{ route('viewContactPage') }}">{{ __('header.contact') }}</a>
                    </li>
                </ul>
                <ul class="vest-maincolor-right nav navbar-nav navbar-right">
                    <li class="nav-item nav-item-lang">
                        <a id="vesti-navbar-top-lang" class="text-white navbar-link-lang" href=''>
                            
                            <img src="{{ asset('images/globe.svg') }}" class="vesti-svg vestidos-icons-globe"/><span>{{ strtoupper(Session::get('locale') ? Session::get('locale'):App::getLocale()) }}</span>
                        </a>
                        
                        <ul class="vesti-lang-top">
                        @foreach(\App\vestidosLanguages::where('status','=',1)->get() as $language)
                            <li><a class="text-white" href="{{ route('set_language',['lang'=>$language->code])}}">{{$language->name}}</a></li>
                        @endforeach
                        </ul><!--end of hover menu-->

                    </li>
                    <li class="nav-item">
                    @if(Auth::guard('vestidosUsers')->check())
                    <a class="navbar-link text-white playfair-display-italic" href="{{route('user_account')}}">{{ __('header.account') }}</a>
                    @else
                    <a class="navbar-link text-white playfair-display-italic" href="{{route('login_page')}}">{{ __('header.log_in') }}</a>
                    @endif
                    </li>
                    <li class="nav-item navbar-vesti-cart"><a id="vesti-navbar-top-link" class="navbar-link text-white playfair-display-italic" href="/cart">
                    {{ __('header.cart') }}<img class="vesti-svg vestidos-icons-header vesti-navbar-bag" src="{{ asset('images/shop-bag.svg') }}" alt="icon name"></a>
                        <!-- <div id="vesti-cart-top-cont">
                        <div class="vesti-cart-arrow"></div>
                        <div class="vesti-cart-arrow-b"></div> -->
                        @if(Session::has('vestidos_shop'))
                        <div class="vesti-cart-top">
                           
                           <div class="container">
                                @php( $header_cart_total=0 )
                                @foreach(Session::get('vestidos_shop') as $header_cart_key=>$header_cart)
                               <div class="row cart-top-items"> <!--item-->
                                   <div class="col-md-4"><span><a href=""><img src="{{ asset('/images/products') }}/{{ $header_cart['image']}}" alt width="100%"/></a></span></div>
                                   <div class="col-md-8 cart-top-item-txt">
                                       <div>
                                       <p><a href="/product/{{ $header_cart['id']}}">{{ $header_cart["name"] }}</a></p>
                                       <p>{{ trans_choice('general.product_title.price',1) }}: ${{ number_format($header_cart["total"],2) }}</p>
                                       <p>{{ trans_choice('general.product_title.size',1) }}: {{ $header_cart["size"] }}</p>
                                       <p>{{ trans_choice('general.product_title.color',1) }}: {{ $header_cart["color"] }}</p>
                                       <p>{{ trans_choice('general.cart_title.quantity',1) }}: {{ $header_cart["quantity"] }}</p>
                                        </div>
                                        <div>
                                            <a href="javascript:deleteCart('{{ $header_cart_key }}')">{{ __('buttons.remove') }}</a>
                                        </div>
                                   </div>
                               </div><!--end of item-->
                               
                               @php( $header_cart_total +=$header_cart["total"] * $header_cart["quantity"] )
                               @endforeach
                               <div class="row cart-top-totals">
                                   <div class="col">{{ __('general.cart_title.subtotal') }}: ${{ number_format($header_cart_total,2) }}</div>
                               </div>
                               <div class="row cart-top-buttons">
                                   <div class="col"><a class="btn-block vesti_in_btn_b" href="{{ route('cart_page') }}">{{ __('header.cart') }}</a></div>
                                   <div class="col"><a class="btn-block vesti_in_btn_b" href="{{ route('checkout_show_shipping') }}">{{ __('header.checkout') }}</a></div>
                               </div>
                               
                           </div>
                        </div><!--end of hover menu-->
                        @endif
                        <!-- </div> -->
                        
                    </li>
                </ul>
            </div>
        </div>
    </nav>

        <div class="collapse vestidos-main-nav-top" id="navbarToggleExternalContent">
            <div class="vesti-custom-bg">
                <ul class="navbar-nav mr-auto">
                     @if(Auth::guard('vestidosUsers')->check())
                    <li class="nav-item mobile">
                        <a class="nav-link text-white collapse-link dropdown-toggle" href="{{ route('user_account')}}"  data-toggle="collapse" class="collapsed" data-target="#toggle-acct">{{ __('header.account') }}</a>
                        <div class="collapse vesti-collapse" id="toggle-acct" style="height: 0px;">
                            <ul class="nav-list">
                                <li><a href="{{ route('user_account')}}">{{ __('header.profile') }}</a></li>
                                <li><a href="{{ route('user_orders') }}">{{ __('header.orders') }}</a></li>
                                <li><a href="{{ route('user_wishlists') }}">{{ __('header.wishlists') }}</a></li>
                            </ul>
                        </div>
                    </li>
                    @endif
                    <li class="nav-item mobile">
                        <a class="nav-link text-white collapse-link" href="{{ route('shop_page') }}">{{ __('header.shop') }}</a>
                    </li>
                    <li class="nav-item mobile">
                        <a class="nav-link text-white collapse-link" href="{{route('about_page')}}">{{ __('header.about') }}</a>
                    </li>
                    <li class="nav-item mobile">
                        <a class="nav-link text-white collapse-link dropdown-toggle" href="#"  data-toggle="collapse" class="collapsed" data-target="#toggle-events">{{ __('header.event') }}</a>
                        <div class="collapse vesti-collapse" id="toggle-events" style="height: 0px;">
                            <ul class="nav-list">
                                @foreach($categories as $category)
                                <li><a href="#">{{$category->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item mobile">
                        <a class="nav-link text-white collapse-link dropdown-toggle" href="#"  data-toggle="collapse" class="collapsed" data-target="#toggle-lang">{{ __('header.language') }}</a>
                        <div class="collapse vesti-collapse" id="toggle-lang" style="height: 0px;">
                            <ul class="nav-list">
                                @foreach(\App\vestidosLanguages::where('status','=',1)->get() as $language)
                                    <li><a href="{{ route('set_language',['lang'=>$language->code])}}">{{$language->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item mobile">
                        <a class="nav-link text-white collapse-link" href="{{ route('viewContactPage') }}">{{ __('header.contact') }}</a>
                    </li>
                </ul>

                <div>

                <div id="vesti-custom-bottom" class="container">
                    <div class="row">
                        <div class="col text-white">
                            @if(Auth::guard('vestidosUsers')->check())
                            <a href="{{route('logout_user')}}">{{ __('header.log_out') }}</a>
                            @else
                            <a href="{{route('login_page')}}">{{ __('header.log_in') }}</a>
                            @endif
                        </div>
                        <div class="col text-white">
                            <a href="/cart">{{ __('header.cart') }}</a>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
</div>