@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center">
            <nav class="navbar navbar navbar-expand-lg">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('new_user') }}" class="nav-link">Add User</a></li>
            </ul>
            </nav>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4">Name</div>
        <div class="col-md-3">Status</div>
        <div class="col-md-3">Action</div>
    </div>
    @foreach($users as $user)
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4">{{$user->name}}</div>
        <div class="col-md-3">{{ $user->getStatusName->name }}</div>
        <div class="col-md-3">
            <a href="{{ route('confirm_user',['user_id'=>$user->id])}}">delete</a>
            <a href="{{ route('edit_user',['user_id'=>$user->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection