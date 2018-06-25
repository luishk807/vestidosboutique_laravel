@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center">
            <nav class="navbar navbar navbar-expand-lg">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('new_dresstype') }}" class="nav-link">Add Dress Type</a></li>
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
    @foreach($dresstypes as $dresstype)
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4">{{$dresstype->name}}</div>
        <div class="col-md-3">{{ $dresstype->getStatusName->name }}</div>
        <div class="col-md-3">
            <a href="{{ route('confirm_dresstype',['dresstype_id'=>$dresstype->id])}}">delete</a>
            <a href="{{ route('edit_dresstype',['dresstype_id'=>$dresstype->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection