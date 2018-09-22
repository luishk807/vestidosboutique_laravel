@extends("layouts.sub-layout")
@section('content')
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
                                <table class="table checkout-shipping-address-list">
                                    <tbody>
                                        <tr>
                                            <th colspan="3" class="checkout-subtitle" colspan="3">{{$page_title}}</th>
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
                                            <td class="text-right"><a class="vestidos-simple-link" href="{{ route('editaddress',['address_id'=>$address->id])}}">{{ __('buttons.edit') }}</a></td>
                                        </tr>
                                        @endforeach
                                        @if(empty($user->getAddresses->first()))
                                        <tr>
                                            <td colspan="3">
                                                    {{ csrf_field() }}
                                                    <div class="form-row">
                                                        <label for="addressName">{{ __('general.form.name') }}:</label>
                                                        <input type="text" id="addressName" class="form-control" name="shipping_name" value="{{ old('shipping_name') }}" placeholder="{{ __('general.form.name') }}"/>
                                                        <small class="error">{{$errors->first("shipping_name")}}</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="addressEmail">{{ __('general.form.email') }}:</label>
                                                        <input type="email" id="addressEmail" class="form-control" name="shipping_email" value="{{ old('shipping_email') }}" placeholder="{{ __('general.form.email') }}"/>
                                                        <small class="error">{{$errors->first("shipping_email")}}</small>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="addressPhone1">{{ __('general.form.telephone') }} 1:</label>
                                                            <input type="text" id="addressPhone1" class="form-control" name="shipping_phone_number_1" value="{{ old('shipping_phone_number_1') }}" placeholder="{{ __('general.form.telephone') }} 1"/>
                                                            <small class="error">{{$errors->first("shipping_phone_number_1")}}</small>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="addressPhone2">{{ __('general.form.telephone') }} 2:</label>
                                                            <input type="text" id="addressPhone2" class="form-control" name="shipping_phone_number_2" value="{{ old('shipping_phone_number_2') }}" placeholder="{{ __('general.form.telephone') }} 2"/>
                                                            <small class="error">{{$errors->first("shipping_phone_number_2")}}</small>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="addressAddress1">{{ trans_choice('general.form.address',1) }} 1:</label>
                                                        <input type="text" id="addressAddress1" class="form-control" name="shipping_address_1" value="{{ old('shipping_address_1')  }}" placeholder="{{ trans_choice('general.form.address',1) }} 1"/>
                                                        <small class="error">{{$errors->first("shipping_address_1")}}</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="addressAddress2">{{ trans_choice('general.form.address',1) }} 2:</label>
                                                        <input type="text" id="addressAddress2" class="form-control" name="shipping_address_2" value="{{ old('shipping_address_2') }}" placeholder="{{ trans_choice('general.form.address',1) }} 2"/>
                                                        <small class="error">{{$errors->first("shipping_address_2")}}</small>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="addressCity">{{ __('general.form.city') }}:</label>
                                                            <input type="text" id="addressCity" class="form-control" name="shipping_city" value="{{ old('shipping_city') }}" placeholder="{{ __('general.form.city') }}"/>
                                                            <small class="error">{{$errors->first("shipping_city")}}</small>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="addressState">{{ __('general.form.state') }}:</label>
                                                            <input type="text" id="addressState" class="form-control" name="shipping_state" value="{{ old('shipping_state') }}" placeholder="{{ __('general.form.state') }}"/>
                                                            <small class="error">{{$errors->first("shipping_state")}}</small>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="addressCountry">{{ __('general.form.country') }}:</label>
                                                            <select class="custom-select" name="shipping_country" id="addressCountry">
                                                                <option value="">{{ __('general.form.select_country') }}</option>
                                                                @foreach($countries as $country)
                                                                    <option value="{{ $country->id }}">{{$country->countryName}} </option>
                                                                @endforeach
                                                            </select>
                                                            <small class="error">{{$errors->first("shipping_country")}}</small>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="addressZip">{{ __('general.form.zip') }}:</label>
                                                            <input type="text" id="addressZip" class="form-control" name="shipping_zip_code" value="{{ old('shipping_zip_code') }}" placeholder="{{ __('general.form.zip') }}"/>
                                                            <small class="error">{{$errors->first("shipping_zip_code")}}</small>
                                                        </div>
                                                    </div>


                                            <!--end of address-->
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table><!--end of address listing-->

                                
                                <table class="table checkout-shipping-method-list">
                                    <tbody>
                                        
                                        <tr>
                                            <th class="checkout-subtitle" scope="row" colspan="3">{{ __('general.page_header.choose_delivery') }}</th>
                                        </tr>
                                        @foreach($shipping_lists as $shipping_info)
                                        <tr>
                                            <td>
                                                <input type="radio" value="{{ $shipping_info->id }}" name="shipping_method" >
                                            </td>
                                            <td>
                                            {{ $shipping_info->total}} - {{ $shipping_info->name}}<br/>
                                            {{ $shipping_info->description}}<br/>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>


                            </div><!--end of form-->
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
                                                {{ __('general.product_title.tax') }}
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
                            </div><!--end of right side-->
                        </div>
                        <div class="row">
                            <div class="col-md-4 checkout-btn-pnl">
                                <div id="vesti-load-oval"><img src="{{ asset('/images/vesti_load.gif') }}"/></div>
                                <input type="submit" class="btn-block vesti_in_btn_oval checkout_next checkout-button oval-button" value="{{ __('buttons.proceed_billing') }}"/>
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