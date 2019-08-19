@extends('admin/layouts.app')
@section('content')
<style>
    .form-error-msg-cont{
        text-align:center;
        margin: 40px auto;
        display:none;
    }
    .form-error-msg{
        text-align: center;
        padding: 15px 100px;
        font-size: 1rem;
        border: 1px solid rgba(0,0,0,.1);
        display: inline-block;
    }
    .billing-payment-section{
        margin:20px 0px 30px 0px;
    }
    .billing-payment-section .row{
      border-left: 1px solid rgba(0,0,0,.1);
      border-right: 1px solid rgba(0,0,0,.1);
    }
    .billing-payment-section .row.button{
        border-bottom: 1px solid rgba(0,0,0,.1);
    }
    .billing-payment-section .row.button:first-child{
        border-top: 1px solid rgba(0,0,0,.1);
    }
    .billing-payment-section .col{
        padding:10px;
    }
    .billing-payment-section .content{
        display:none;
    }
    .billing-payment-section .content .col{
        padding:20px;
        background-color:#fafafa;
        border-bottom: 1px solid rgba(0,0,0,.1);
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
    var firstOpenChecked = $("input:radio[name='payment_type[]']:checked").attr("target-data");
    if(firstOpenChecked){
        openRadioContent(firstOpenChecked)
        $("input[name='payment_type[]']").click(function(e){
            var target_data= $(e.target).attr("target-data");
            openRadioContent(target_data)
        })
    }
})
function openRadioContent(content){
    console.log("hey",content)
    var is_credit = $("input:radio[name='payment_type[]']:checked").attr("credit-card");
    if(is_credit=="yes"){
        $("#is_credit_card").val("yes");
    }else{
        $("#is_credit_card").val("no");
    }
    $("div.row.content").css("display","none");
    $("div[target-data='"+content+"']").css("display","block");
}
function checkAdminRePaymentForm(){
    var currentTotal = $("#current_total").val();
    var totalPay = $("#orderTotal").val();
    var amtDue = $("#amtDue").val();
    if(totalPay < 1){
        $(".form-error-msg").text("Please enter a valid amount");
        $(".form-error-msg-cont").show();
        return false;
    }
    return true;
}
function modifyAmountDue(val){
    var currentTotal = $("#current_total").val();
    $(".form-error-msg-cont").hide();
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
        $("#amtDue").val(newTotal.toFixed(2));
    }
}
</script>
<script src="https://js.braintreegateway.com/web/dropin/1.11.0/js/dropin.min.js"></script>
<form action="{{ route('admin_process_order_payment',['order_id'=>$order->id]) }}" id="vestidos-repayment-form" method="post" onSubmit="return checkAdminRePaymentForm()">

{{ csrf_field() }}
<input type="hidden" id="current_total" name="current_total" value="{{ $amount_due }}"/>
<input type="hidden" id="is_credit_card" name="is_credit_card" value=""/>

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
        <input type="number" readonly id="amtDue" class="form-control" name="order_due" min="0" step="0.01" value="{{$amount_due}}" placeholder="0.00"/>
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
                <input name="payment_type[]" value="{{ $payment_type->id }}" 
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
        <!-- end of record only -->
        </div>
    </div>
    <div class="form-group">
        <label for="amtDue">Send Email Notification?:</label>
        <input type="checkbox" id="sendNotification" name="sendNotification" checked/>
    </div>
    <div id="vesti-load"><img src="{{ asset('/images/vesti_load.gif') }}"/></div>
        <button class="btn-block admin-btn-b checkout-button" type="submit" id="submit-button">Submit payment</button>
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