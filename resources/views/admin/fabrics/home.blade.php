@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center">
            <nav class="navbar navbar navbar-expand-lg">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('new_fabric') }}" class="nav-link">Add Fabric</a></li>
                <li class="nav-item"><a href="{{ route('show_import_fabrics') }}" class="nav-link">Import Fabrics</a></li>
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
    @foreach($fabrics as $fabric)
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4">{{$fabric->name}}</div>
        <div class="col-md-3">{{ $fabric->getStatusName->name }}</div>
        <div class="col-md-3">
            <a href="{{ route('confirm_fabric',['fabric_id'=>$fabric->id])}}">delete</a>
            <a href="{{ route('edit_fabric',['fabric_id'=>$fabric->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection