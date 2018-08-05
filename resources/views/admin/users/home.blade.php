@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center">
            <nav class="navbar navbar navbar-expand-lg">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('admin_newuser') }}" class="nav-link">Add User</a></li>
            </ul>
            </nav>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-2"></div>
        <div class="col-md-2">Name</div>
        <div class="col-md-3">Email</div>
        <div class="col-md-2">Status</div>
        <div class="col-md-2">Action</div>
    </div>
    @foreach($users as $user)
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-2"></div>
        <div class="col-md-2">{{$user->getFullName()}}</div>
        <div class="col-md-3">{{$user->email}}</div>
        <div class="col-md-2">{{ $user->getStatusName->name }}</div>
        <div class="col-md-2">
            <a href="{{ route('confirm_adminuser',['user_id'=>$user->id])}}">delete</a>
            <a href="{{ route('admin_edituser',['user_id'=>$user->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection