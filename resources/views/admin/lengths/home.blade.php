@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center">
            <nav class="navbar navbar navbar-expand-lg">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('new_length') }}" class="nav-link">Add Length</a></li>
                <li class="nav-item"><a href="{{ route('show_import_length') }}" class="nav-link">Import Length</a></li>
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
    @foreach($lengths as $length)
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4">{{$length->name}}</div>
        <div class="col-md-3">{{ $length->getStatusName->name }}</div>
        <div class="col-md-3">
            <a href="{{ route('confirm_length',['length_id'=>$length->id])}}">delete</a>
            <a href="{{ route('edit_length',['length_id'=>$length->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection