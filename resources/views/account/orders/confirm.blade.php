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
        </div>
    </div>
    <div class="container account-container">

        <form action="{{ route('delete_order',['order_id'=>$order->id])}}" method="post">
        <div class="container cancel-container">
            <div class="row">
                <div class="col text-center">
                    <h3>{{ __('general.user_section.profile_order_cancel_title2',['name'=>$order->order_numbe]) }}?</h3>
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