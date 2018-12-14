@extends("layouts.sub-layout")
@section('content')
<div class="main_sub_body contact_bg main_body_height">
<div class="container-fluid">
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-5 contact-container container-in-center">
            <div>
               <div class="container-in-space white-md-bg-in">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <form action="{{ route('sendEmail') }}" method="post" role="email">
                                {{ csrf_field() }}
                                    <h2>{{ __('header.contact') }}</h2>
                                    <div class="form-group">
                                            <label for="accountFirstName">{{ __('general.form.first_name') }}:</label>
                                            <input type="text" id="accountFirstName" class="form-control" name="first_name" value="" placeholder="{{ __('general.form.first_name') }}"/>
                                            <small class="error">{{$errors->first("first_name")}}</small>
                                    </div>
                                    <div class="form-group">
                                            <label for="accountLastName">{{ __('general.form.last_name') }}:</label>
                                            <input type="text" id="accountLastName" class="form-control" name="last_name" value="" placeholder="{{ __('general.form.last_name') }}"/>
                                            <small class="error">{{$errors->first("last_name")}}</small>
                                    </div>
                                    <div class="form-group">
                                            <label for="accountEmail">{{ __('general.form.email') }}:</label>
                                            <input type="email" id="accountEmail" class="form-control" name="email" value="" placeholder="{{ __('general.form.email') }}"/>
                                            <small class="error">{{$errors->first("email")}}</small>
                                    </div>
                                    <div class="form-group">
                                            <label for="accountPhone">{{ __('general.form.telephone') }}:</label>
                                            <input type="tel" id="accountPhone" class="form-control" name="phone" value="" placeholder="{{ __('general.form.telephone') }}"/>
                                            <small class="error">{{$errors->first("phone")}}</small>
                                    </div>
                                    <div class="form-group">
                                            <label class="accountCountrySelect" for="accountCountry">{{ __('general.form.country') }}:</label>
                                            <select class="custom-select accountCountrySelect" name="country" id="accountCountry">
                                                
                                                <option selected>{{ __('general.form.select_country') }}</option>
                                                @foreach($countries as $country)
                                                    <option vale="{{ $country->id }}">{{$country->countryName}} </option>
                                                @endforeach
                                            </select>
                                            <small class="error">{{$errors->first("country")}}</small>
                                    </div>
                                    <div class="form-group">
                                            <label for="accountQuestion">{{ __('general.form.question') }}:</label>
                                            <textarea class="form-control" id="accountQuestion" rows="3" name="{{ __('general.form.question') }}"></textarea>
                                            <small class="error">{{$errors->first("question")}}</small>
                                    </div>
                                    <div class="vesti_in_btn_pnl">
                                        <div id="vesti-load"><img src="{{ asset('/images/vesti_load.gif') }}"/></div>
                                        <input type="submit" class="btn-block vesti_in_btn loader-button" value="{{ __('buttons.send') }}">
                                    </div>
                                </form>

                            </div><!--end of contact form-->
                            <div class="col-md-6 col-lg-6 contact-section-right">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad vel earum ut tempore similique sint quam fugiat, sunt beatae reprehenderit voluptatum
                                <div class="container contact-address">
                                    <div class="row">
                                        <div class="col">
                                            <span class="header">{{ trans_choice('general.form.address',1) }}</span><br/>
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
                                        {{ __('general.page_header.opening_hours') }}
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