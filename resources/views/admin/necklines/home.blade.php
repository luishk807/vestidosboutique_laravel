@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center">
            <nav class="navbar navbar navbar-expand-lg">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('new_neckline') }}" class="nav-link">Add Neckline Type</a></li>
                <li class="nav-item"><a href="{{ route('show_import_neckline') }}" class="nav-link">Import Necklines</a></li>
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
    @foreach($necklines as $neckline)
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4">{{$neckline->name}}</div>
        <div class="col-md-3">{{ $neckline->getStatusName->name }}</div>
        <div class="col-md-3">
            <a href="{{ route('confirm_neckline',['neckline_id'=>$neckline->id])}}">delete</a>
            <a href="{{ route('edit_neckline',['neckline_id'=>$neckline->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection