@extends("layouts.sub-layout")
@section('content')
<!-- <script>
var nextUrl="{{ route('checkout_save_shipping') }}";
function checkoutNext(inputVar){
        var address= $("input[name='"+inputVar+"']:checked").val();
        window.location.href=nextUrl+"?address="+address;

}
</script> -->
<style>
    .checkout-header ul,
    .checkout-cart-list-cell .info-data ul{
        list-style-type: none;
        padding: 0px;
        margin: 0px;
    }
    .checkout-header ul li{
        float: left;
        width: 33.33%;
        text-align: center;
        margin: 10px 0px 30px 0px;
        border-top: 1px solid rgba(0,0,0,.1);
        border-bottom: 1px solid rgba(0,0,0,.1);
        border-left:1px solid rgba(0,0,0,.1);
        padding: 10px 0px;
        background-color:white;
    }
    .checkout-header ul li:last-child{
        border-right:1px solid rgba(0,0,0,.1);
    }
    .checkout-cart-list-cell .info-data ul li{
       display:inline-block;
       float:left;
    }
    .checkout-cart-list-cell .info-data ul li:first-child{
        padding-right:5px;
    }
    .checkout-cart-list-cell .info-data p{
        clear:left;
    }
    .checkout-cart-list-cell{
        padding:0px !important;
        border-top:none !important;
    }
    .checkout-cart-list-cell .img-data{
        width:30%;
    }
    .checkout-cart-list-cell .info-data{
        width:80%;
    }
    .checkout-cart-list-cell .info-data ul li:not(:first-child){
        border-left:1px solid rgba(0,0,0,.1);
        padding:0px 5px;
    }

</style>
<div class="main_sub_body main_body_height">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-9 container-in-center">
            <div>
               <div class="container-in-space">
                        <form action="{{ route('checkout_save_shipping') }}" method="post">
                        <!--content-->
                        <div class="row">
                            <div class="col checkout-header">
                                <ul>
                                @foreach($checkout_menus as $checkoutKey=>$checkout_menu)
                                    <li>
                                    {{$checkoutKey+1}}. {{$checkout_menu["name"]}}
                                    </li>
                                @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-md-12 text-center">
                               <span id="session_msg">
                               @if(count($errors) > 0)
                                    @foreach ($errors->all() as $error)
                                    {{ $error }}
                                    @endforeach
                                @endif
                               </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                    
                                <table class="table">
                                    <tbody>
                                        
                                        <tr>
                                            <td colspan="3">{{$page_title}}</td>
                                        </tr>
                                        @foreach($user->getAddresses as $address)
                                        <tr>
                                            <td>
                                                <input type="radio" value="{{ $address->id }}" name="shipping_address" >
                                            </td>
                                            <td>
                                            {{ $address->nick_name}}<br/>
                                            {{ $address->first_name}} {{ $address->middle_name}} {{ $address->last_name}}<br/>
                                            {{ $address->address_1}} {{ $address->address_2}}<br/>
                                            
                                            {{ $address->phone_number}}<br/>
                                            {{ $address->email}}<br/>
                                            {{ $address->city}} {{ $address->state}} {{ $address->getCountry->countryName}} {{ $address->zip_code}}<br/>
                                            </td>
                                            <td class="text-right"><a class="vestidos-simple-link" href="{{ route('editaddress',['address_id'=>$address->id])}}">Edit</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div><!--end of form-->
                            <div class="col-md-5"><!--load session-->

                                <table class="table">
                                    <tbody>
                                        <tr class="checkout-cart-list-header">
                                            <td>Order Summary</td>
                                            <td><a href="{{ route('cart_page') }}">Edit Cart</a></td>
                                        </tr>
                                        <tr class="checkout-cart-list">
                                            <td class="checkout-cart-list-cell" colspan="2">
                                                <table class="table">
                                                    <tbody>
                                                    @php( $cart_checkout_total=0 )
                                                    @php( $cart_checkout_tax=0 )
                                                    @foreach(Session::get('vestidos_shop') as $cart_checkout_key=>$cart_checkout)
                                                    <tr>
                                                        <td class="img-data">
                                                            <img class="img-fluid" src="{{ asset('/images/products') }}/{{ $cart_checkout['image']}}" alt width="100%"/>
                                                        </td>
                                                        <td class="info-data">
                                                            <a href="/product/{{ $cart_checkout['id']}}">{{ $cart_checkout["name"] }}</a><br/>
                                                            <ul>
                                                                <li >Size: {{ $cart_checkout["size"] }}</li>
                                                                <li >Color: {{ $cart_checkout["color"] }}</li>
                                                                <li >Qty: {{ $cart_checkout["quantity"] }}</li>
                                                            </ul>
                                                            <p>Unit Price: ${{ number_format($cart_checkout["total"],2) }}</p>
                                                        </td>
                                                    </tr>
                                                     @php( $cart_checkout_total +=$cart_checkout["total"] * $cart_checkout["quantity"] )
                                                     @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                       
                                        @php( $cart_checkout_tax = $cart_checkout_total * $tax_info->tax )
                                        <tr class="subtotal">
                                            <td>
                                                Subtotal
                                            </td>
                                            <td>
                                                ${{number_format($cart_checkout_total,'2','.',',')}}
                                            </td>
                                        </tr>
                                        <tr class="subtotal">
                                            <td>
                                                Tax
                                            </td>
                                            <td>
                                                ${{number_format($cart_checkout_tax,'2','.',',')}}
                                            </td>
                                        </tr>
                                        @if(isset($shipping_cost))
                                        <tr class="subtotal">
                                            <td>
                                                Shipping
                                            </td>
                                            <td>
                                                ${{number_format($shipping_cost,'2','.',',')}}
                                            </td>
                                        </tr>
                                        @endif
                                        <tr class="grand-total">
                                            <td>
                                                Order Total
                                            </td>
                                            <td>
                                                ${{number_format(($cart_checkout_total + $cart_checkout_tax),'2','.',',')}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div><!-- end of load session-->
                        </div>`
                        <div class="row">
                            <div class="col">
                            <!-- <a class="btn-block vesti_in_btn checkout_next" href="javascript:checkoutNext('shipping_address')">Continue</a> -->
                            <input type="submit" class="btn-block vesti_in_btn checkout_next" value="Continue"/>
                            </div>
                        </div>
                        </form>
                        <!--end of content-->
               </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection