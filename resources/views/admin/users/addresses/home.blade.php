@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center">
            <nav class="navbar navbar navbar-expand-lg">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('admin_edituser',['user_id'=>$user_id]) }}" class="nav-link">Back to Edit</a></li>
                <li class="nav-item"><a href="{{ route('admin_newaddress',['user_id'=>$user_id]) }}" class="nav-link">Add Address</a></li>
            </ul>
            </nav>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-1">Type</div>
        <div class="col-md-2">NickName</div>
        <div class="col-md-2">Name</div>
        <div class="col-md-2">Country</div>
        <div class="col-md-1">Zip Code</div>
        <div class="col-md-1">Status</div>
        <div class="col-md-2">Action</div>
    </div>
    @foreach($addresses as $address)
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-1">{{ $address->getAddressType->name }}</div>
        <div class="col-md-2">{{$address->nick_name }}</div>
        <div class="col-md-2">{{ $address->getFullName() }}</div>
        <div class="col-md-2">{{ $address->getCountry->countryName }}</div>
        <div class="col-md-1">{{ $address->zip_code }}</div>
        <div class="col-md-1">{{ $address->getStatusName->name }}</div>
        <div class="col-md-2">
            <a href="{{ route('confirm_adminaddress',['address_id'=>$address->id])}}">delete</a>
            <a href="{{ route('admin_editaddress',['address_id'=>$address->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection