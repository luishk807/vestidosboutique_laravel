@extends('admin/layouts.app')
@section('content')
<div class="container">
    <div class="row container-title">
        <div class="col-md-1"></div>
        <div class="col-md-3">Name</div>
        <div class="col-md-1">Status</div>
        <div class="col-md-3">Action</div>
    </div>
    @foreach($main_items as $event)
    <div class="row container-data row-even">
    <div class="col-md-1"><input  class="form-control" type="checkbox" name="event_ids[]" value="{{ $event->id }}"></div>
        <div class="col-md-3">{{$event->name}}</div>
        <div class="col-md-1">{{ $event->getStatus->name }}</div>
        <div class="col-md-3 container-button">
             <a href="{{ route('confirm_event',['event_id'=>$event->id])}}">delete</a>
            <a href="{{ route('edit_event',['event_id'=>$event->id])}}">edit</a>
        </div>
    </div>
    @endforeach
</div>
@endsection