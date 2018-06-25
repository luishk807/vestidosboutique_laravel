@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center">
            <nav class="navbar navbar navbar-expand-lg">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('new_fit') }}" class="nav-link">Add Fit Type</a></li>
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
    @foreach($fits as $fit)
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4">{{$fit->name}}</div>
        <div class="col-md-3">{{ $fit->getStatusName->name }}</div>
        <div class="col-md-3">
            <a href="{{ route('confirm_fit',['fit_id'=>$fit->id])}}">delete</a>
            <a href="{{ route('edit_fit',['fit_id'=>$fit->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection