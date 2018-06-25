<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <title>Vestidos Boutique Admin</title>
    <style>
    .vestidos-footer-abs{
        width: 100%;
        background-color: #f5f5f5;
    }
    #wrap{
        min-height: 100%;
        height: auto !important;
        height: 100%;
        margin: 0 auto -60px;
    }
    #push,#footer{
        height: 100px;
    }
</style>
</head>
<body>
    <div id="wrap">
        <nav class="navbar navbar-expand-md bg-light">
            <a class="navbar-brand" href="{{ route('admin') }}">Vestidos Boutique Admin</a>
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('admin_products') }}" class="nav-link">Products</a></li>
                <li class="nav-item"><a href="{{ route('admin_vendors') }}" class="nav-link">Vendors</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Orders</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Users</a></li>
                <li class="nav-item  dropdown"><a href="#" id="navbardrop" class="nav-link dropdown-toggle" data-toggle="dropdown">Basic</a>
                    <div class="dropdown-menu">
                        <a href="{{ route('admin_brands')}}" class="nav-link">Brands</a>
                        <a href="{{ route('admin_colors')}}" class="nav-link">Colors</a>
                        <a href="{{ route('admin_closures')}}" class="nav-link">Closures</a>
                        <a href="{{ route('admin_dresstypes')}}" class="nav-link">Dress Types</a>
                        <a href="{{ route('admin_dressstyles')}}" class="nav-link">Dress Styles</a>
                        <a href="{{ route('admin_fits')}}" class="nav-link">Dress Fit Types</a>
                        <a href="{{ route('admin_sizes')}}" class="nav-link">Dress Sizes</a>
                        <a href="{{ route('admin_fabrics')}}" class="nav-link">Fabric Type</a>
                        <a href="{{ route('admin_necklines')}}" class="nav-link">Neckline Type</a>
                        <a href="{{ route('admin_category')}}" class="nav-link">Category</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col text-center">
                <h2>{{$page_title}}</h2>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    @yield('content')
                </div>
            </div>
        </div>
        <div id="push"></div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script src="{{ asset('js/vestidos_admin.js') }}"></script>
    <div id="footer" class="vestidos-footer-abs">
        <div class="container">
            footer
        </div>
    </div>
</body>
</html>