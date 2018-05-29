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
    #vesti-custom-bottom{
        position:absolute; bottom:50px; width:100%;
    }
    #vesti-custom-bottom .row div{
       padding:10px 0px;
    }
    #vesti-custom-bottom .col:nth-child(1){
        text-align:left;
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
</style>
<script>
    $(document).ready(function(){
        $('#vesti-main-nav-btn').click(function(){
            $(this).toggleClass('open');
        });
        $(".collapse-link").click(function(){
            $(this).closest(".nav-item").toggleClass("hover");
        })
    });
</script>
</head>
<body>
<div class="pos-f-t" >




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
                        <a class="nav-link text-white playfair-display-italic dropdown-toggle" href="#">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white playfair-display-italic dropdown-toggle" href="#">Brands</a>
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
            </div>

            <div id="vesti-custom-bottom">
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
            </div>


        </div>
</div>
@yield('content')
</body>
</html>