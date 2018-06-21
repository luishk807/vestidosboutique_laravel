@extends('admin/layouts.app')
@section('content')
<h1>New Product</h1>
<form action="" method="post">
    <div class="form-group">
            <label for="accountFirstName">First Name:</label>
            <input type="text" id="accountFirstName" class="form-control" name="first_name" value="" placeholder="First Name"/>
            <small class="error">{{$errors->first("first_name")}}</small>
    </div>
</form>
@endsection