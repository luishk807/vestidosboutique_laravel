<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app_admin.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <title>{{ $page_title }}</title>
</head>
<body>
<form action="{{ route('admin_login') }}" method="post">
<div class="container my-5" id="admin-wrap">

    {{ csrf_field() }}
        <div class="row">
            <div class="col text-center">
            <img src="{{ asset('images/logo.svg') }}" class="vesti-svg vestidos-icons-logo"/>
            </div>
        </div>
        <div class="row">
            <div class="col text-center">
                <h2>{{$page_title }}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col error py-2 text-center">
            @if(Session::has("msg"))
            {{Session::get("msg")}}
            @endif
            </div>
        </div>
        <div class="form-group">
            <label for="loginName">{{ __('general.form.name') }}:</label>
            <input type="email" id="loginName" class="form-control" name="email" value="" placeholder="Login Email"/>
            <small class="error">{{$errors->first("email")}}</small>
        </div>
        <div class="form-group">
            <label for="loginPassword">{{ __('general.form.password') }}:</label>
            <input type="password" id="loginPassword" class="form-control" name="password" value="" placeholder="Password"/>
            <small class="error">{{$errors->first("password")}}</small>
        </div>

        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <input type="submit" class="admin-btn"  value="{{ __('buttons.log_in') }}"/>
                </div>
            </div>
        </div>
</div>
</form>
</body>
</html>
