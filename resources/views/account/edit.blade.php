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
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vehicula eros vitae lorem finibus faucibus. Morbi vitae blandit diam, id interdum risus. Cras sodales felis augue, efficitur suscipit magna aliquet at. 
            </P>
        </div>
    </div>
    <div class="container account-container">
                <form action="{{ route('updateuser') }}" method="post">
                {{ csrf_field() }}

                <div class="form-group">
                        <label class="accountTitleSelect" for="accountLanguage">Select Language:</label>
                        <select class="custom-select accountTitleSelect" name="preferred_language" id="accountLanguage">
                            <option value="">Select Language</option>
                            @foreach($languages as $language)
                                <option value="{{$language->id}}"
                                @if($user->preferred_language==$language->id)
                                    selected="selected"
                                @endif
                                >{{$language->name}}</option>
                            @endforeach
                        </select>
                        <small class="error">{{$errors->first("preferred_language")}}</small>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="accountFirstName">First Name:</label>
                        <input type="text" id="accountFirstName" class="form-control" name="first_name" value="{{ old('first_name') ? old('first_name') : $user->first_name }}" placeholder="First Name"/>
                        <small class="error">{{$errors->first("first_name")}}</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="accountMiddleName">Middle Name:</label>
                        <input type="text" id="accountMiddleName" class="form-control" name="middle_name" value="{{ old('middle_name') ? old('middle_name') : $user->middle_name }}" placeholder="Last Name"/>
                        <small class="error">{{$errors->first("middle_name")}}</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="accountLastName">Last Name:</label>
                        <input type="text" id="accountLastName" class="form-control" name="last_name" value="{{ old('last_name') ? old('last_name') : $user->last_name }}" placeholder="Last Name"/>
                        <small class="error">{{$errors->first("last_name")}}</small>
                    </div>
                </div>
                <div class="form-group">
                        <label for="accountEmail">Email:</label>
                        <input type="email" id="accountEmail" class="form-control" name="email" value="{{ old('email') ? old('email') : $user->email }}" placeholder="Email"/>
                        <small class="error">{{$errors->first("email")}}</small>
                </div>
                <div class="form-group">
                        <label for="accountPhone">Phone:</label>
                        <input type="tel" id="accountPhone" class="form-control" name="phone_number" value="{{ old('phone_number') ? old('phone_number') : $user->phone_number }}" placeholder="Phone Number"/>
                        <small class="error">{{$errors->first("phone_number")}}</small>
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
                <div class="vesti_in_btn_pnl">
                    <input type="submit" class="btn-block vesti_in_btn" value="Save Client"/>
                </div>
                </form><!--end of form container-->
    </div>
</div><!--end of main container-->
@endsection
