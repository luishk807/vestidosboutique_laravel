@extends('admin/layouts.app')
@section('content')
<style>
.admin-btn-b{
    background-color: #fff;
    border: 1px solid #000;
    padding: 8px 40px;
    color: #000;
    cursor: pointer;
    display: inline-block;
}
</style>
<script src="https://js.braintreegateway.com/web/dropin/1.11.0/js/dropin.min.js"></script>
<form action="{{ route('admin_process_order_payment',['order_id'=>$order->id]) }}" id="vestidos-checkout-form" method="post">

{{ csrf_field() }}
    <div class="form-group">
        <label for="orderTotal">Amount:</label>
        <input type="number" id="orderTotal" class="form-control" name="order_total" min="0" step="0.01" value="" placeholder="0.00"/>
        <small class="error">{{$errors->first("order_total")}}</small>
    </div>
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