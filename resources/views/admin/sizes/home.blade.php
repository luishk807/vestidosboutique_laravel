@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center">
        <h1>{{$page_title}}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col text-center">
            <nav class="navbar navbar navbar-expand-lg">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('admin') }}" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="{{ route('new_size') }}" class="nav-link">Add Product Size</a></li>
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
    @foreach($sizes as $size)
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4">{{$size->name}}</div>
        <div class="col-md-3">{{ $size->getStatusName->name }}</div>
        <div class="col-md-3">
            <a href="{{ route('confirm_size',['size_id'=>$size->id])}}">delete</a>
            <a href="{{ route('edit_size',['size_id'=>$size->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection