<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="apple-touch-icon" sizes="57x57" href="{{ asset('images/favicon') }}/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="{{ asset('images/favicon') }}/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('images/favicon') }}/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/favicon') }}/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('images/favicon') }}/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="{{ asset('images/favicon') }}/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="{{ asset('images/favicon') }}/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/favicon') }}/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon') }}/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('images/favicon') }}/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon') }}/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/favicon') }}/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon') }}/favicon-16x16.png">
<link rel="manifest" href="{{ asset('images/favicon') }}/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="{{ asset('images/favicon') }}/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" type="text/css" href="{{ asset('js/vendor/fullpage/jquery.fullPage.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
     <title>Vestidos Boutique - {{ $page_title }}</title>
 <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('js/vendor/fullpage/jquery.fullPage.js') }}"></script>
<script src="{{ asset('js/vendor/rater/rater.js') }}" charset="utf-8"></script>
<script src="{{ asset('js/vestidos.js') }}"></script>
<script src="https://www.google.com/recaptcha/api.js?render={{ $configData['recapchav3_site'] }}"></script>
</head>
<style>
#modal-black-bg{
    position: absolute;
    z-index:100000;
    width: 100%;
    height: 100%;
    display:none;
    background-color: rgba(255,255,255,0.4);
}
#modal-pnl{
    background-color: white;
    position: absolute;

    top: 50%;
    left:0;
    right:0;
    margin: -100px auto auto auto;
}
#modal-close-pnl{
    text-align: right;
    padding: 0px 10px;
    font-size: 1.2rem;
}
#modal-title-pnl{
    text-align:center;
}
#modal-in-pnl{
    padding: 10px 10px 20px 10px;
    text-align: center;
}
#modal-pnl #modal-close-pnl a{
    color:black;
    text-decoration:none;
}
#modal-pnl #modal-close-pnl a:hover{
    text-decoration:none;
}
#modal-pnl #modal-close-pnl a div{
    display:inline-block;
    -webkit-transition: -webkit-transform .5s ease-in-out;
    transition:transform .5s ease-in-out;
}
#modal-close-svg{
    width:15px;
}
.rotate{
    -webkit-transform: rotate(90deg);
    transform: rotate(90deg);
    -moz-transform: rotate(90deg);
    -ms-transform: rotate(90deg);
    -o-transform: rotate(90deg);
    filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
}
.rerotate{
    -webkit-transform: rotate(-90deg);
    transform: rotate(-90deg);
    -moz-transform: rotate(-90deg);
    -ms-transform: rotate(-90deg);
    -o-transform: rotate(-90deg);
    filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
}


</style>
<script>
function openModalAlert(){
    $("html,body").css("overflow","hidden");
    $("#modal-black-bg").fadeIn();
}
function closeModalAlert(){
    $("#modal-black-bg").fadeOut();
    $("html,body").css("overflow","auto");
}
$(document).ready(function(){
    setTimeout(function(){
        openModalAlert();
    },2000)

    $("#modal-close-pnl a").hover(function(){
        $("#modal-close-pnl a div").removeClass("rerotate").stop(true,true).addClass("rotate")
    },function(){
        $("#modal-close-pnl a div").removeClass("rotate").stop(true,true).addClass("rerotate")
    })
})
</script>
<body id="main-body">
<div id="modal-black-bg">
    <div id="modal-pnl" class="col-lg-5 col-sm-12">
        <div id="modal-close-pnl"><a href="javascript:closeModalAlert()">
        <div><svg version="1.1" id="modal-close-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                viewBox="0 0 16 16" enable-background="new 0 0 16 16" xml:space="preserve">
            <g>
                <path fill="black" d="M9.1,8L14,3.1c0.3-0.3,0.3-0.8,0-1.1c-0.3-0.3-0.8-0.3-1.1,0L8,6.9L3.1,2C2.8,1.7,2.3,1.7,2,2
                    C1.7,2.3,1.7,2.8,2,3.1L6.9,8L2,12.9c-0.3,0.3-0.3,0.8,0,1.1c0.2,0.2,0.3,0.2,0.5,0.2c0.2,0,0.4-0.1,0.5-0.2L8,9.1l4.9,4.9
                    c0.2,0.2,0.3,0.2,0.5,0.2s0.4-0.1,0.5-0.2c0.3-0.3,0.3-0.8,0-1.1L9.1,8z"/>
            </g>
        </svg>
        </div>
        </a></div>
        <div id="modal-title-pnl">Title</div>
        <div id="modal-in-pnl">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Amet adipisci sit, qui neque aperiam minus unde cum explicabo libero commodi quisquam natus, repudiandae nam dolor enim a, itaque expedita assumenda? Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio quos nihil cum dicta, sed maxime porro nobis error voluptatibus commodi quaerat libero hic eveniet aut rem. Explicabo voluptates dolorem fugiat?</div>
    </div>
</div>
<div class="pos-f-t" >
    <nav class="navbar vest-maincolor vestidos-main-nav navbar-inverse navbar-fixed-top navbar-expand-md navbar-light">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand text-white" href="/" >
                    <img src="{{ asset('images/logo_text_vestidos_online.svg') }}" class="vesti-svg vestidos-logo"/>
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
                     <!-- <li class="nav-item">
                        <a class="nav-link text-white playfair-display-italic" href="{{ route('shop_page') }}">{{ __('header.shop') }}</a>
                    </li> -->
                    @foreach($events as $event)
                    @if($event->set_menu)
                    <li class="nav-item">
                        <a class="nav-link text-white playfair-display-italic" href="{{ route('shop_page',['type'=>'event','id'=>$event->id])}}">{{$event->name}}</a>
                    </li>
                    @endif
                    @endforeach
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
                                   <div class="col"><a class="btn-block vesti_in_btn_b" href="{{ $main_config->allow_shipping ? route('checkout_show_shipping') : route('checkout_show_billing') }}">{{ __('header.checkout') }}</a></div>
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
                                @foreach($events as $event)
                                @if($event->set_menu)
                                <li><a href="{{ route('shop_page',['type'=>'event','id'=>$event->id])}}">{{$event->name}}</a></li>
                                @endif
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
                        <a class="nav-link text-white collapse-link" href="{{ route('terms_use') }}">{{ __('header.terms') }}</a>
                    </li>
                    <li class="nav-item mobile">
                        <a class="nav-link text-white collapse-link" href="{{ route('privacy_use') }}">{{ __('header.privacy') }}</a>
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