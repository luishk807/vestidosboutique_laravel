@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center">
            <nav class="navbar navbar navbar-expand-lg">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('new_brand') }}" class="nav-link">Add Brand</a></li>
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
    @foreach($brands as $brand)
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4">{{$brand->name}}</div>
        <div class="col-md-3">{{ $brand->getStatusName->name }}</div>
        <div class="col-md-3">
            <a href="{{ route('confirm_brand',['brand_id'=>$brand->id])}}">delete</a>
            <a href="{{ route('edit_brand',['brand_id'=>$brand->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection