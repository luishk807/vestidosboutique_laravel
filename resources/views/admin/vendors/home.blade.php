@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center">
            <nav class="navbar navbar navbar-expand-lg">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('new_vendor') }}" class="nav-link">Add Vendor</a></li>
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
    @foreach($vendors as $vendor)
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4">{{$vendor->first_name}} {{$vendor->last_name}}</div>
        <div class="col-md-3">{{ $vendor->getStatusName->name }}</div>
        <div class="col-md-3">
            <a href="{{ route('confirm_vendor',['vendor_id'=>$vendor->id])}}">delete</a>
            <a href="{{ route('edit_vendor',['vendor_id'=>$vendor->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection