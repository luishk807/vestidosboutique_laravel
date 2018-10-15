@extends('admin/layouts.app')
@section('content')
<style>
.admin-checkout-address{
    margin:10px 0px;
}
.admin-checkout-address .address-row{
    text-align:center;
}
.admin-checkout-address .shipping h3,
.admin-checkout-address .billing h3{
    text-decoration:underline;
}
.admin-checkout-address .shipping,
.admin-checkout-address .billing,
.admin-checkout-product .quantity{
    text-align:center;
}
.admin-checkout-product .index,
.admin-checkout-product .image{
    text-align:center;
}
.admin-checkout-product .description{
    text-align:left;
}
.admin-checkout-product .total{
    text-align:right;
}
.admin-checkout-product .row{
    border-top: 1px solid rgba(0,0,0,.1);
}
.admin-checkout-product .row:last-child{
    border-bottom: 1px solid rgba(0,0,0,.1);
}
.admin-checkout-product .headers-row{
    padding:10px 0px;
}
.admin-checkout-product .products-row{
    padding:10px 0px;
}
.admin-checkout-total{
    margin:10px 0px;
}
.admin-checkout-total .header,
.admin-checkout-total .total{
    margin:2px 0px;
}
.admin-checkout-total .row:last-child .header,
.admin-checkout-total .row:last-child .total{
    font-weight:bold;
}
</style>

<style>
.billing-payment-section{
    margin:20px 0px 30px 0px;
}
.billing-payment-section .row.button{
    border-bottom: 1px solid rgba(0,0,0,.1);
}
.billing-payment-section .row.button:first-child{
    border-top: 1px solid rgba(0,0,0,.1);
}
.billing-payment-section .row{
    border-left: 1px solid rgba(0,0,0,.1);
    border-right: 1px solid rgba(0,0,0,.1);
}
.billing-payment-section .row .col{
    padding:10px;
}
.billing-payment-section .row.content .col{
    padding:20px;
    background-color:#fafafa;
    border-bottom: 1px solid rgba(0,0,0,.1);
}
.billing-payment-section .row.content{
    display:none;
}
.braintree-sheet__header{
    display:none !important;
}
.braintree-sheet{
    background-color: #fafafa;
    border: none;
}
</style>


<script>
$(document).ready(function(){
    var firstOpenChecked = $("input:radio[name='payment_type']:checked").attr("target-data");
    openRadioContent(firstOpenChecked)
    $("input[name='payment_type']").click(function(e){
        var target_data= $(e.target).attr("target-data");
        openRadioContent(target_data)
    })
})
function openRadioContent(content){
    var is_credit = $("input:radio[name='payment_type']:checked").attr("credit-card");
    if(is_credit=="yes"){
        $("#is_credit_card").val("yes");
    }else{
        $("#is_credit_card").val("no");
    }
    $("div.row.content").css("display","none");
    $("div[target-data='"+content+"']").css("display","block");
}
</script>
<script src="https://js.braintreegateway.com/web/dropin/1.11.0/js/dropin.min.js"></script>
<form action="{{ route('admin_process_checkout') }}" id="vestidos-checkout-form" method="post">
{{ csrf_field() }}
    <input type="hidden" name="order_total" value="{{ $grand_total }}"/>
    <input type="hidden" id="is_credit_card" name="is_credit_card" value="no">
    <div class="container admin-checkout-address">
        <div class="row address-row">
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
        <div class="row">
            <div class="col-md-10 header">
                Shipping:
            </div>
            <div class="col-md-2 total">
                ${{number_format($order_shipping,'2','.',',')}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 header">
                Grand Total:
            </div>
            <div class="col-md-2 total">
                ${{number_format($grand_total,'2','.',',')}}
            </div>
        </div>
    </div><!--end of total-->
   <div id="dropin-wrapper">
        <div id="checkout-message"></div>
        <!-- <div id="dropin-container"></div>
        <input id="nonce" name="nonce" name="payment_method_nonce" type="hidden" /> -->
        <div class="container billing-payment-section">
         @foreach($payment_types as $ptype_index=>$payment_type)
        <div class="row button">
            <div class="col">
                <input name="payment_type" value="{{ $payment_type->id }}" 
                @if(empty($payment_type->description))
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
        @endforeach
        </div>
        <div id="vesti-load"><img src="{{ asset('/images/vesti_load.gif') }}"/></div>
        <button class="btn-block admin-btn-b checkout-button" type="submit" id="submit-button">Submit payment</button>
    </div>
</form>
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
@endsection