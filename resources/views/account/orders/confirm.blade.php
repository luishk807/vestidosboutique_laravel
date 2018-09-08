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
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vehicula eros vitae lorem finibus faucibus. Morbi vitae blandit diam, id interdum risus. Cras sodales felis augue, efficitur suscipit magna aliquet at. 
            </P>
        </div>
    </div>
    <div class="container account-container">

        <form action="{{ route('delete_order',['order_id'=>$order->id])}}" method="post">
        <div class="container cancel-container">
            <div class="row">
                <div class="col text-center">
                    <h3>Are you sure want to cancel order {{ $order->order_number }}?</h3>
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <label class="cancelReasonSelect" for="cancelRason">Please choose reason for cancellation:</label>
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
                    <input type="submit" class="btn-block vesti_in_btn loader-button" value="{{ __('header.submit') }}"/>
                </div>
            </div>
        </div>
        </form>

    </div>
</div><!--end of main container-->
@endsection