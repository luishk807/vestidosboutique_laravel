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
                                <form action="{{ route('createuser')}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                        <label class="accountTitleSelect" for="accountLanguage">{{ trans_choice('general.form.select_language',1) }}:</label>
                                        <select class="custom-select accountTitleSelect" name="preferred_language" id="accountLanguage">
                                            @foreach($languages as $language)
                                                <option value="{{$language->id}}">{{$language->name}}</option>
                                            @endforeach
                                        </select>
                                        <small class="error">{{$errors->first("preferred_language")}}</small>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="accountFirstName">{{ __('general.form.first_name') }}:</label>
                                        <input type="text" id="accountFirstName" class="form-control" name="first_name" value="{{ old('first_name')}}" placeholder="{{ __('general.form.first_name') }}"/>
                                        <small class="error">{{$errors->first("first_name")}}</small>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="accountMiddleName">{{ __('general.form.middle_name') }}:</label>
                                        <input type="text" id="accountMiddleName" class="form-control" name="middle_name" value="{{ old('middle_name')}}" placeholder="{{ __('general.form.middle_name') }}"/>
                                        <small class="error">{{$errors->first("middle_name")}}</small>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="accountLastName">{{ __('general.form.last_name') }}:</label>
                                        <input type="text" id="accountLastName" class="form-control" name="last_name" value="{{ old('last_name')}}" placeholder="{{ __('general.form.last_name') }}"/>
                                        <small class="error">{{$errors->first("last_name")}}</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label for="accountEmail">{{ __('general.form.email') }}:</label>
                                        <input type="email" id="accountEmail" class="form-control" name="email" value="{{ old('email')}}" placeholder="{{ __('general.form.email') }}"/>
                                        <small class="error">{{$errors->first("email")}}</small>
                                </div>
                                <div class="form-group">
                                        <label for="accountPhone">{{ __('general.form.telephone') }}:</label>
                                        <input type="tel" id="accountPhone" class="form-control" name="phone_number" value="{{ old('phone')}}" placeholder="{{ __('general.form.telephone') }}"/>
                                        <small class="error">{{$errors->first("phone_number")}}</small>
                                </div>
                                <div class="form-group">
                                    <label for="accountDob">{{ __('general.form.dob') }}:</label>
                                    <input type="date" id="accountDob" min="1950-01-01" class="form-control" name="date_of_birth" value="{{ old('date_of_birth')}}" placeholder="{{ __('general.form.dob') }}"/>
                                    <small class="error">{{$errors->first("date_of_birth")}}</small>
                                </div>
                                <div class="form-group">
                                        <label for="accountPassword">{{ __('general.form.password') }}:</label>
                                        <input type="password" id="accountPassword" class="form-control" name="password" value="" placeholder="{{ __('general.form.password') }}"/>
                                        <small class="error">{{$errors->first("password")}}</small>
                                </div>
                                <div class="form-group">
                                        <label for="accountRePassword">{{ __('general.form.retype_password') }}:</label>
                                        <input type="password" id="accountRePassword" class="form-control" name="repassword" value="" placeholder="{{ __('general.form.retype_password') }}"/>
                                </div>
                                <div class="form-group">
                                        <label class="accountTitleSelect" for="accountGender">{{ trans_choice('general.form.select_gender',1) }}:</label>
                                        <select class="custom-select accountTitleSelect" name="gender" id="accountGender">
                                            @foreach($genders as $gender)
                                                <option value="{{$gender->id}}"
                                                @if(old('gender')==$gender->id)
                                                    selected="selected"
                                                @endif
                                                >{{$gender->name}}</option>
                                            @endforeach
                                        </select>
                                        <small class="error">{{$errors->first("gender")}}</small>
                                </div>
                                <div class="vesti_in_btn_pnl">
                                    <div id="vesti-load"><img src="{{ asset('/images/vesti_load.gif') }}"/></div>
                                    <input type="submit" class="btn-block vesti_in_btn loader-button" value="{{ __('buttons.submit') }}"/>
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