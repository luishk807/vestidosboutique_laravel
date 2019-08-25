@extends('admin/layouts.app')
@section('content')
<script>
$(document).ready(function(){
    var firstOpenChecked = $("input:radio[name='payment_type']:checked").attr("target-data");
    openRadioContent(firstOpenChecked)
    $("input[name='payment_type']").click(function(e){
        var target_data= $(e.target).attr("target-data");
        openRadioContent(target_data)
    })
})

</script>
<script src="https://js.braintreegateway.com/web/dropin/1.11.0/js/dropin.min.js"></script>
<form action="{{ route('admin_process_checkout') }}" id="vestidos-checkout-form" method="post">
{{ csrf_field() }}
    <input type="hidden" name="order_total" value="{{ $grand_total }}"/>
    <input type="hidden" id="is_credit_card" name="is_credit_card" value="no">
    <div class="container admin-checkout-address">
        <div class="row address-row">
            @if($main_config->allow_shipping)
            <div class="col shipping">
                <h3>Shipping Address</h3>
                <p>
                    {{ $shipping_name }}<br/>
                    {{ $shipping_address_1 }} {{ $shipping_address_2 }}<br/>
                    {{ $shipping_province }} {{ $shipping_district }}  {{ $shipping_corregimiento }} {{ $shipping_country_name }}, {{ $shipping_zip_code }}<br/>
                    {{ $shipping_email }}<br/>
                    {{ $shipping_phone_number_1 }}<br/>
                    {{ $shipping_phone_number_2 }}
                </p>
            </div><!--shipping-->
            @endif
            <div class="col billing">
                <h3>Billing Address</h3>
                <p>
                    {{ $billing_name }}<br/>
                    {{ $billing_address_1 }} {{ $billing_address_2 }}<br/>
                    {{ $billing_province }} {{ $billing_district }}  {{ $billing_corregimiento }}{{ $billing_country_name }}, {{ $billing_zip_code }}<br/>
                    {{ $billing_email }}<br/>
                    {{ $billing_phone_number_1 }}<br/>
                    {{ $billing_phone_number_2 }}
                </p>
            
            </div><!--billing-->
        </div>
    </div><!--address-->
    <div class="container admin-checkout-product">
        <div class="row headers-row">
            <div class="col-md-1 index">
                
            </div>
            <div class="col-md-2 image">
                Image
            </div>
            <div class="col-md-4 description">
                Description
            </div>
            <div class="col-md-2 quantity">
                Quant
            </div>
            <div class="col-md-3 total">
                Total
            </div>
        </div>
        @foreach($products as $prodKey=>$product)
        <div class="row products-row">
            <div class="col-md-1 index">
                {{$prodKey + 1}}.
            </div>
            <div class="col-md-2 image">
                <img src="{{ asset('images/products')}}/{{ $product['img'] }}" class="img-fluid" alt>
            </div>
            <div class="col-md-4 description">
                {{ $product['name'] }}<br/>
                Color: {{ $product['color'] }}<br/>
                Size: {{ $product['size'] }}
            </div>
            <div class="col-md-2 quantity">
                {{ $product['quantity'] }}
            </div>
            <div class="col-md-3 total">
                {{ $product['total'] }}
            </div>
        </div>
        @endforeach
    </div><!--end of products-->
    <div class="container admin-checkout-total">
        <div class="row total-row">
            <div class="col-md-10 header">
                Subtotal:
            </div>
            <div class="col-md-2 total">
                ${{number_format($order_total,'2','.',',')}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 header">
                Tax:
            </div>
            <div class="col-md-2 total">
                ${{number_format($order_tax,'2','.',',')}}
            </div>
        </div>
        @if($main_config->allow_shipping)
        @php($order_total = $order_total + $order_shipping + $order_tax)
        <div class="row">
            <div class="col-md-10 header">
                Shipping:
            </div>
            <div class="col-md-2 total">
                ${{number_format($order_shipping,'2','.',',')}}
            </div>
        </div>
        @endif

        @if($discount_app)
        <div class="row">
            <div class="col-md-10 header">
                Total:
            </div>
            <div class="col-md-2 total">
                ${{ number_format($order_total + $order_tax,'2','.',',') }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 header">
                Discount:
                <br/>[ <a href='javascript:removeDiscount()'>{{ __('buttons.remove') }}</a> ]
            </div>
            <div class="col-md-2 total">
                - ${{ number_format($discount_app,'2','.',',') }}
                <input type="hidden" id="discount_total" name="discount_total" value="{{ $discount_app }}"/>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-md-10 header">
                Grand Total:
            </div>
            <div class="col-md-2 total">
                ${{number_format($grand_total - $discount_app,'2','.',',')}}
            </div>
        </div>
    </div><!--end of total-->
    <div class="container-fluid px-0 coupon-container">
        <div class="row">
                <div class="col text-left" id="coupon_section">
                    <table width="100%" class="table">
                    <tr>
                        <!-- <th class="checkout-subtitle" colspan="2">{{ trans_choice('general.form.address',2) }}</th> -->
                        <th class="checkout-subtitle pl-2" colspan="2">{{ __('general.cart_title.discount_apply') }}</th>
                    </tr>
                    <tr>
                        <td>{{ __('general.cart_title.discount_restriction') }}</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <input onKeyUp="clearCouponError()" type="text" id="coupon_code" class="form-control" name="coupon_code" value=""/>
                                <a href="javascript:applyDiscount()" id="coupon_code_link" class="btn form-control vestidos-link-btn text-uppercase">{{ __('buttons.add') }}</a>
                                <br/>
                                <small class="error">{{$errors->first("coupon_code")}}</small>
                            </div>

                        </td>
                    </tr>
                </table>
            </div>
        </div>

    </div>
   <div id="dropin-wrapper">
        <div id="checkout-message"></div>
        <!-- <div id="dropin-container"></div>
        <input id="nonce" name="nonce" name="payment_method_nonce" type="hidden" /> -->
        <div class="container billing-payment-section">
         @foreach($payment_types as $ptype_index=>$payment_type)
         @if(!$payment_type->is_credit_card || ($payment_type->is_credit_card && $main_config->allow_credit_card))
        <div class="row button">
            <div class="col">
                <input name="payment_type" value="{{ $payment_type->id }}" 
                @if($payment_type->is_credit_card))
                credit-card='yes'
                @else
                credit-card='no' 
                @endif
                @if($ptype_index==0)
                checked='checked'
                @endif
                target-data="payment_content_{{ $ptype_index }}" type="radio"/>&nbsp;{{ $payment_type->name }}
            </div>
        </div>
        <div class="row content" target-data="payment_content_{{ $ptype_index }}">
            <div class="col">
            @if($payment_type->description)
            {{ $payment_type->description }}
            @else
                <div id="dropin-container"></div>
                <input id="nonce" name="nonce" name="payment_method_nonce" type="hidden" />
            @endif
            </div>
        </div>
        @endif
        @endforeach
        </div>
        <div id="vesti-load"><img src="{{ asset('/images/vesti_load.gif') }}"/></div>
        <button class="btn-block admin-btn-b checkout-button" type="submit" id="submit-button">Submit payment</button>
    </div>
</form>
@if($main_config->allow_credit_card)
<script>
    var form = document.querySelector("#vestidos-checkout-form");
    braintree.dropin.create({
      authorization: "{{ Braintree_ClientToken::generate() }}",
      selector: '#dropin-container'
    }, function (createErr, instance) {
        if(createErr){
            console.log(createErr);
            return;
        }
        form.addEventListener('submit',function(event){
            event.preventDefault();
            if($("#is_credit_card").val()=="yes"){
                instance.requestPaymentMethod(function (err, payload) {
                    document.querySelector("#nonce").value=payload.nonce;
                    form.submit();
                });
            }else{
                form.submit();
            }
        });
    });
  </script>
@endif
@endsection