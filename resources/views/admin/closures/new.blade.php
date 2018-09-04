@extends('admin/layouts.app')
@section('content')
<form action="{{ route('create_closure') }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="closureName">Name:</label>
        <input type="text" id="closureName" class="form-control" name="name" value="" placeholder="Closure"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="closureStatus">Status:</label>
        <select class="custom-select D" name="status" id="closureStatus">
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
                <a class="admin-btn" href="{{ route('admin_closures') }}">
                    Back To Closures
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Create Closure"/>
            </div>
        </div>
    </div>
</form>
@endsection