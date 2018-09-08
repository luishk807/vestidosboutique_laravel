@extends("layouts.sub-layout")
@section('content')
<style>
    .signin-container .signin-signup-section{
        border-left:1px solid rgba(0,0,0,.1);
    }
    @media only screen and (max-width: 600px) {
        .signin-container .signin-signup-section {
            border-left: none;
        }
    }
</style>
<div class="main_sub_body main_body_height">
<div class="container-fluid">
    <div class="row">
        <div class="col container-in-center">
            <div>
               <div class="container-in-space white-md-bg-in">
                    <div class="container signin-container">
                        <div class="row">
                            <div class="col-md-6 signin-login-section">
                                
                                <div class="container">
                                    <form action="{{ route('login_user') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col"><h2>Iniciar Sesión</h2></div>
                                    </div>
                                    <div class="row">
                                        <div class="col error py-2">
                                        @if(Session::has("msg"))
                                        {{Session::get("msg")}}
                                        @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            
                                            <div class="form-group">
                                                <label for="loginEmail">Email:</label>
                                                <input type="email" id="loginEmail" class="form-control" name="email" placeholder="Email"/>
                                                <small class="error">{{$errors->first("email")}}</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="loginPassword">Contraseña:</label>
                                                <input type="password" id="loginPassword" class="form-control" aria-describedby="passwordHelp"  name="password" placeholder="Contraseña"/>
                                                <small class="error">{{$errors->first("password")}}</small>
                                                <small id="passwordHelp" class="form-text text-muted"><a href="" class="vesti-small-link">Olvidó su contraseña?</a></small>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">

                                            <div class="vesti_in_btn_pnl">
                                                <div id="vesti-load"><img src="{{ asset('/images/vesti_load.gif') }}"/></div>
                                                <input type="submit" class="btn-block vesti_in_btn loader-button" value="Continuar">
                                            </div>

                                        </div>
                                    </div>
                                    </form>
                                </div><!--end of login section-->

                            
                            </div><!--end of login column-->
                            <div class="col-md-6 signin-signup-section">


                                <div class="container">
                                    <div class="row">
                                        <div class="col"><h2>Regístrate</div>
                                    </div>
                                    <div class="row">
                                        <div class="col">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolores,</div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="vesti_in_btn_pnl">
                                                <a class="btn-block vesti_in_btn" href="{{route('newuser')}}">Continuar</a>
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