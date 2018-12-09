@extends('admin/layouts.app')
@section('content')
<form action="{{ route('delete_event',['event_id'=>$event_id])}}" method="post">
{{ method_field('DELETE') }}
<div class="container">
    <div class="row">
        <div class="col text-center">
            are you sure want to delete {{ $event->name }}
        </div>
    </div>
    <div class="row form-btn-container">
        <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_event') }}">
                    Back To Events
                </a>
        </div>
        <div class="col-md-6">
            <input type="submit" class="admin-btn" value="Delete Event"/>
        </div>
    </div>
</div>
</form>
@endsection