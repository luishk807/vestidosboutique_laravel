@extends("layouts.sub-layout")
@section('content')
<div class="main_sub_body main_body_height">
<div class="container-fluid">
    <div class="row">
        <div class="col container-in-center">
            <div>
               <div class="container-in-space white-md-bg-in">
                    <div class="container reset-password-container">
                        <div class="row">
                            <div class="col-md-6 reset-password-container-section">
                                
                                <div class="container">
                                    <form action="{{ route('send_reset_password_email') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col"><h2>{{ __('general.forgot_password.title') }}</h2></div>
                                    </div>
                                    <div class="row">
                                        <div class="col error py-2">
                                        @if(count($errors) > 0)
                                            @foreach ($errors->all() as $error)
                                            {{ $error }}<br/>
                                            @endforeach
                                        @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                        {{ __('general.forgot_password.title_2') }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            
                                            <div class="form-group">
                                                <label for="loginEmail">{{ __('general.form.email') }}:</label>
                                                <input type="email" id="loginEmail" class="form-control" name="email" placeholder="{{ __('general.form.email') }}"/>
                                                <small class="error">{{$errors->first("email")}}</small>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">

                                            <div class="vesti_in_btn_pnl">
                                                <div id="vesti-load"><img src="{{ asset('/images/vesti_load.gif') }}"/></div>
                                                <input type="submit" class="btn-block vesti_in_btn loader-button" value="{{ __('buttons.send') }}">
                                            </div>

                                        </div>
                                    </div>
                                    </form>
                                </div><!--end of login section-->

                            
                            </div><!--end of login column-->
                        </div><!--end of main row-->
                    </div><!--end of cart-container-in-->
               </div><!--end of container-in-space -->
            </div>
        </div><!--end of container-in-center -->
    </div>
</div>
</div>
@endsection