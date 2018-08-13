@extends("layouts.sub-layout")
@section('content')
<script src="https://js.braintreegateway.com/web/dropin/1.11.0/js/dropin.min.js"></script>
<div class="main_sub_body main_body_height">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-9 container-in-center">
            <div>
               <div class="container-in-space confirm-col">
                    <div class="row">
                        <div class="col">
                            <div id="dropin-wrapper">
                                <div id="checkout-message"></div>
                                <div id="dropin-container"></div>
                                <button id="submit-button">Submit payment</button>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    var button = document.querySelector('#submit-button');

    braintree.dropin.create({
      authorization: "{{ Braintree_ClientToken::generate() }}",
      container: '#dropin-container'
    }, function (createErr, instance) {
      button.addEventListener('click', function () {
        instance.requestPaymentMethod(function (err, payload) {
          $.get("{{ route('payment.process') }}", {payload}, function (response) {
            if (response.success) {
              console.log(response);
              alert('Payment successfull!');
            } else {
              alert('Payment failed');
            }
          }, 'json');
        });
      });
    });
  </script>
@endsection