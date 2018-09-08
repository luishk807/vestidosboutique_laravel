@extends("layouts.sub-layout")
@section('content')
<div class="main_sub_body contact_bg main_body_height">
<div class="container-fluid">
    <div class="row">

        <div class="col-md-5 contact-container container-in-center">
            <div>
               <div class="container-in-space white-md-bg-in">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                @if(isset($bodyMessage))
                                <div class="w3-container w3-orange">
                                    <p>
                                        <b>The data you have entered is :</b><span style="color: #e36c39; background: #EEE">{{ $bodyMessage }}</span>
                                    </p>
                                </div>
                                @endif
                                <form action="{{ route('sendEmail') }}" method="post" role="email">
                                {{ csrf_field() }}
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
                                                @foreach($countries as $country)
                                                    <option vale="{{ $country->id }}">{{$country->countryName}} </option>
                                                @endforeach
                                            </select>
                                            <small class="error">{{$errors->first("country")}}</small>
                                    </div>
                                    <div class="form-group">
                                            <label for="accountQuestion">Question:</label>
                                            <textarea class="form-control" id="accountQuestion" rows="3" name="question"></textarea>
                                            <small class="error">{{$errors->first("question")}}</small>
                                    </div>
                                    <div class="vesti_in_btn_pnl">
                                        <div id="vesti-load"><img src="{{ asset('/images/vesti_load.gif') }}"/></div>
                                        <input type="submit" class="btn-block vesti_in_btn loader-button" value="{{ __('buttons.send') }}">
                                    </div>
                                </form>

                            </div><!--end of contact form-->
                            <div class="col-md-6 contact-section-right">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad vel earum ut tempore similique sint quam fugiat, sunt beatae reprehenderit voluptatum
                                <div class="container contact-address">
                                    <div class="row">
                                        <div class="col">
                                            <span class="header">{{ __('general.address') }}</span><br/>
                                            <a href='https://goo.gl/maps/xM81XLeuLGP2' target="_blank">El Calle Eusebio A. Morales, Hotel Milan, Local 2, En frente del Marquis Tower, Panama</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col address-phone">
                                            <a target="_blank" class="footer-link" href="tel:5265848">(507) 203-5848</a> &#05; <a target="_blank" class="footer-link" href="67266556">(507) 6726-6556</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col header">
                                        {{ __('general.opening_hours') }}
                                        </div>
                                    </div>
                                    <div class="row address-hour">
                                        <div class="col-md-6">
                                        {{ __('general.weekdays.monday') }}-{{ __('general.weekdays.friday') }}
                                        </div>
                                        <div class="col-md-6">
                                            10:00 a.m. - 9:00 p.m.
                                        </div>
                                    </div>
                                    <div class="row address-hour">
                                        <div class="col-md-6">
                                        {{ __('general.weekdays.sunday') }}
                                        </div>
                                        <div class="col-md-6">
                                            10:00 a.m. - 9:00 p.m.
                                        </div>
                                    </div>
                                </div><!--end of address-->
                            </div><!--end of company info-->
                        </div>
                    </div>


               </div>
            </div>
        </div>

    </div>
</div>
</div>
@endsection