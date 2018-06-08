@extends("layouts.sub-layout")
@section('content')
<style>
body{
    background-color:white;
}
.cart-container-in{
    padding-right:0px;
    padding-left:0px;
}
.cart-container-in .row{
    margin:20px 0px;
}
.cart-item-header > div:not(:first-child):not(:last-child),
.cart-item-items > div:not(:first-child):not(:last-child){
    text-align:center;
}
.cart-item-header > div:first-child,
.cart-item-items > div:first-child{
    text-align:left;
}
.cart-item-header > div:last-child,
.cart-item-items > div:last-child{
    text-align:right;
}
.cart-item-header > div{

}
.cart-item-items > div{
    
}
.cart-container-in .cart-item-img{
    width:75%;
}
.cart-item-items .cart-item-1 .col:nth-child(1){
    padding-left:0px;
    padding-right:0px;
}
.cart-item-items .cart-item-1 .col:nth-child(2){
    /* line-height: 1rem; */
    display:flex;
    flex-direction:column;
    justify-content:space-between;

}
.cart-item-items .cart-item-1 .col:nth-child(2) div p:not(:first-child){
    line-height: .5rem;
}
.cart-item-items .cart-item-1 .col:nth-child(2) div:last-child a:last-child{
    margin-left:5%;
}
@media only screen and (max-width: 600px) {
    .cart-container-in .cart-item-header{
        display:none;
    }
    .cart-container-in .cart-item-img{
        width:100%;
    }
    .cart-item-items .cart-item-1 .col:nth-child(2) div p{
        line-height: 1rem;
    }
}
@media only screen and (max-device-width: 812px) and (orientation: landscape) {
    .cart-container-in .cart-item-img{
        width:100%;
    }
    .cart-item-items .cart-item-1 .col:nth-child(2) div p{
        line-height: 1rem;
    }
}
</style>
<div class="main_sub_body main_body_height">
<div class="container-fluid">
    <div class="row">
        <div class="col container-in-center">
            <div>
               <div class="container-in-space white-md-bg-in">
                    <div class="container cart-container-in">
                        <div class="row">
                            <div class="col-md-8">
                                <h2>Cart</h2>
                            </div>
                            <div class="col-md-4">
                                <div class="vesti_in_btn_pnl">
                                    <button class="btn-block vesti_in_btn" onclick="location.href='/cart'">CHECKOUT</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                            <!--ad -->
                            </div>
                        </div>
                        <!--cart header-->
                        <div class="row cart-item-header">
                            <div class="col-md-5 cart-item-1">
                                Item
                            </div>
                            <div class="col-md-2 cart-item-2">
                               QTY
                            </div>
                            <div class="col-md-2 cart-item-3">
                                PRICE
                            </div>
                            <div class="col-md-3 cart-item-4">
                                TOTAL PRICE
                            </div>
                        </div><!--end of cart header-->
                        <!--start of cart items-->
                        
                        <div class="row cart-item-items">
                            <div class="col-md-5 cart-item-1">
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <img src="{{ asset('/images/products/product_test.jpg') }}" alt class="cart-item-img" width="100%"/>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <p>Long Organaza Sweetheart</p>
                                                <p>by:Joanna</p>
                                                <p>In Stock</p>
                                                <p>Product ID</p>
                                                <p>color:red</p>
                                                <p>size: 6</p>
                                            </div>
                                            <div>
                                                <a href="">Edit</a><a href="">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 cart-item-2">
                               <input type="text" class="vesti-cart-quantity-input"/>
                            </div>
                            <div class="col-md-2 cart-item-3">
                                $50.00
                            </div>
                            <div class="col-md-3 cart-item-4">
                                $50.00
                            </div>
                        </div><!--end of cart items-->
                        <div class="row">
                            <div class="col">
                                <!--maybe payment acceptable or payment portal-->
                            </div>
                            <div class="col">
                                <!-- total info-->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8"><!-- maybe continue shopping--></div>
                            <div class="col-md-4">
                                <div class="vesti_in_btn_pnl">
                                    <button class="btn-block vesti_in_btn" onclick="location.href='/cart'">CHECKOUT</button>
                                </div>
                            </div>
                        </div>
                    </div><!--end of cart container-->

               </div><!--end of container-in-space-->
            </div>
        </div><!--end of container-in-center container-->
    </div><!--end of row-->
</div>
</div>
@endsection