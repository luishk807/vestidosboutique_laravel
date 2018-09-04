@extends('admin/layouts.app')
@section('content')
<form action="{{ route('create_fabric') }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="fabricName">Name:</label>
        <input type="text" id="fabricName" class="form-control" name="name" value="" placeholder="Fabric Name"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="fabricStatus">Status:</label>
        <select class="custom-select D" name="status" id="fabricStatus">
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
                <a class="admin-btn" href="{{ route('admin_fabrics') }}">
                    Back To Fabrics
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Create Fabric"/>
            </div>
        </div>
    </div>
</form>
@endsection