@extends("layouts.sub-layout")
@section('content')
<div class="main_sub_body main_body_height">
<div class="container-fluid">
    <div class="row">
        <div class="col container-in-center">
            <div>
               <div class="container-in-space white-md-bg-in">
                    <div class="container signin-container">
                        @if(Session::has("activate_required"))
                        <div class="row">
                            <div class="col">
                                <div class="warning-cont">
                                    {{ Session::get("activate_required") }} &nbsp; 
                                    <a href="{{ route('show_resend_active_user_account') }}">{{ __('buttons.resend_activation')}}</a>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6 signin-login-section">
                                
                                <div class="container">
                                    <form action="{{ route('login_user') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col"><h2>{{ __('header.log_in') }}</h2></div>
                                    </div>
                                    <div class="row">
                                        <div class="col py-2">
                                        @if(Session::has("msg"))
                                        <div class="warning-cont">
                                        {{Session::get("msg")}}
                                        </div>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            
                                            <div class="form-group">
                                                <label for="loginEmail">{{ __('general.form.email') }}:</label>
                                                <input type="email" id="loginEmail" class="form-control" name="email" placeholder="{{ __('general.form.email') }}"/>
                                                <small class="error">{{$errors->first("email")}}</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="loginPassword">{{ __('general.form.password') }}:</label>
                                                <input type="password" id="loginPassword" class="form-control" aria-describedby="passwordHelp"  name="password" placeholder="{{ __('general.form.password') }}"/>
                                                <small class="error">{{$errors->first("password")}}</small>
                                                <small id="passwordHelp" class="form-text text-muted"><a href="{{ route('show_send_reset_password') }}" class="vesti-small-link">{{ __('auth.forgot_password') }}</a></small>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">

                                            <div class="vesti_in_btn_pnl">
                                                <div id="vesti-load"><img src="{{ asset('/images/vesti_load.gif') }}"/></div>
                                                <input type="submit" class="btn-block vesti_in_btn loader-button" value="{{ __('buttons.submit') }}">
                                            </div>

                                        </div>
                                    </div>
                                    </form>
                                </div><!--end of login section-->

                            
                            </div><!--end of login column-->
                            <div class="col-md-6 signin-signup-section">


                                <div class="container">
                                    <div class="row">
                                        <div class="col"><h2>{{ __('header.registration') }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col">{{ __('general.user_section.register_text') }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="vesti_in_btn_pnl">
                                                <a class="btn-block vesti_in_btn" href="{{route('newuser')}}">{{ __('buttons.register_account') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end of sign up section-->


                            </div><!--end of sign up column-->
                        </div><!--end of main row-->
                    </div><!--end of cart-container-in-->
               </div><!--end of container-in-space -->
            </div>
        </div><!--end of container-in-center -->
    </div>
</div>
</div>
@endsection