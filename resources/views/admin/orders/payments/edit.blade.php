@extends('admin/layouts.app')
@section('content')
<style>
    .red{
        color:red;
    }
    #form-error-msg{
        text-align: center;
    padding: 20px 100px;
    font-size: 1rem;
    border: 1px solid;
    display: inline-block;
    margin: 40px auto;
    }
</style>
<script>
function checkAdminRePaymentForm(){
    var currentTotal = $("#current_total").val();
    var totalPay = $("#orderTotal").val();
    var amtDue = $("#amtDue").val();
    if(amtDue > currentTotal || totalPay < 1){
        $(".form-error-msg").text("this");
        return false;
    }
    return false;
}
function modifyAmountDue(val){
    var currentTotal = $("#current_total").val();
    $(".form-error-msg").text("");
    $("#amtDue").removeClass('text-danger');
    if(!isNaN(val)){
        if(val < 1){
            $("#amtDue").val(currentTotal);
            return;
        }
        //var total = $("#amtDue").val();
        var newTotal = currentTotal - val;
        if(newTotal > currentTotal || newTotal < 0){
            $("#amtDue").addClass('text-danger');
        }else{
            $("#amtDue").removeClass('text-danger');
        }
        $("#amtDue").val(newTotal);
    }
}
</script>
<script src="https://js.braintreegateway.com/web/dropin/1.11.0/js/dropin.min.js"></script>
<form action="{{ route('admin_process_order_payment',['order_id'=>$order->id]) }}" id="vestidos-repayment-form" method="post" onSubmit="return checkAdminRePaymentForm()">

{{ csrf_field() }}
<input type="hidden" id="current_total" name="current_total" value="{{ $order->order_total}}"/>

    <div class="form-error-msg-cont">
    <div class="form-error-msg"></div>
    </div>
    <div class="form-group">
        <label for="orderTotal">Amount to pay:</label>
        <input type="number" onkeyup="modifyAmountDue(this.value)" id="orderTotal" class="form-control" name="order_total" min="0" step="0.01" value="" placeholder="0.00"/>
        <small class="error">{{$errors->first("order_total")}}</small>
    </div>
    <div class="form-group">
        <label for="amtDue">Amount Due:</label>
        <input type="number" id="amtDue" class="form-control" name="order_due" min="0" step="0.01" value="{{$order->order_total}}" placeholder="0.00"/>
        <small class="error">{{$errors->first("order_due")}}</small>
    </div>
   <div id="dropin-wrapper">
        <div id="checkout-message"></div>
        <!-- <div id="dropin-container"></div>
        <input id="nonce" name="nonce" name="payment_method_nonce" type="hidden" /> -->
        <div class="container billing-payment-section">
         @foreach($payment_types as $ptype_index=>$payment_type)
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
        @endforeach
        <!-- credit for record only -->
        <div class="row button">
            <div class="col">
                <input name="payment_type" value="{{ $payment_type->id }}"  credit-card='no' target-data="payment_content_x" type="radio"/>&nbsp;Credit Card [ Record Only ]
            </div>
        </div>
        <div class="row content" target-data="payment_content_x">
            <div class="col">

            </div>
        </div>
        <!-- end of record only -->
        </div>
        <div id="vesti-load"><img src="{{ asset('/images/vesti_load.gif') }}"/></div>
        <button class="btn-block admin-btn-b checkout-button" type="submit" id="submit-button">Submit payment</button>
    </div>
</form>
<!-- <script>
    var form = document.querySelector("#vestidos-checkout-form");
    braintree.dropin.create({
      authorization: "{{-- Braintree_ClientToken::generate() --}}",
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
  </script> -->
@endsection