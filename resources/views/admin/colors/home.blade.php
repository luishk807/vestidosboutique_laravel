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
                <li class="nav-item"><a href="{{ route('new_color') }}" class="nav-link">Add Color</a></li>
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
    @foreach($colors as $color)
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4">{{$color->name}}</div>
        <div class="col-md-3">{{ $color->getStatusName->name }}</div>
        <div class="col-md-3">
            <a href="{{ route('confirm_color',['color_id'=>$color->id])}}">delete</a>
            <a href="{{ route('edit_color',['color_id'=>$color->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection