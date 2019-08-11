@extends("layouts.sub-layout-account")
@section('content')
<div class="container container-in-space white-md-bg-in">
    <div class="row">
        <div class="col">
            <h2>{{$page_title}}</h2>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <P>
            {{ __('general.user_section.profile_order_cancel') }}
            </P>
            <ul>
                <li>Si no se ha efectuado pago a su pedido, se puede cancelarla fácilmente desde su perfil con la cuenta registrada en nuestra web.</li>
                <li>Si ha realizado pago y su pedido está en status &#34;EN PROCESO&#34;, puede solicitar la cancelación a través de nuestro email <b>pedidos@vestidosboutique.com</b>.</li>
                <li>Penalidad de cancelación: Si se comunica con nosotros para cancelar dentro de las 24 horas posteriores al pago, le daremos un reembolso completo del valor pagado. Si han transcurrido más de 24 horas, aplicará un cargo por manejo administrativo de $25.</li>
                <li>Una vez que su pedido está en status &#34;PROCESADO&#34;, no se podrá cancelar. Aplica la política de <a href="{{ route('terms_use')}}" target="_blank">DEVOLUCION y CAMBIOS punto 3.</a></li>
            </ul>
        </div>
    </div>
    <div class="container account-container">

        <form action="{{ route('delete_order',['order_id'=>$order->id])}}" method="post">
        <div class="container cancel-container">
            <div class="row">
                <div class="col text-center">
                    <h3>{{ __('general.user_section.profile_order_cancel_title2',['name'=>$order->order_number]) }}?</h3>
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <label class="cancelReasonSelect" for="cancelRason">{{ __('general.user_section.profile_order_cancel_title3') }}:</label>
                    <select class="custom-select cancelReasonSelect" name="cancel_reason" id="cancelRason">
                        @foreach($cancel_reasons as $cancel_reason)
                            <option value="{{$cancel_reason->id}}">{{$cancel_reason->name}}</option>
                        @endforeach
                    </select>
                    <small class="error">{{$errors->first("cancel_reason")}}</small>
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <div id="vesti-load"><img src="{{ asset('/images/vesti_load.gif') }}"/></div>
                    <input type="submit" class="btn-block vesti_in_btn loader-button" value="{{ __('buttons.submit') }}"/>
                </div>
            </div>
        </div>
        </form>

    </div>
</div><!--end of main container-->
@endsection