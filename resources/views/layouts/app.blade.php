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
        width: 20px;
        height: 20px;
        background-size: 20px 20px;
    }
    .vest-maincolor-right .vestidos-icons-header{
        margin:0px 4px;                
    }
</style>
</head>
<body>
<div class="pos-f-t" >
    <div class="collapse vestidos-main-nav-top" id="navbarToggleExternalContent">
        <div class="bg-dark p-4">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link text-white playfair-display-italic" href="#">Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white playfair-display-italic" href="#">Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white playfair-display-italic" href="#">Brands</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white playfair-display-italic" href="#">Shop</a>
                </li>
            </ul>
        </div>
    </div>




    <nav class="navbar vest-maincolor vestidos-main-nav navbar-inverse navbar-fixed-top navbar-expand-lg navbar-light">
        <div class="vest-maincolor-container container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand text-white" href="#" >Vestidos</a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="vest-maincolor-left navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white playfair-display-italic" href="#">Home </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white playfair-display-italic" href="#">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white playfair-display-italic" href="#">Brands</a>
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
</div>
@yield('content')
</body>
</html>