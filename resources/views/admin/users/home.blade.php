@extends('admin/layouts.app')
@section('content')
<div class="container admin-user-list">

    <div class="row container-title">
        <div class="col-md-1"></div>
        <div class="col-md-2">Name</div>
        <div class="col-md-3">Email</div>
        <div class="col-md-2">Status</div>
        <div class="col-md-2">Type</div>
        <div class="col-md-2">Action</div>
    </div>
    @foreach($main_items as $user)
    <div class="row container-data row-even">
        <div class="col-md-1"><input  class="form-control" type="checkbox" name="user_ids[]" value="{{ $user->id }}"></div>
        <div class="col-md-2">{{$user->getFullName()}}</div>
        <div class="col-md-3">{{$user->email}}</div>
        <div class="col-md-2">{{ $user->getStatusName->name }}</div>
        <div class="col-md-2">{{ $user->getType->name }}</div>
        <div class="col-md-2 container-button">
            <a href="{{ route('confirm_adminuser',['user_id'=>$user->id])}}">delete</a>
            <a href="{{ route('admin_edituser',['user_id'=>$user->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection