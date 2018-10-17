@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center">
            <nav class="navbar navbar navbar-expand-lg">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('new_payment') }}" class="nav-link">Add Payment Types</a></li>
            </ul>
            </nav>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-3">Name</div>
        <div class="col-md-3">Description</div>
        <div class="col-md-2">Status</div>
        <div class="col-md-2">Action</div>
    </div>
    @foreach($payment_types as $payment_type)
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-3">{{$payment_type->name}}</div>
        <div class="col-md-3">{{$payment_type->description}}</div>
        <div class="col-md-2">{{$payment_type->getStatusName->name }}</div>
        <div class="col-md-2">
            <a href="{{ route('confirm_payment',['payment_id'=>$payment_type->id])}}">delete</a>
            <a href="{{ route('edit_payment',['payment_id'=>$payment_type->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection