@extends('admin/layouts.app')
@section('content')
<style>
.admin-user-list .row:not(:first-child){
    border-top:1px solid rgba(0,0,0,.2);
}
.admin-user-list .row:first-child{
    background-color:black;
    color:white;
}
.admin-user-list .row{
   padding:5px 0px;
}
.admin-user-list .row .action a{
  padding:0px 2px;
}
.admin-user-list .row .action a:not(:first-child){
    border-left:1px solid rgba(0,0,0,.2);
}
</style>
<div class="container">
    <div class="row">
        <div class="col text-center">
            <nav class="navbar navbar navbar-expand-lg">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('admin_newuser') }}" class="nav-link">Add User</a></li>
                <li class="nav-item"><a href="{{ route('show_import_adminuser') }}" class="nav-link">Import User</a></li>
            </ul>
            </nav>
            
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="shoplist-nav">
                <ul>
                        @if(!empty($users->previousPageUrl()))
                    <li><a href="{{ $users->previousPageUrl()}}">&lt; Back</a></li>
                    @endif
                    <li>{{ $users->currentPage()}} of {{ $users->count() }}</li>
                    @if($users->nextPageUrl())
                    <li><a href="{{ $users->nextPageUrl() }}">Next &gt;</a></li>
                    @endif
                </ul>
            </div><!--end of nav container-->
        </div>
    </div>
</div>
<div class="container admin-user-list">

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-2">Name</div>
        <div class="col-md-3">Email</div>
        <div class="col-md-2">Status</div>
        <div class="col-md-2">Type</div>
        <div class="col-md-2">Action</div>
    </div>
    @foreach($users as $user)
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-2">{{$user->getFullName()}}</div>
        <div class="col-md-3">{{$user->email}}</div>
        <div class="col-md-2">{{ $user->getStatusName->name }}</div>
        <div class="col-md-2">{{ $user->getType->name }}</div>
        <div class="col-md-2 action">
            <a href="{{ route('confirm_adminuser',['user_id'=>$user->id])}}">delete</a>
            <a href="{{ route('admin_edituser',['user_id'=>$user->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="shoplist-nav">
                <ul>
                        @if(!empty($users->previousPageUrl()))
                    <li><a href="{{ $users->previousPageUrl()}}">&lt; Back</a></li>
                    @endif
                    <li>{{ $users->currentPage()}} of {{ $users->count() }}</li>
                    @if($users->nextPageUrl())
                    <li><a href="{{ $users->nextPageUrl() }}">Next &gt;</a></li>
                    @endif
                </ul>
            </div><!--end of nav container-->
        </div>
    </div>
</div>
@endsection