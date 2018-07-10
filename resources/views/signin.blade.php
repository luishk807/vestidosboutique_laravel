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
                                        <div class="col"><h2>Log In</h2></div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            
                                            <div class="form-group">
                                                <label for="loginEmail">Email:</label>
                                                <input type="email" id="loginEmail" class="form-control" name="email" placeholder="Email"/>
                                                <small class="error">{{$errors->first("email")}}</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="loginPassword">Password:</label>
                                                <input type="password" id="loginPassword" class="form-control" aria-describedby="passwordHelp"  name="password" placeholder="Password"/>
                                                <small class="error">{{$errors->first("password")}}</small>
                                                <small id="passwordHelp" class="form-text text-muted"><a href="" class="vesti-small-link">Forgot Passord?</a></small>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">

                                            <div class="vesti_in_btn_pnl">
                                                <input type="submit" class="btn-block vesti_in_btn" value="Login">
                                            </div>

                                        </div>
                                    </div>
                                    </form>
                                </div><!--end of login section-->

                            
                            </div><!--end of login column-->
                            <div class="col-md-6 signin-signup-section">


                                <div class="container">
                                    <div class="row">
                                        <div class="col"><h2>Sign Up</div>
                                    </div>
                                    <div class="row">
                                        <div class="col">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolores,</div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="vesti_in_btn_pnl">
                                                <a class="btn-block vesti_in_btn" href="{{route('newuser')}}">Sign Up</a>
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