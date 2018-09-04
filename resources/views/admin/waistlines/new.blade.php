@extends('admin/layouts.app')
@section('content')
<form action="{{ route('create_waistline') }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="waistlineName">Name:</label>
        <input type="text" id="waistlineName" class="form-control" name="name" value="" placeholder="Waistline Name"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="waistlineStatus">Status:</label>
        <select class="custom-select D" name="status" id="waistlineStatus">
            <option value="">Select Status</option>
            @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_waistlines') }}">
                    Back To Waistlines
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Create Waistline"/>
            </div>
        </div>
    </div>
</form>
@endsection