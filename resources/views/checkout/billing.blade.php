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
                        @foreach($checkout_menus as $checkoutKey=>$checkout_menu)
                            <div class="col">
                            {{$checkoutKey+1}}. {{$checkout_menu["name"]}}
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col">
                            {{$page_title}}
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
                            <div>
                                <table class="table">
                                    <tbody>
                                        
                                        <tr>
                                            <th scope="row">Address</th>
                                            <td class="text-right" colspan='2' ><a class="vestidos-simple-link" href="{{ route('newaddress',['user_id'=>$user->id])}}">Add Address</a></td>
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
                            @php( $header_cart_total=0 )
                            @foreach(Session::get('vestidos_shop') as $header_cart_key=>$header_cart)
                            <div class="row cart-top-items"> <!--item-->
                                <div class="col-md-3"><span><a href=""><img src="{{ asset('/images/products') }}/{{ $header_cart['image']}}" alt width="100%"/></a></span></div>
                                <div class="col-md-9 cart-top-item-txt">
                                    <div>
                                    <p><a href="/product/{{ $header_cart['id']}}">{{ $header_cart["name"] }}</a></p>
                                    <span>Size: {{ $header_cart["size"] }}</span>
                                    <span>Color: {{ $header_cart["color"] }}</span>
                                    <span>Quantity: {{ $header_cart["quantity"] }}</span>
                                    <p>Unit Price: ${{ number_format($header_cart["total"],2) }}</p>
                                    </div>
                                </div>
                            </div><!--end of item-->
                            @php( $header_cart_total +=$header_cart["total"] * $header_cart["quantity"] )
                            @endforeach
                            <div class="row">
                                {{$header_cart_total}}
                            </div>
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