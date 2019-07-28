@extends('admin/layouts.app')
@section('content')
<form action="{{ route('save_event',['event_id'=>$event_id]) }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
    <div class="form-group">
        <div class="col"><img src="{{asset('images/shop_banners')}}/{{$event->image_url}}" alt="{{$event->image_name}}" class="img-fluid"/></div>
    </div>
    <div class="form-group">
        <label for="eventName">Name:</label>
        <input type="text" id="eventName" class="form-control" name="name" value="{{ $event->name }}" placeholder="Event Name"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="eventStatus">Status:</label>
        <select class="custom-select" name="status" id="eventStatus">
            @foreach($statuses as $status)
                <option value="{{ $status->id }}"
                @if($event->status==$status->id)
                selected=selected
                @endif 
                >{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    <div class="form-group">
        <label for="eventBanner">Replace Banner</label>
        <input type="file" name="event_banner" class="form-control-file" id="eventBanner">
    </div>

    <div class="container">
        <div class="row form-btn-container">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_events') }}">
                    Back To Events
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Save Event"/>
            </div>
        </div>
    </div>
</form>
@endsection