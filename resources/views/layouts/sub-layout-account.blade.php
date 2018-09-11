@include('includes.header')
<div id="user-body" class="main_sub_body main_body_height">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-lg-4" id="user-account-menu">
                <div class="container-in-space white-md-bg-in">
                    <ul class="list-group">
                        <li class="vestidos-list-group-item">
                            <a href="{{ route('user_account') }}" class="btn-block vesti_in_btn_link vestidos-simple-link">{{ __('header.profile') }}</a>
                        </li>
                        <li class="vestidos-list-group-item">
                            <a href="{{ route('user_orders') }}" class="btn-block vesti_in_btn_link vestidos-simple-link">{{ __('header.orders') }}</a>
                        </li>
                        <li class="vestidos-list-group-item">
                            <a href="{{ route('user_wishlists')}}" class="btn-block vesti_in_btn_link vestidos-simple-link">{{ __('header.wishlists') }}</a>
                        </li>
                        <li class="vestidos-list-group-item">
                            <a href="{{ route('logout_user') }}" class="btn-block vesti_in_btn_link vestidos-simple-link">{{ __('header.log_out') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-10 col-md-8 col-lg-8">
                @yield('content')
            </div>
        </div>
    </div>
</div>
@include('includes.footer-main')
</body>
</html>