@extends("layouts.sub-layout")
@section('content')
<div class="main_sub_body main_body_height">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-9 container-in-center">
            <div>
               <div class="container-in-space">
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
                            <div class="col-md-7 checkout-confirm-info-cont">
                                <table>
                                    <tbody>
                                        <tr>
                                            <th class="checkout-subtitle-confirm" colspan="3">{{$page_title}}</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('images') }}/{{ $thankyou_img }}" class="vesti-svg vestidos-icons-confirm-b"/>
                                            </td>
                                            <td class="checkout-confirm-text">
                                                {{ $thankyou_msg }}
                                            </td>
                                        </tr>
                                        @if($thankyou_status)
                                        <tr>
                                            <td colspan='2'>
                                                <table class="checkout-confirm-order-details">
                                                    <tbody>
                                                        <tr class="header1">
                                                            <th colspan='3'>
                                                                Order Number: {{$last_order->order_number}}
                                                            </th>
                                                        </tr>
                                                        <tr class="header2">
                                                            <td colspan="2">
                                                            Subtotal
                                                            </td>
                                                            <td>
                                                              ${{number_format($last_order->order_total,'2','.',',')}}
                                                            <td>
                                                        </tr>
                                                        <tr class="header2">
                                                            <td colspan="2">
                                                            Tax
                                                            </td>
                                                            <td>
                                                            @php($tax_total = $last_order->order_total * $last_order->order_tax)
                                                            ${{number_format($tax_total,'2','.',',')}}
                                                            <td>
                                                        </tr>
                                                        <tr class="header2">
                                                            <td colspan="2">
                                                            Shipping
                                                            </td>
                                                            <td>
                                                            ${{number_format($last_order->order_shipping,'2','.',',')}}
                                                            <td>
                                                        </tr>
                                                        <tr class="header3">
                                                            <td colspan="2">
                                                            Grand total
                                                            </td>
                                                            <td>
                                                            ${{number_format($last_order->order_total + $tax_total + $last_order->order_shipping,'2','.',',')}}
                                                            <td>
                                                        </tr>
                                                        @foreach($last_order->products as $product)
                                                        
                                                        <tr class="checkout-confirm-order-details-data">
                                                            <td width="15%">
                                                                <img class="img-fluid" src="{{ asset('/images/products') }}/{{ $product->getProduct->images->first()->img_url }}" alt width="100%"/>
                                                            </td>
                                                            <td width="65%">
                                                                 <span class="title">{{$product->getProduct->products_name}}</span><br/>
                                                                 Vendor:{{ $product->getProduct->vendor->first_name." ".$product->getProduct->vendor->last_name}}
                                                            </td>
                                                            <td width="20%">
                                                                ${{number_format($product->getProduct->product_total,'2','.',',')}}
                                                                 
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr><!--end of success info-->
                                        @endif
                                    </tbody>
                                </table>
                            </div><!--end of form-->
                        </div>
                        <div class="row">
                            <div class="col-md-4 checkout-btn-pnl">
                                <a class="btn-block vesti_in_btn checkout_next" href="{{ route('home_page') }}"/>{{$checkout_btn_name}}</a>
                            </div>
                        </div>
                        <!--end of content-->
               </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection