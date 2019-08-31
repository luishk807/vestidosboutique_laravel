@extends('admin/layouts.app')
@section('content')
<form action="{{ route('edit_alert',['alert_id'=>$alert_id]) }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="alertName">Name:</label>
        <input type="text" id="alertName" class="form-control" name="name" value="{{ $name }}" placeholder="Alert Name"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="alertStatus">Status:</label>
        <select class="custom-select alertStatus" name="status" id="alertStatus">
            @foreach($statuses as $status)
                <option value="{{ $status->id }}"
                @if($alert->status==$status->id)
                    selected="selected"
                @endif
                >{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    <div class="container">
        <div class="row form-btn-container">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_alerts') }}">
                    Back To Alerts
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Save Alert"/>
            </div>
        </div>
    </div>

</form>
@endsection