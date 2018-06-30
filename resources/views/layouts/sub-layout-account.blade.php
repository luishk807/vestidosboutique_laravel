@include('includes.header')
<style>
.vestidos-list-group-item{
    display: block;
}
.vestidos-list-group-item:not(:first-child){
    margin:5px 0px;
}
.no-top-border td,
.no-top-border th{
    border-top:none !important;
}
.vestidos-simple-link{
    color:black;
}
.vestidos-simple-link:hover{
    color:black;
}
.vesti_in_btn_link{

    border: 1px solid rgba(0,0,0,.1);
    padding: 10px 0px;
    text-align: center;
    cursor: pointer;
    font-size: 0.8rem;
    -webkit-transition: background-color 230ms;
	-moz-transition: background-color 230ms;
	-o-transition: background-color 230ms;
	transition: background-color 230ms;
}
.vesti_in_btn_link:hover{
    background-color:#000;
    color:white !important;
    padding: 10px 0px;
    text-align: center;
    cursor: pointer;
    font-size: 0.8rem;
}
</style>
<div class="main_sub_body main_body_height">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="container-in-space white-md-bg-in">
                    <ul class="list-group">
                        <li class="vestidos-list-group-item">
                            <a class="btn-block vesti_in_btn_link">Profile</a>
                        </li>
                        <li class="vestidos-list-group-item">
                            <a class="btn-block vesti_in_btn_link">Orders</a>
                        </li>
                        <li class="vestidos-list-group-item">
                            <a class="btn-block vesti_in_btn_link">Wishlist</a>
                        </li>
                        <li class="vestidos-list-group-item">
                            <a class="btn-block vesti_in_btn_link">Log Out</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-8">
                @yield('content')
            </div>
        </div>
    </div>
</div>
@include('includes.footer-main')
</body>
</html>