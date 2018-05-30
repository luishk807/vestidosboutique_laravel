<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" type="text/css" href="{{ asset('js/fullpage/jquery.fullPage.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
     <title>Vestidos Boutique Main</title>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

<style>
    .vest-maincolor-right li{
        margin:0px 10px;
    }
    .vest-maincolor-container{
        width:965px;
    }
    .vestidos-icons-header{
        width: 18px;
        height: 18px;
        background-size: 18px 18px;
    }
    .vest-maincolor-right a{
        display:inline-block;
        padding:3px 2px;
    }
    .vest-maincolor-right img{
        display:inline-block;
        vertical-align: top;
    }
    .vest-maincolor-right .vestidos-icons-header{
        margin:0px 4px;                
    }
    .vesti-custom-bg{
        background-color:#87124a;
        height:100vh;
    }
    .vesti-custom-bg .navbar-nav{
        border-top:1px solid rgba(255, 255, 255, .5);
        font-family:Arial;
        margin-top:50px;
    }
    .nav-list{
        padding-left: 0;
        margin-bottom: 0;
        list-style: none;
    }
    .nav-list li a{
        color:white;
    }
    /* #vesti-custom-bottom{
        position:absolute; bottom:50px; width:100%;
    } */
    #vesti-custom-bottom{
        border-top:1px solid rgba(255,255,255,.1);
        margin-top:50px;
        width:80%;
    }
    #vesti-custom-bottom .row div{
       padding:10px 0px;
    }
    #vesti-custom-bottom .col:nth-child(1){
        text-align:left;
        border-right:1px solid rgba(255,255,255,.1);
    }
    #vesti-custom-bottom .col:nth-child(2){
        text-align:right;
    }
    #vesti-custom-bottom a{
       color:white;
       text-decoration:none;
       font-family:Arial;
       font-size:1rem;
       padding:10px .9rem;
    }
    .vesti-collapse{
        padding-bottom:10px;
    }
    .nav-item{
        padding:0px .9rem;
    }
    .nav-item.hover{
        background-color: #5e002e;
    }
    .submenu-panel.open{
        top:50px;
    }
    .submenu-panel{
        min-height: 213px;
        position:absolute;
        top:-5000px;
        left:0px;
        width:100%;
        z-index: 999;
        background-color: #5e002e;
        color:white;
        -webkit-transition:top .4s ease-in-out; 
        -moz-transition:top .4s ease-in-out; 
        -ms-transition:top .4s ease-in-out; 
        -o-transition:top .4s ease-in-out; 
        transition:top .4s ease-in-out;  
    }
    #vestidos-top-news{
        background-color:black; color:white; text-align:center;
        z-index:9999;
    }
</style>
<script>
    $(document).ready(function(){
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
    });
</script>
</head>
<body>
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
                <a class="navbar-brand text-white" href="#" >Vestidos</a>
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
                        <a class="nav-link text-white playfair-display-italic" href="#">Home </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white playfair-display-italic dropdown-toggle" menu-target="events-submenu" href="#">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white playfair-display-italic dropdown-toggle" menu-target="brands-submenu" href="#">Brands</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white playfair-display-italic" href="#">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white playfair-display-italic" href="#">Shop</a>
                    </li>
                </ul>
                <ul class="vest-maincolor-right nav navbar-nav navbar-right">
                    <li class="nav-item"><a class="navbar-link text-white playfair-display-italic" href="#">Login</a></li>
                    <li class="nav-item"><a class="navbar-link text-white playfair-display-italic" href="#">Cart<img class="vesti-svg vestidos-icons-header" src="{{ asset('images/shop-bag.svg') }}" alt="icon name"></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="events-submenu" class="submenu-panel">Event</div>
    <div id="brands-submenu" class="submenu-panel">Brand</div>

        <div class="collapse vestidos-main-nav-top" id="navbarToggleExternalContent">
            <div class="vesti-custom-bg">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white collapse-link" href="#">Home </a>
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
                        <a class="nav-link text-white collapse-link" href="#">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white collapse-link" href="#">Contact Us</a>
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

            <!-- <div id="vesti-custom-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col text-white">
                            <a href="">Login</a>
                        </div>
                        <div class="col text-white">
                            <a href="">Cart</a>
                        </div>
                    </div>
                </div>
            </div> -->


        </div>
</div>
@yield('content')
</body>
</html>