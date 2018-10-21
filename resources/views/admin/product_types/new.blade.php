@extends('admin/layouts.app')
@section('content')
<form action="{{ route('create_product_type') }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="product_typeName">Name:</label>
        <input type="text" id="product_typeName" class="form-control" name="name" value="{{ old('name')}}" placeholder="Product Type"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="product_typeCategory">Category:</label>
        <select class="custom-select" name="category" id="product_typeCategory">
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{$category->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("category")}}</small>
    </div>
    <div class="form-group">
        <label for="product_typeStatus">Status:</label>
        <select class="custom-select" name="status" id="product_typeStatus">
            @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_product_types') }}">
                    Back To Product Types
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Create Event"/>
            </div>
        </div>
    </div>
</form>
@endsection