@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center">
            <nav class="navbar navbar navbar-expand-lg">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('new_shipping_list') }}" class="nav-link">Add Shipping Lists</a></li>
            </ul>
            </nav>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-2">Name</div>
        <div class="col-md-2">Total</div>
        <div class="col-md-2">Description</div>
        <div class="col-md-2">Status</div>
        <div class="col-md-2">Action</div>
    </div>
    @foreach($shipping_lists as $shipping_list)
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-2">{{$shipping_list->name}}</div>
        <div class="col-md-2">{{$shipping_list->total}}</div>
        <div class="col-md-2">{{$shipping_list->description}}</div>
        <div class="col-md-2">{{$shipping_list->getStatusName->name }}</div>
        <div class="col-md-2">
            <a href="{{ route('confirm_shipping_list',['shipping_list_id'=>$shipping_list->id])}}">delete</a>
            <a href="{{ route('edit_shipping_list',['shipping_list_id'=>$shipping_list->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection