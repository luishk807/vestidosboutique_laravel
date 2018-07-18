<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form action="{{ route('admin_login') }}" method="post">
    {{ csrf_field() }}
        <div class="row">
            <div class="col error py-2">
            @if(Session::has("msg"))
            {{Session::get("msg")}}
            @endif
            </div>
        </div>
        <div class="form-group">
            <label for="loginName">Name:</label>
            <input type="email" id="loginName" class="form-control" name="email" value="" placeholder="login Type Name"/>
            <small class="error">{{$errors->first("email")}}</small>
        </div>
        <div class="form-group">
            <label for="loginPassword">Password:</label>
            <input type="password" id="loginPassword" class="form-control" name="password" value="" placeholder=""/>
            <small class="error">{{$errors->first("password")}}</small>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <input type="submit" class="btn-block vesti_in_btn" value="Login"/>
                </div>
            </div>
        </div>
    </form>
</body>
</html>
