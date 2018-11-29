@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4">Name</div>
        <div class="col-md-3">Status</div>
        <div class="col-md-3">Action</div>
    </div>
    @foreach($closures as $closure)
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4">{{$closure->name}}</div>
        <div class="col-md-3">{{ $closure->getStatusName->name }}</div>
        <div class="col-md-3">
            <a href="{{ route('confirm_closure',['closure_id'=>$closure->id])}}">delete</a>
            <a href="{{ route('edit_closure',['closure_id'=>$closure->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection