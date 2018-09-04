@extends('admin/layouts.app')
@section('content')
<form action="{{ route('delete_adminuser',['user_id'=>$user->id])}}" method="post">
{{ method_field('DELETE') }}
<div class="container">
    <div class="row">
        <div class="col text-center">
            are you sure want to delete {{ $user->name }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_users') }}">
                    Back To Users
                </a>
        </div>
        <div class="col-md-6">
            <input type="submit" class="admin-btn" value="Delete User"/>
        </div>
    </div>
</div>
</form>
@endsection