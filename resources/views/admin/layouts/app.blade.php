<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app_admin.css') }}">
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <title>Vestidos Boutique Admin</title>
</head>
<body>
    <div id="admin-wrap">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <a class="navbar-brand" href="{{ route('admin') }}">Vestidos Boutique Admin</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a href="{{ route('admin_logout_user') }}" class="nav-link">Sign Out</a></li>
                    <li class="nav-item"><a href="{{ route('admin_products') }}" class="nav-link">Products</a></li>
                    <li class="nav-item"><a href="{{ route('admin_vendors') }}" class="nav-link">Vendors</a></li>
                    <li class="nav-item"><a href="{{route('admin_orders')}}" class="nav-link">Orders</a></li>
                    <li class="nav-item"><a href="{{route('admin_users')}}" class="nav-link">Users</a></li>
                    <li class="nav-item  dropdown"><a href="#" id="navbardrop" class="nav-link dropdown-toggle" data-toggle="dropdown">Basic</a>
                        <div class="dropdown-menu  navbar-dark bg-dark">
                            <a href="{{ route('admin_brands')}}" class="nav-link">Brands</a>
                            <a href="{{ route('admin_closures')}}" class="nav-link">Closures</a>
                            <a href="{{ route('admin_dressstyles')}}" class="nav-link">Dress Styles</a>
                            <a href="{{ route('admin_lengths')}}" class="nav-link">Dress Length Types</a>
                            <a href="{{ route('admin_fabrics')}}" class="nav-link">Fabric Type</a>
                            <a href="{{ route('admin_necklines')}}" class="nav-link">Neckline Type</a>
                            <a href="{{ route('admin_category')}}" class="nav-link">Category</a>
                        </div>
                    </li>
                    <li class="nav-item  dropdown"><a href="#" id="navbardrop" class="nav-link dropdown-toggle" data-toggle="dropdown">Home Config</a>
                        <div class="dropdown-menu  navbar-dark bg-dark">
                            <a href="{{ route('main_sliders_page')}}" class="nav-link">Main Sliders</a>
                            <a href="{{ route('shop_banners_page')}}" class="nav-link">Shop Banners</a>
                            <a href="{{ route('top_quinces_page')}}" class="nav-link">Top Quince</a>
                            <a href="{{ route('top_dresses_page')}}" class="nav-link">Top Dresses</a>
                            <a href="{{ route('admin_payments')}}" class="nav-link">Payment Types</a>
                            <a href="{{ route('admin_shipping_lists')}}" class="nav-link">Shipping Lists</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container my-5">
            <div class="row">
                <div class="col text-center">
                <h2>{{$page_title}}</h2>
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <span id="session_msg" class="error">
                    @if(count($errors) > 0)
                        @foreach ($errors->all() as $error)
                        {{ $error }}<br/>
                        @endforeach
                    @endif
                    </span>
                </div>
            </div>
            @if(session('success'))
            <div class="row result-mg success">
                <div class="col">
                    <P>
                        {{ session('success') }}
                    </P>
                </div>
            </div>
            @endif
            @if(session('error'))
            <div class="row result-mg error">
                <div class="col">
                    <P>
                        {{ session('error') }}
                    </P>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col">
                    @yield('content')
                </div>
            </div>
        </div>
        <div id="push"></div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script src="{{ asset('js/vestidos_admin.js') }}"></script>
    <script src="{{ asset('js/vendor/rater/rater.js') }}" charset="utf-8"></script>
    <div id="footer" class="vestidos-footer-abs">
        <div class="container">
            <div class="row">
                <div class="col text-center my-4">
                    Vestidos Boutique &copy; {{ now()->year }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>