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
                                @if(count($checkout_menu_prev_link)>0 && $checkout_menu_prev_link["name"]==$checkout_menu["name"])
                                <a href="{{ $checkout_menu_prev_link['url'] }}">
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
                    <div class="row" >
                        <div class="col text-center">
                            <table width="100%" class="shipping-info">
                                <tr>
                                    <th class="checkout-subtitle" colspan="2">{{ trans_choice('general.form.address',2) }}</th>
                                </tr>
                                <tr>
                                    <td align="left" width="50%">
                                        <div>
                                        <strong>{{ __('general.page_header.billing_address') }}</strong><br/>
                                        {{$shipping_info["shipping_name"]}}<br/>
                                        {{$shipping_info["shipping_address_1"]}} {{$shipping_info["shipping_address_2"]}}<br/>
                                        {{$shipping_info["shipping_province"]}} {{$shipping_info["shipping_district"]}} {{$shipping_info["shipping_corregimiento"]}} {{$shipping_info["shipping_country"]}} {{$shipping_info["shipping_zip_code"]}}<br/>
                                        Email: {{$shipping_info["shipping_email"]}}
                                        </div>
                                    </td>
                                    <td align="left" width="50%">
                                        <div>
                                        <strong>{{ __('general.page_header.shipping_address') }}</strong><br/>
                                        {{$shipping_method["name"]}}<br/>
                                        {{$shipping_method["total"]}} ({{$shipping_method["description"]}})<br/>
                                        </div>
                                    </td>
                                </tr>
                            </table>
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
                                            {{ $address->getProvince->name}} {{ $address->getDistrict->name}} {{ $address->getCorregimiento->name }}, {{ $address->getCountry->countryCode}} {{ $address->zip_code}}<br/>
                                            </td>
                                            <td class="text-right"><a class="vestidos-simple-link" href="{{ route('editaddress',['address_id'=>$address->id])}}">{{ __('buttons.edit') }}</a></td>
                                        </tr>
                                        @endforeach

                                         @if(empty($user->getAddresses->first()))
                                        <tr>
                                            <td colspan="3">
                                                    {{ csrf_field() }}
                                                    <div class="form-row">
                                                        <label for="addressName">{{ __('general.form.name') }}:</label>
                                                        <input type="text" id="addressName" class="form-control" name="billing_name" value="{{ old('billing_name') }}" placeholder="{{ __('general.form.name') }}"/>
                                                        <small class="error">{{$errors->first("billing_name")}}</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="addressEmail">{{ __('general.form.email') }}:</label>
                                                        <input type="email" id="addressEmail" class="form-control" name="billing_email" value="{{ old('billing_email') }}" placeholder="{{ __('general.form.email') }}"/>
                                                        <small class="error">{{$errors->first("billing_email")}}</small>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="addressPhone1">{{ __('general.form.telephone') }} 1:</label>
                                                            <input type="text" id="addressPhone1" class="form-control" name="billing_phone_number_1" value="{{ old('billing_phone_number_1') }}" placeholder="{{ __('general.form.telephone') }} 1"/>
                                                            <small class="error">{{$errors->first("billing_phone_number_1")}}</small>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="addressPhone2">{{ __('general.form.telephone') }} 2:</label>
                                                            <input type="text" id="addressPhone2" class="form-control" name="billing_phone_number_2" value="{{ old('billing_phone_number_2') }}" placeholder="{{ __('general.form.telephone') }} 2"/>
                                                            <small class="error">{{$errors->first("billing_phone_number_2")}}</small>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="addressAddress1">{{ trans_choice('general.form.address',1) }} 1:</label>
                                                        <input type="text" id="addressAddress1" class="form-control" name="billing_address_1" value="{{ old('billing_address_1')  }}" placeholder="{{ trans_choice('general.form.address',1) }} 1"/>
                                                        <small class="error">{{$errors->first("billing_address_1")}}</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="addressAddress2">{{ trans_choice('general.form.address',1) }} 2:</label>
                                                        <input type="text" id="addressAddress2" class="form-control" name="billing_address_2" value="{{ old('billing_address_2') }}" placeholder="{{ trans_choice('general.form.address',1) }} 2"/>
                                                        <small class="error">{{$errors->first("billing_address_2")}}</small>
                                                    </div>
                                                    @include('includes.country_province')
                                            <!--end of address-->
                                            </td>
                                        </tr>
                                        @endif

                                    </tbody>
                                </table>

                            </div>

                            <div id="dropin-wrapper">
                                <div id="checkout-message"></div>
                                <div id="dropin-container"></div>
                                <input id="nonce" name="nonce" name="payment_method_nonce" type="hidden" />
                                <div id="vesti-load-oval"><img src="{{ asset('/images/vesti_load.gif') }}"/></div>
                                <button class="btn-block vesti_in_btn_oval checkout-button oval-button" type="submit" id="submit-button">{{ __('buttons.submit_payment') }}</button>
                                <p><strong><center>{{ __('general.payment_final_step_msg') }}</center></strong></p>
                            </div>

                        </div>
                        <div class="col-md-5"><!--load session-->
                        <table class="table">
                                    <tbody>
                                        <tr class="checkout-cart-list-header">
                                            <th class="checkout-subtitle">{{ __('general.page_header.order_summary') }}</td>
                                            <th class="checkout-subtitle"><a href="{{ route('cart_page') }}">{{ __('buttons.edit_cart') }}</a></th>
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
                                                                <li >{{ trans_choice('general.product_title.size',1) }}: {{ $cart_checkout["size"] }}</li>
                                                                <li >{{ trans_choice('general.product_title.color',1) }}: {{ $cart_checkout["color"] }}</li>
                                                                <li >{{ __('general.cart_title.qty') }}: {{ $cart_checkout["quantity"] }}</li>
                                                            </ul>
                                                            <p>{{ trans_choice('general.product_title.unit_price',1) }}: ${{ number_format($cart_checkout["total"],2) }}</p>
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
                                            {{ __('general.cart_title.subtotal') }}
                                            </td>
                                            <td>
                                                ${{number_format($cart_checkout_total,'2','.',',')}}
                                            </td>
                                        </tr>
                                        <tr class="subtotal">
                                            <td>
                                            {{ __('general.cart_title.estimated_tax') }}
                                            </td>
                                            <td>
                                                ${{number_format($cart_checkout_tax,'2','.',',')}}
                                            </td>
                                        </tr>
                                        @if(isset($shipping_cost))
                                        <tr class="subtotal">
                                            <td>
                                            {{ __('general.cart_title.shipping') }}
                                            </td>
                                            <td>
                                                ${{number_format($shipping_cost,'2','.',',')}}
                                            </td>
                                        </tr>
                                        @endif
                                        <tr class="grand-total">
                                            <td>
                                            {{ __('general.cart_title.order_total') }}
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
                document.querySelector("#nonce").value=payload.nonce;
                form.submit();
            });
        });
        
    });
  </script>
@endsection