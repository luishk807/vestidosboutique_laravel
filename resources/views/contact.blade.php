@extends("layouts.sub-layout")
@section('content')
<style>
.contact-container{
    padding-left:0px;
    padding-right:0px;
}
.contact-container .contact-section-right{
    margin-top: 10%;
}
</style>
<div class="main_sub_body contact_bg main_body_height">
<div class="container-fluid">
    <div class="row">

        <div class="col-md-5 contact-container container-in-center">
            <div>
               <div class="container-in-space white-md-bg-in">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7">
                                <form action="{{ route('sendEmail') }}" method="post">
                                    <h2>Contact</h2>
                                    <div class="form-group">
                                            <label for="accountFirstName">First Name:</label>
                                            <input type="text" id="accountFirstName" class="form-control" name="first_name" value="" placeholder="First Name"/>
                                            <small class="error">{{$errors->first("first_name")}}</small>
                                    </div>
                                    <div class="form-group">
                                            <label for="accountLastName">Last Name:</label>
                                            <input type="text" id="accountLastName" class="form-control" name="last_name" value="" placeholder="Last Name"/>
                                            <small class="error">{{$errors->first("last_name")}}</small>
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
                                            <label class="accountCountrySelect" for="accountCountry">Select Country:</label>
                                            <select class="custom-select accountCountrySelect" name="country" id="accountCountry">
                                                <option selected>Select Country</option>
                                            </select>
                                            <small class="error">{{$errors->first("country")}}</small>
                                    </div>
                                    <div class="form-group">
                                            <label for="accountQuestion">Question:</label>
                                            <textarea class="form-control" id="accountQuestion" rows="3" name="question"></textarea>
                                            <small class="error">{{$errors->first("question")}}</small>
                                    </div>
                                    <div class="vesti_in_btn_pnl">
                                        <input type="submit" class="btn-block vesti_in_btn" value="Send">
                                    </div>
                                </form>

                            </div><!--end of contact form-->
                            <div class="col-md-5 contact-section-right">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad vel earum ut tempore similique sint quam fugiat, sunt beatae reprehenderit voluptatum
                            </div>
                        </div>
                    </div>


               </div>
            </div>
        </div>

    </div>
</div>
</div>
@endsection