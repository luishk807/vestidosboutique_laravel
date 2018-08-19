@extends("layouts.sub-layout")
@section('content')
<script src="https://js.braintreegateway.com/web/dropin/1.11.0/js/dropin.min.js"></script>
<div class="main_sub_body main_body_height">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-9 container-in-center">
            <div>
               <div class="container-in-space">
                  <form action="{{ route('checkout_save_billing') }}" id="vestidos-checkout-form" method="post">
                    <div class="row">
                        <div class="col checkout-header">
                            <ul>
                            @foreach($checkout_menus as $checkoutKey=>$checkout_menu)
                                @if($checkout_menu["name"]==$checkout_header_key)
                                <li class="active">
                                    <div class="checkout-arrow-down"></div>
                                @else
                                <li>
                                @endif
                                @if($checkout_menu_prev_link && $checkout_menu["name"]==$checkout_header_key)
                                <a href="{{ $checkout_menu_prev_link }}">
                                    {{$checkoutKey+1}}. {{$checkout_menu["name"]}}
                                </a>
                                @else
                                    {{$checkoutKey+1}}. {{$checkout_menu["name"]}}
                                @endif
                                </li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-md-12 text-center">
                            <span id="session_msg" class="error">
                            @if(count($errors) > 0)
                                @foreach ($errors->all() as $error)
                                {{ $error }}<br/>
                                @endforeach
                            @endif
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th class="checkout-subtitle" colspan="3">{{$page_title}}</th>
                                        </tr>
                                        @foreach($user->getAddresses as $address)
                                        <tr>
                                            <td>
                                                <input type="radio" value="{{ $address->id }}" name="billing_address" >
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

                            </div>

                            <div id="dropin-wrapper">
                                <div id="checkout-message"></div>
                                <div id="dropin-container"></div>
                                <input id="nonce" name="nonce" name="payment_method_nonce" type="hidden" />
                                <button class="btn-block vesti_in_btn" type="submit" id="submit-button">Submit payment</button>
                            </div>

                        </div>
                        <div class="col-md-5"><!--load session-->
                        <table class="table">
                                    <tbody>
                                        <tr class="checkout-cart-list-header">
                                            <th class="checkout-subtitle">Order Summary</td>
                                            <th class="checkout-subtitle"><a href="{{ route('cart_page') }}">Edit Cart</a></th>
                                        </tr>
                                        <tr class="checkout-cart-list">
                                            <td class="checkout-cart-list-cell" colspan="2">
                                                <div class="checkout-cart-list-cell-panel">
                                                <table class="table checkout-lists-panel">
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
                                                </div>
                                            </td>
                                        </tr><!--end of cart session listing-->
                                       <!--start of total-->
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
                                    <!--end of total-->
                                    </tbody>
                                </table>
                        </div><!-- end of load session-->
                    </div>
                    <div class="row">
                        <div class="col">
                          <table width="135" border="0" cellpadding="2" cellspacing="0" title="Click to Verify - This site chose GeoTrust SSL for secure e-commerce and confidential communications.">
                            <tr>
                            <td width="135" align="center" valign="top"><script type="text/javascript" src="https://seal.geotrust.com/getgeotrustsslseal?host_name=www.vestidosboutique.com&amp;size=S&amp;lang=en"></script><br />
                            <a href="http://www.geotrust.com/ssl/" target="_blank"  style="color:#000000; text-decoration:none; font:bold 7px verdana,sans-serif; letter-spacing:.5px; text-align:center; margin:0px; padding:0px;"></a></td>
                            </tr>
                          </table>
                        </div>
                    </div>
                  </form>
               </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    // var button = document.querySelector('#submit-button');
    var form = document.querySelector("#vestidos-checkout-form");
    braintree.dropin.create({
      authorization: "{{ Braintree_ClientToken::generate() }}",
      selector: '#dropin-container'
    //   ,
    //   paypal:{

    //       flow:'vault'
    //   }
    }, function (createErr, instance) {
        if(createErr){
            console.log(createErr);
            return;
        }
        form.addEventListener('submit',function(event){
            event.preventDefault();
            instance.requestPaymentMethod(function (err, payload) {
                // if(err){
                //     console.log(err);
                //     return;
                // }
                document.querySelector("#nonce").value=payload.nonce;
                form.submit();
            });
        });
    //   button.addEventListener('click', function () {
    //     instance.requestPaymentMethod(function (err, payload) {
    //       $.get("{{ route('checkout_payment_process') }}", {payload}, function (response) {
    //         if (response.success) {
    //           console.log(response);
    //           alert('Payment successfull!');
    //         } else {
    //           alert('Payment failed');
    //         }
    //       }, 'json');
    //     });
    //   });
        
    });
  </script>
@endsection