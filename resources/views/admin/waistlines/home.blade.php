@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center">
            <nav class="navbar navbar navbar-expand-lg">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('new_waistline') }}" class="nav-link">Add Waistline</a></li>
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
    @foreach($waistlines as $waistline)
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4">{{$waistline->name}}</div>
        <div class="col-md-3">{{ $waistline->getStatusName->name }}</div>
        <div class="col-md-3">
            <a href="{{ route('confirm_waistline',['waistline_id'=>$waistline->id])}}">delete</a>
            <a href="{{ route('edit_waistline',['waistline_id'=>$waistline->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection