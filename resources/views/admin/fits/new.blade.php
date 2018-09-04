@extends('admin/layouts.app')
@section('content')
<form action="{{ route('create_fit') }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="fitName">Name:</label>
        <input type="text" id="fitName" class="form-control" name="name" value="" placeholder="Fit Type Name"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="fitStatus">Status:</label>
        <select class="custom-select D" name="status" id="fitStatus">
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
                <a class="admin-btn" href="{{ route('admin_fits') }}">
                    Back To Fits
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Create Fit"/>
            </div>
        </div>
    </div>
</form>
@endsection