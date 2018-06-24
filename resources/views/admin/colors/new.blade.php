@extends('admin/layouts.app')
@section('content')
<h1>{{$page_title}}</h1>
<form action="{{ route('create_brand') }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="colorName">Name:</label>
        <input type="text" id="colorName" class="form-control" name="name" value="" placeholder="Color Name"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="colorProducts">Product:</label>
        <select class="custom-select D" name="status" id="colorProducts">
            <option>Select Products</option>
            @foreach($products as $product)
                <option value="{{ $product->id }}">{{$product->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    <div class="form-group">
        <label for="colorStatus">Status:</label>
        <select class="custom-select D" name="status" id="colorStatus">
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
                <a class="btn-block vesti_in_btn" href="{{ route('admin_colors') }}">
                    Back To Colors
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="btn-block vesti_in_btn" value="Create Colors"/>
            </div>
        </div>
    </div>
</form>
@endsection