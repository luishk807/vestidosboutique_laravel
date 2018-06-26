@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center">
            <nav class="navbar navbar navbar-expand-lg">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('admin_newaddress') }}" class="nav-link">Add Address</a></li>
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
    @foreach($addresses as $address)
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4">{{$address->name}}</div>
        <div class="col-md-3">{{ $address->getStatusName->name }}</div>
        <div class="col-md-3">
            <a href="{{ route('confirm_address',['address_id'=>$address->id])}}">delete</a>
            <a href="{{ route('edit_address',['address_id'=>$address->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection