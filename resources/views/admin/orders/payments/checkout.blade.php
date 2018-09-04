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
<script src="https://js.braintreegateway.com/web/dropin/1.11.0/js/dropin.min.js"></script>
<form action="{{ route('admin_process_checkout') }}" id="vestidos-checkout-form" method="post">
{{ csrf_field() }}
    <input type="hidden" name="order_total" value="{{ $grand_total }}"/>
    <div class="container admin-checkout-address">
        <div class="row address-row">
            <div class="col shipping">
                <h3>Shipping Address</h3>
                <p>
                    {{ $shipping_name }}<br/>
                    {{ $shipping_address_1 }} {{ $shipping_address_2 }}<br/>
                    {{ $shipping_city }} {{ $shipping_state }} {{ $shipping_country_name }}, {{ $shipping_zip_code }}<br/>
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
                    {{ $billing_city }} {{ $billing_state }} {{ $billing_country_name }}, {{ $billing_zip_code }}<br/>
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
        <div id="dropin-container"></div>
        <input id="nonce" name="nonce" name="payment_method_nonce" type="hidden" />
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
            instance.requestPaymentMethod(function (err, payload) {
                document.querySelector("#nonce").value=payload.nonce;
                form.submit();
            });
        });
    });
  </script>
@endsection