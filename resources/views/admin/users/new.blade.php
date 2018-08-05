@extends('admin/layouts.app')
@section('content')
<form action="{{ route('admin_createuser') }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="userEmail">Email:</label>
        <input type="text" id="userEmail" class="form-control" name="email" value="{{ old('email')}}" placeholder="Email"/>
        <small class="error">{{$errors->first("email")}}</small>
    </div>
    <div class="form-group">
        <label for="userPassword">Password:</label>
        <input type="password" id="userPassword" class="form-control" name="password" value="" placeholder="Password"/>
        <small class="error">{{$errors->first("password")}}</small>
    </div>
    <div class="form-group">
        <label for="userRePassword">Re-Type Password:</label>
        <input type="password" id="userRePassword" class="form-control" name="re-type_password" value="" placeholder="Re-Type Password"/>
        <small class="error">{{$errors->first("re-type_password")}}</small>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="userFirstName">First Name:</label>
            <input type="text" id="userFirstName" class="form-control" name="first_name" value="{{ old('first_name')}}" placeholder="First Name"/>
            <small class="error">{{$errors->first("first_name")}}</small>
        </div>
        <div class="form-group col-md-4">
            <label for="userMiddleName">Middle Name:</label>
            <input type="text" id="userMiddleName" class="form-control" name="middle_name" value="{{ old('middle_name')}}" placeholder="Middle Name"/>
            <small class="error">{{$errors->first("middle_name")}}</small>
        </div>
        <div class="form-group col-md-4">
            <label for="userLastName">Last Name:</label>
            <input type="text" id="userLastName" class="form-control" name="last_name" value="{{ old('last_name')}}" placeholder="Last Name"/>
            <small class="error">{{$errors->first("last_name")}}</small>
        </div>
    </div>
    <div class="form-group">
        <label for="userDob">Date of Birth:</label>
        <input type="date" id="userDob" min="1950-01-01" class="form-control" name="date_of_birth" value="{{ old('date_of_birth')}}" placeholder="Date of Birth"/>
        <small class="error">{{$errors->first("date_of_birth")}}</small>
    </div>
    <div class="form-group">
        <label for="userPhone">Telephone:</label>
        <input type="text" id="userPhone" class="form-control" name="phone_number" value="{{ old('phone_number')}}" placeholder="Phone"/>
        <small class="error">{{$errors->first("phone_number")}}</small>
    </div>
    <div class="form-group">
        <label for="userGender">Genders:</label>
        <select class="custom-select" name="gender" id="userGender">
            <option value="">Select Gender</option>
            @foreach($genders as $gender)
                <option value="{{ $gender->id }}">{{$gender->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("gender")}}</small>
    </div>
    <div class="form-group">
        <label for="userType">User Type:</label>
        <select class="custom-select" name="user_type" id="userType">
            <option value="">Select Type</option>
            @foreach($user_types as $user_type)
                <option value="{{ $user_type->id }}">{{$user_type->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("user_type")}}</small>
    </div>
    <div class="form-group">
        <label for="userLanguage">Languages:</label>
        <select class="custom-select" name="preferred_language" id="userLanguage">
            <option value="">Select Language</option>
            @foreach($languages as $language)
                <option value="{{ $language->id }}">{{$language->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("preferred_language")}}</small>
    </div>
    <div class="form-group">
        <label for="userStatus">Status:</label>
        <select class="custom-select" name="status" id="userStatus">
            <option value="">Select Status</option>
            @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a class="btn-block vesti_in_btn" href="{{ route('admin_users') }}">
                    Back To Users
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="btn-block vesti_in_btn" value="Create User"/>
            </div>
        </div>
    </div>
</form>
@endsection