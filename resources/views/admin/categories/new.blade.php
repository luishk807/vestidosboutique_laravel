@extends('admin/layouts.app')
@section('content')
<form action="{{ route('create_category') }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="categoryName">Name:</label>
        <input type="text" id="categoryName" class="form-control" name="name" value="{{ old('name')}}" placeholder="Category"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="categoryStatus">Status:</label>
        <select class="custom-select" name="status" id="categoryStatus">
            @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    

    <div class="container">
        <div class="row form-btn-container">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_category') }}">
                    Back To Categories
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Create Category"/>
            </div>
        </div>
    </div>
</form>
@endsection