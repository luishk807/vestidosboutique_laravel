<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" type="text/css" href="{{ asset('js/vendor/fullpage/jquery.fullPage.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
     <title>Vestidos Boutique Main</title>

 <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('js/vendor/fullpage/jquery.fullPage.js') }}"></script>
<script src="{{ asset('js/vendor/rater/rater.js') }}" charset="utf-8"></script>
<script src="{{ asset('js/vestidos.js') }}"></script>
<script>
    $(document).ready(function(){
        $("#vesti-navbar-top-link").hover(
            function(){
                $(".vesti-cart-top").addClass("active"); 
            },
            function(){
                $(".vesti-cart-top").removeClass("active"); 
            }
        )
        $(".vesti-cart-top").hover(
            function(){
                $(this).addClass("active");
            },
            function(){
                $(this).removeClass("active");
            }
        )
    })
</script>
<style>
    
    .vesti-cart-top{
        max-height: 0px;
        background-color: white;
        color: black;
        position: absolute;
        min-width: 400px;
        right: 0;
        top: 40px;
        z-index:-1;
        border-left: #87124a 1px solid;
        border-bottom: #87124a 1px solid;
        border-right: #87124a 1px solid;
        border-top: #87124a 1px solid;
        overflow: hidden;
        -webkit-transition:  max-height 0.25s ease-out;
        -moz-transition:  max-height 0.25s ease-out;
        -o-transition:  max-height 0.25s ease-out;
        transition:  max-height 0.25s ease-out;
    }
    .vesti-cart-top.active{
        max-height:800px;
        z-index:999;
        -webkit-transition:  max-height 0.25s ease-in;
        -moz-transition:  max-height 0.25s ease-in;
        -o-transition:  max-height 0.25s ease-in;
        transition:  max-height 0.25s ease-in;
    }
    .vesti-cart-top .cart-top-items{
        margin: 10px 0px;
    }
    .vesti-cart-top .cart-top-items .cart-top-item-txt{
        padding-left: 0px;
        padding-right: 0px;
        text-align: left;
        font-family:"Playfair Display";
        font-size: .8rem;
        display:flex;
        flex-direction:column;
        justify-content:space-between;
    }
    .vesti-cart-top .cart-top-items .cart-top-item-txt a{
        font-family:"Playfair Display";
       text-decoration:none;
       color:black;
    }
    .vesti-cart-top .cart-top-items .cart-top-item-txt a:hover{
       text-decoration:underline;
    }
    .vesti-cart-top .cart-top-items .col:nth-child(1) img{
        width: 120px;
    }
    .vesti-cart-top .cart-top-items .cart-top-item-txt p{
        margin:2px 0px;
    }
    .vesti-cart-top .cart-top-totals{
        margin: 10px auto;
        text-align: center;
        border-top: 1px solid rgba(0,0,0,.1);
        border-bottom: 1px solid rgba(0,0,0,.1);
        padding: 6px 0px;
        font-family:"Playfair Display";
    }
    .vesti-cart-top .cart-top-buttons{
        margin: 10px 0px;
    }
    .vesti_in_btn_b{
        background-color:#87124a;
        border:1px solid #87124a;
        color: white;
        padding: 5px 0px;
        font-family:"Playfair Display";
        font-style:italic;
        text-align:center;
        cursor:pointer;
        font-size:.9rem;
    }
    .vesti_in_btn_b:hover{
        background-color: transparent;
        color: #87124a;
    }
    .cart-top-items:not(:first-child){
        border-top: 1px solid rgba(0,0,0,.1);
        padding: 10px 0px;
    }
</style>
</head>
<body id="main-body">
<div class="pos-f-t" >
     <div id="vestidos-top-news" class="container-fluid navbar-fixed-top">
        <div class="row">
            <div class="col">
              Order Now for Free Shipping
            </div>
        </div>
     </div>
    <nav class="navbar vest-maincolor vestidos-main-nav navbar-inverse navbar-fixed-top navbar-expand-lg navbar-light">
        <div class="vest-maincolor-container container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand text-white" href="/" >Vestidos</a>
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
                        <a class="nav-link text-white playfair-display-italic" href="/about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white playfair-display-italic dropdown-toggle" menu-target="events-submenu" href="#">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white playfair-display-italic dropdown-toggle" menu-target="brands-submenu" href="#">Brands</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white playfair-display-italic" href="/contact">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white playfair-display-italic" href="/shop">Shop</a>
                    </li>
                </ul>
                <ul class="vest-maincolor-right nav navbar-nav navbar-right">
                    <li class="nav-item"><a class="navbar-link text-white playfair-display-italic" href="#">Login</a></li>
                    <li class="nav-item navbar-vesti-cart"><a id="vesti-navbar-top-link" class="navbar-link text-white playfair-display-italic" href="/cart">
                        Cart<img class="vesti-svg vestidos-icons-header vesti-navbar-bag" src="{{ asset('images/shop-bag.svg') }}" alt="icon name"></a>
                        <div class="vesti-cart-top">
                           <div class="container">
                               <div class="row cart-top-items"> <!--item-->
                                   <div class="col-md-4"><span><a href=""><img src="{{ asset('/images/products/product_test.jpg') }}" alt width="100%"/></a></span></div>
                                   <div class="col-md-8 cart-top-item-txt">
                                       <div>
                                       <p><a href="">Don't Bow Breaking My Heart Spot Dress</a></p>
                                       <p>Unit Price: $150.00</p>
                                       <p>Size: 4</p>
                                       <p>Color: Red</p>
                                        </div>
                                        <div>
                                            <a href="">Remove</a>
                                        </div>
                                   </div>
                               </div><!--end of item-->
                               <div class="row cart-top-totals">
                                   <div class="col">Subtotal: $40.00</div>
                               </div>
                               <div class="row cart-top-buttons">
                                   <div class="col"><button class="btn-block vesti_in_btn_b" onclick="location.href='/cart'">View Cart</button></div>
                                   <div class="col"><button class="btn-block vesti_in_btn_b" onclick="">Checkout</button></div>
                               </div>
                           </div>
                        </div><!--end of hover menu-->
                    
                        
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
                            <li><a href="">events</a></li>
                            <li><a href="">events</a></li>
                            <li><a href="">events</a></li>
                            <li><a href="">events</a></li>
                            <li><a href="">events</a></li>
                            <li><a href="">events</a></li>
                            <li><a href="">events</a></li>
                            <li><a href="">events</a></li>
                            <li><a href="">events</a></li>
                            <li><a href="">events</a></li>
                            <li><a href="">events</a></li>
                            <li><a href="">events</a></li>
                            <li><a href="">events</a></li>
                            <li><a href="">events</a></li>
                            <li><a href="">events</a></li>
                            <li><a href="">events</a></li>
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
                            <li><a href="">Brands</a></li>
                            <li><a href="">Brands</a></li>
                            <li><a href="">Brands</a></li>
                            <li><a href="">Brands</a></li>
                            <li><a href="">Brands</a></li>
                            <li><a href="">Brands</a></li>
                            <li><a href="">Brands</a></li>
                            <li><a href="">Brands</a></li>
                            <li><a href="">Brands</a></li>
                            <li><a href="">Brands</a></li>
                            <li><a href="">Brands</a></li>
                            <li><a href="">Brands</a></li>
                            <li><a href="">Brands</a></li>
                            <li><a href="">Brands</a></li>
                            <li><a href="">Brands</a></li>
                            <li><a href="">Brands</a></li>
                        </ul>
                    </div>
                </div>
            </div>
    </div>

        <div class="collapse vestidos-main-nav-top" id="navbarToggleExternalContent">
            <div class="vesti-custom-bg">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white collapse-link" href="/about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white collapse-link dropdown-toggle" href="#"  data-toggle="collapse" class="collapsed" data-target="#toggle-events">Events</a>
                        <div class="collapse vesti-collapse" id="toggle-events" style="height: 0px;">
                            <ul class="nav-list">
                                <li><a href="#">Submenu2.1</a></li>
                                <li><a href="#">Submenu2.2</a></li>
                                <li><a href="#">Submenu2.3</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white collapse-link dropdown-toggle" href="#" data-toggle="collapse" class="collapsed" data-target="#toggle-brands">Brands</a>
                        <div class="collapse vesti-collapse" id="toggle-brands" style="height: 0px;">
                            <ul class="nav-list">
                                <li><a href="#">Submenu2.1</a></li>
                                <li><a href="#">Submenu2.2</a></li>
                                <li><a href="#">Submenu2.3</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white collapse-link" href="/shop">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white collapse-link" href="/contact">Contact Us</a>
                    </li>
                </ul>

                <div>

                <div id="vesti-custom-bottom" class="container">
                    <div class="row">
                        <div class="col text-white">
                            <a href="">Login</a>
                        </div>
                        <div class="col text-white">
                            <a href="">Cart</a>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
</div>