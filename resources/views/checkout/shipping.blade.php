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
                                            <td class="text-right"><a class="vestidos-simple-link" href="{{ route('editaddress',['address_id'=>$address->id])}}">Edit</a></td>
                                        </tr>
                                        @endforeach
                                        @if(empty($user->getAddresses->first()))
                                        <tr>
                                            <td colspan="3">
                                                    {{ csrf_field() }}
                                                    <div class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <label for="addressFirstName">First Name:</label>
                                                            <input type="text" id="addressFirstName" class="form-control" name="first_name" value="{{ old('first_name') }}" placeholder="First Name"/>
                                                            <small class="error">{{$errors->first("first_name")}}</small>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="addressMiddleName">Middle Name:</label>
                                                            <input type="text" id="addressMiddleName" class="form-control" name="middle_name" value="{{ old('middle_name') }}" placeholder="Middle Name"/>
                                                            <small class="error">{{$errors->first("middle_name")}}</small>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="addressLastName">Last Name:</label>
                                                            <input type="text" id="addressLastName" class="form-control" name="last_name" value="{{ old('last_name')  }}" placeholder="Last Name"/>
                                                            <small class="error">{{$errors->first("last_name")}}</small>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="addressEmail">Email:</label>
                                                        <input type="email" id="addressEmail" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email"/>
                                                        <small class="error">{{$errors->first("email")}}</small>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="addressPhone1">Telephone 1:</label>
                                                            <input type="text" id="addressPhone1" class="form-control" name="phone_number_1" value="{{ old('phone_number_1') }}" placeholder="Phone 1"/>
                                                            <small class="error">{{$errors->first("phone_number_1")}}</small>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="addressPhone2">Telephone 2:</label>
                                                            <input type="text" id="addressPhone2" class="form-control" name="phone_number_2" value="{{ old('phone_number_2') }}" placeholder="Phone 2"/>
                                                            <small class="error">{{$errors->first("phone_number_2")}}</small>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="addressAddress1">Address 1:</label>
                                                        <input type="text" id="addressAddress1" class="form-control" name="address_1" value="{{ old('address_1')  }}" placeholder="Address 1"/>
                                                        <small class="error">{{$errors->first("address_1")}}</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="addressAddress2">Address 2:</label>
                                                        <input type="text" id="addressAddress2" class="form-control" name="address_2" value="{{ old('address_2') }}" placeholder="Address 2"/>
                                                        <small class="error">{{$errors->first("address_2")}}</small>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="addressCity">City:</label>
                                                            <input type="text" id="addressCity" class="form-control" name="city" value="{{ old('city') }}" placeholder="City"/>
                                                            <small class="error">{{$errors->first("city")}}</small>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="addressState">State:</label>
                                                            <input type="text" id="addressState" class="form-control" name="state" value="{{ old('state') }}" placeholder="State"/>
                                                            <small class="error">{{$errors->first("state")}}</small>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="addressCountry">Country:</label>
                                                            <select class="custom-select" name="country" id="addressCountry">
                                                                <option value="">Select Country</option>
                                                                @foreach($countries as $country)
                                                                    <option value="{{ $country->id }}">{{$country->countryName}} </option>
                                                                @endforeach
                                                            </select>
                                                            <small class="error">{{$errors->first("country")}}</small>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="addressZip">Zip Code:</label>
                                                            <input type="text" id="addressZip" class="form-control" name="zip_code" value="{{ old('zip_code') }}" placeholder="Zip Code"/>
                                                            <small class="error">{{$errors->first("zip_code")}}</small>
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
                                            <th class="checkout-subtitle" scope="row" colspan="3">Choose Delivery Method</th>
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
                            </div><!--end of right side-->
                        </div>
                        <div class="row">
                            <div class="col-md-4 checkout-btn-pnl">
                                <input type="submit" class="btn-block vesti_in_btn checkout_next" value="{{$checkout_btn_name}}"/>
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