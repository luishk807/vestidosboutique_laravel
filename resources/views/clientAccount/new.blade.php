@extends("layouts.sub-layout")
@section('content')
<div class="main_sub_body main_body_height">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-9 container-in-center">
            <div>
               <div class="container-in-space white-md-bg-in">
                    <div class="container account-container">
                        <div class="row">
                            <div class="col-md-8 account-form-section">
                                <h2>{{$page_title}}</h2>
                                <form action="{{ route('createclient')}}" method="post">
                                <div class="form-group">
                                        <label class="accountTitleSelect" for="accountTitle">Select Title:</label>
                                        <select class="custom-select accountTitleSelect" name="title" id="accountTitle">
                                            <option selected>Select Title</option>
                                            @for($i=0;$i<sizeof($titles);$i++)
                                                <option value="{{$titles[$i]}}">{{$titles[$i]}}</option>
                                            @endfor
                                        </select>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="accountFirstName">First Name:</label>
                                        <input type="text" id="accountFirstName" class="form-control" name="first_name" value="" placeholder="First Name"/>
                                        <small class="error">{{$errors->first("first_name")}}</small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="accountLastName">Last Name:</label>
                                        <input type="text" id="accountLastName" class="form-control" name="last_name" value="" placeholder="Last Name"/>
                                        <small class="error">{{$errors->first("last_name")}}</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label for="accountEmail">Email:</label>
                                        <input type="email" id="accountEmail" class="form-control" name="email" value="" placeholder="Email"/>
                                        <small class="error">{{$errors->first("email")}}</small>
                                </div>
                                <div class="form-group">
                                        <label for="accountPhone">Phone:</label>
                                        <input type="tel" id="accountPhone" class="form-control" name="phone" value="" placeholder="Phone Number"/>
                                        <small class="error">{{$errors->first("phone")}}</small>
                                </div>
                                <div class="form-group">
                                        <label for="accountPassword">Password:</label>
                                        <input type="password" id="accountPassword" class="form-control" name="password" value="" placeholder="Password"/>
                                        <small class="error">{{$errors->first("password")}}</small>
                                </div>
                                <div class="form-group">
                                        <label for="accountRePassword">Re-Type Password:</label>
                                        <input type="password" id="accountRePassword" class="form-control" name="repassword" value="" placeholder="Re-Type Password"/>
                                </div>
                                <div class="form-group">
                                        <label class="accountCountrySelect" for="accountCountry">Select Country:</label>
                                        <select class="custom-select accountCountrySelect" name="country" id="accountCountry">
                                            <option selected>Select Country</option>
                                        </select>
                                        <small class="error">{{$errors->first("country")}}</small>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                            <label for="accountCity">City:</label>
                                            <input type="text" id="accountCity" class="form-control" name="city" value="" placeholder="City"/>
                                            <small class="error">{{$errors->first("city")}}</small>
                                    </div>
                                    <div class="form-group col-md-6">
                                            <label for="accountPostal">Zip Code:</label>
                                            <input type="text" id="accountPostal" class="form-control" name="postal_code" value="" placeholder="Postal Code"/>
                                            <small class="error">{{$errors->first("postal_code")}}</small>
                                    </div>
                                </div>
                                <div class="vesti_in_btn_pnl">
                                    <input type="submit" class="btn-block vesti_in_btn" value="Sign Up"/>
                                </div>
                                </form>
                            </div><!--end of form container-->
                        </div>
                    </div>
               </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection