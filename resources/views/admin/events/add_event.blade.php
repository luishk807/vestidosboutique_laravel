@extends('admin/layouts.app')
@section('content')
<form action="" method="post">
<div class="container">
    <div class="row">
        <div class="col text-center my-5">
            <strong>Please select events for menu.  Uncheck undesired menu [maximun {{ env('MENU_EVENT') }}].</strong>
        </div>
    </div>
    <div class="row form-btn-container">
        <div class="col-md-12 text-right">
            <input type="submit" class="admin-btn" value="Add Events To Menu"/>
        </div>
    </div>
    <div class="row container-title">
        <div class="col-md-1"></div>
        <div class="col-md-8">Name</div>
        <div class="col-md-3">Status</div>
    </div>
    @foreach($events as $event)
    <div class="row container-data row-even">
        <div class="col-md-1"><input  class="form-control" type="checkbox" name="event_ids[]" value="{{ $event->id }}"
        @if($event->set_menu)
        checked
        @endif
        ></div>
        <div class="col-md-8">{{$event->name}}</div>
        <div class="col-md-3">{{ $event->getStatus->name }}</div>
    </div>
    @endforeach
    <div class="row form-btn-container">
        <div class="col-md-12 text-right">
            <input type="submit" class="admin-btn" value="Add Events To Menu"/>
        </div>
    </div>
</div>
</form>
@endsection