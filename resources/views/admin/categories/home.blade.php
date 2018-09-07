@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center">
            <nav class="navbar navbar navbar-expand-lg">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('new_category') }}" class="nav-link">Add Category</a></li>
                <li class="nav-item"><a href="{{ route('show_import_category') }}" class="nav-link">Import Categories</a></li>
            </ul>
            </nav>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-3">Name</div>
        <div class="col-md-2">Dress Type</div>
        <div class="col-md-2">Dress Style</div>
        <div class="col-md-1">Status</div>
        <div class="col-md-3">Action</div>
    </div>
    @foreach($categories as $category)
    <div class="row">
    <div class="col-md-1"></div>
        <div class="col-md-3">{{$category->name}}</div>
        <div class="col-md-2">{{ $category->getDressType->name }}</div>
        <div class="col-md-2">{{ $category->getDressStyle->name }}</div>
        <div class="col-md-1">{{ $category->getStatus->name }}</div>
        <div class="col-md-3">
             <a href="{{ route('confirm_category',['category_id'=>$category->id])}}">delete</a>
            <a href="{{ route('edit_category',['category_id'=>$category->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection