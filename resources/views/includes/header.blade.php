<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" type="text/css" href="{{ asset('js/vendor/fullpage/jquery.fullPage.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
     <title>Vestidos Boutique Main - {{ $page_title }}</title>


 <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

<script type="text/javascript" src="{{ asset('js/vendor/fullpage/jquery.fullPage.js') }}"></script>
<script src="{{ asset('js/vendor/rater/rater.js') }}" charset="utf-8"></script>
<script src="{{ asset('js/vestidos.js') }}"></script>
<script>
    var addWishlistUrl = "{{ url('api/saveWishlist') }}";
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
    <nav class="navbar vest-maincolor vestidos-main-nav navbar-inverse navbar-fixed-top navbar-expand-lg navbar-light">
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
                        <a class="nav-link text-white playfair-display-italic" href="{{ route('shop_page') }}">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white playfair-display-italic" href="{{ route('about_page')}}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white playfair-display-italic dropdown-toggle" menu-target="events-submenu" href="#">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white playfair-display-italic" href="{{ route('viewContactPage') }}">Contact Us</a>
                    </li>
                </ul>
                <ul class="vest-maincolor-right nav navbar-nav navbar-right">
                    <li class="nav-item">
                    @if(Auth::guard('vestidosUsers')->check())
                    <a class="navbar-link text-white playfair-display-italic" href="{{route('user_account')}}">My Account</a>
                    @else
                    <a class="navbar-link text-white playfair-display-italic" href="{{route('login_page')}}">Login</a>
                    @endif
                    </li>
                    <li class="nav-item navbar-vesti-cart"><a id="vesti-navbar-top-link" class="navbar-link text-white playfair-display-italic" href="/cart">
                        Cart<img class="vesti-svg vestidos-icons-header vesti-navbar-bag" src="{{ asset('images/shop-bag.svg') }}" alt="icon name"></a>
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
                                       <p>Unit Price: ${{ number_format($header_cart["total"],2) }}</p>
                                       <p>Size: {{ $header_cart["size"] }}</p>
                                       <p>Color: {{ $header_cart["color"] }}</p>
                                       <p>Quantity: {{ $header_cart["quantity"] }}</p>
                                        </div>
                                        <div>
                                            <a href="javascript:deleteCart('{{ $header_cart_key }}')">Remove</a>
                                        </div>
                                   </div>
                               </div><!--end of item-->
                               
                               @php( $header_cart_total +=$header_cart["total"] * $header_cart["quantity"] )
                               @endforeach
                               <div class="row cart-top-totals">
                                   <div class="col">Subtotal: ${{ number_format($header_cart_total,2) }}</div>
                               </div>
                               <div class="row cart-top-buttons">
                                   <div class="col"><a class="btn-block vesti_in_btn_b" href="{{ route('cart_page') }}">View Cart</a></div>
                                   <div class="col"><a class="btn-block vesti_in_btn_b" href="{{ route('checkout_show_shipping') }}">Checkout</a></div>
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
    <div id="events-submenu" class="submenu-panel">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <ul>
                            @foreach($categories as $category)
                            <li><a href="{{ $category->id }}">{{$category->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
    </div>
    <div id="brands-submenu" class="submenu-panel">
         <div class="container">
                <div class="row">
                    <div class="col">
                        <ul>
                            @foreach($brands as $brand)
                            <li><a href="{{ $brand->id }}">{{$brand->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
    </div>

        <div class="collapse vestidos-main-nav-top" id="navbarToggleExternalContent">
            <div class="vesti-custom-bg">
                <ul class="navbar-nav mr-auto">
                     @if(Auth::guard('vestidosUsers')->check())
                    <li class="nav-item">
                        <a class="nav-link text-white collapse-link dropdown-toggle" href="{{ route('user_account')}}"  data-toggle="collapse" class="collapsed" data-target="#toggle-events">My Account</a>
                        <div class="collapse vesti-collapse" id="toggle-events" style="height: 0px;">
                            <ul class="nav-list">
                                <li><a href="{{ route('user_orders') }}">Orders</a></li>
                                <li><a href="{{ route('user_wishlists') }}">Wishlists</a></li>
                            </ul>
                        </div>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link text-white collapse-link" href="{{ route('shop_page') }}">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white collapse-link" href="{{route('about_page')}}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white collapse-link dropdown-toggle" href="#"  data-toggle="collapse" class="collapsed" data-target="#toggle-events">Events</a>
                        <div class="collapse vesti-collapse" id="toggle-events" style="height: 0px;">
                            <ul class="nav-list">
                                @foreach($categories as $category)
                                <li><a href="#">{{$category->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white collapse-link" href="{{ route('viewContactPage') }}">Contact Us</a>
                    </li>
                </ul>

                <div>

                <div id="vesti-custom-bottom" class="container">
                    <div class="row">
                        <div class="col text-white">
                            @if(Auth::guard('vestidosUsers')->check())
                            <a href="{{route('logout_user')}}">Logout</a>
                            @else
                            <a href="{{route('login_page')}}">Login</a>
                            @endif
                        </div>
                        <div class="col text-white">
                            <a href="/cart">Cart</a>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
</div>