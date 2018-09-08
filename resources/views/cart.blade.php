@extends("layouts.sub-layout")
@section('content')
<style>
.cart-text-cont{
    margin:50px auto;
}
</style>
<div class="main_sub_body main_body_height">
<div class="container-fluid">
    <div class="row">
        <div class="col container-in-center">
            <div>
               <div class="container-in-space white-md-bg-in">
                    <div class="container cart-container-in">
                        <div class="row" >
                            <div class="col-md-12 text-center">
                               <span id="session_msg"
                               @if(Session::has("success"))
                               class="success">{{Session::get("success")}}
                               @elseif(Session::has("error"))
                               class="error">{{Session::get("error")}}
                               @elseif(Session::has("alert"))
                               class="alert">{{Session::get("alert")}}
                               @endif
                               </span>
                            </div>
                        </div>
                        @if(!empty(Session::get("vestidos_shop")))
                        <div class="row">
                            <div class="col-md-8">
                                <h2>{{ __('header.cart') }}</h2>
                            </div>
                            <div class="col-md-4">
                                <div class="vesti_in_btn_pnl">
                                    <a class="btn-block vesti_in_btn" href="{{ route('checkout_show_shipping') }}">{{ __('buttons.checkout') }}</a>
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
                        @foreach(Session::get("vestidos_shop") as $keyIndex=>$item)
                        <div class="row cart-item-items">
                            <div class="col-md-5 cart-item-1">
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <img src="{{ asset('/images/products') }}/{{ $item['image']}}" alt class="cart-item-img" width="100%"/>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <p>{{$item["name"]}}</p>
                                                <p>{{ $item['stock'] > 0 ? "In Stock":"Out of Stock"}}</p>
                                                <p><span class="cart-item-subtitle">Product ID:</span>{{ $item["model"]}}</p>
                                                <p><span class="cart-item-subtitle">Color:</span>{{ $item["color"] }}</p>
                                                <p><span class="cart-item-subtitle">Size:</span>{{ $item["size"] }}</p>
                                            </div>
                                            <div>
                                               <a href="javascript:deleteCart({{$keyIndex}})">{{ __('buttons.remove') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col cart-item-2">
                                <select name="quantity" class="vesti-cart-quantity-input" onchange="updateCart('{{ $keyIndex }}',this.value)">
                                    @for ($i = 1; $i < 10; $i++)
                                    <option value="{{$i}}"
                                        @if($i==$item['quantity'])
                                        selected=selected
                                        @endif
                                        >{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col cart-item-3">
                                ${{ number_format($item["total"],2) }}
                            </div>
                            <div class="col cart-item-4">
                                ${{ number_format($item["quantity"] * $item["total"],2) }}
                                @php($subtotal += $item["quantity"] * $item["total"] )
                            </div>
                        </div><!--end of cart items-->
                        @endforeach
                        <div class="row cart-footer-section">
                            <div class="col-md-8">
                                <!--maybe payment acceptable or payment portal-->
                            </div>
                            <div class="col-md-4 cart-footer-totals">
                                <!-- total info-->
                                @php($taxtotal = $tax * $subtotal)
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            Subtotal
                                        </div>
                                        <div class="col">
                                           ${{ number_format($subtotal,2) }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            Tax
                                        </div>
                                        <div class="col">
                                            ${{ number_format($taxtotal,2) }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            Subtotal
                                        </div>
                                        <div class="col">
                                            ${{ number_format(($subtotal + $taxtotal),2) }}
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8"><!-- maybe continue shopping--></div>
                            <div class="col-md-4">
                                <div class="vesti_in_btn_pnl">
                                    <a class="btn-block vesti_in_btn" href="{{ route('checkout_show_shipping') }}">{{ __('buttons.checkout') }}</a>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="row">
                            <div class="col">
                                <h2>{{ __('header.cart') }}</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="col-md-7 text-center cart-text-cont">
                                    <p>Your Shopping Cart is Empty</p>
                                    <div class="vesti_in_btn_pnl">
                                        <a class="btn-block vesti_in_btn" href="{{ route('shop_page') }}">{{ __('buttons.continue_shop') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div><!--end of cart container-->

               </div><!--end of container-in-space-->
            </div>
        </div><!--end of container-in-center container-->
    </div><!--end of row-->
</div>
</div>
@endsection