@extends('admin/layouts.app')
@section('content')
<form action="{{ route('create_event') }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="eventName">Name:</label>
        <input type="text" id="eventName" class="form-control" name="name" value="{{ old('name')}}" placeholder="Event"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="eventStatus">Status:</label>
        <select class="custom-select" name="status" id="eventStatus">
            @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    <div class="form-group">
        <label for="eventBanner">Choose Banner</label>
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
                <input type="submit" class="admin-btn" value="Create Event"/>
            </div>
        </div>
    </div>
</form>
@endsection