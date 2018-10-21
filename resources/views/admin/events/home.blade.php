@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center">
            <nav class="navbar navbar navbar-expand-lg">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('new_event') }}" class="nav-link">Add Event</a></li>
                <li class="nav-item"><a href="{{ route('show_import_event') }}" class="nav-link">Import Events</a></li>
            </ul>
            </nav>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-3">Name</div>
        <div class="col-md-1">Status</div>
        <div class="col-md-3">Action</div>
    </div>
    @foreach($events as $event)
    <div class="row">
    <div class="col-md-1"></div>
        <div class="col-md-3">{{$event->name}}</div>
        <div class="col-md-1">{{ $event->getStatus->name }}</div>
        <div class="col-md-3">
             <a href="{{ route('confirm_event',['event_id'=>$event->id])}}">delete</a>
            <a href="{{ route('edit_event',['event_id'=>$event->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection