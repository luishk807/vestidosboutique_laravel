@extends("layouts.sub-layout")
@section('content')
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
                                ITEM
                            </div>
                            <div class="col cart-item-2">
                               QTY
                            </div>
                            <div class="col cart-item-3">
                                PRICE
                            </div>
                            <div class="col cart-item-4">
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
                                                <p>In Stock</p>
                                                <p><span class="cart-item-subtitle">Product ID:</span>2343-343</p>
                                                <p><span class="cart-item-subtitle">Color:</span>red</p>
                                                <p><span class="cart-item-subtitle">Size:</span>6</p>
                                            </div>
                                            <div>
                                                <a href="">Edit</a><a href="">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col cart-item-2">
                               <input type="text" class="vesti-cart-quantity-input" value="1"/>
                            </div>
                            <div class="col cart-item-3">
                                $50.00
                            </div>
                            <div class="col cart-item-4">
                                $50.00
                            </div>
                        </div><!--end of cart items-->




                        <div class="row cart-footer-section">
                            <div class="col-md-8">
                                <!--maybe payment acceptable or payment portal-->
                            </div>
                            <div class="col-md-4 cart-footer-totals">
                                <!-- total info-->

                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            Subtotal
                                        </div>
                                        <div class="col">
                                            $130.00
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            Tax
                                        </div>
                                        <div class="col">
                                            $10.40
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            Subtotal
                                        </div>
                                        <div class="col">
                                            $130.00
                                        </div>
                                    </div>
                                </div>


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