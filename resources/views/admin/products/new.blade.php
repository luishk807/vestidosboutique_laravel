@extends('admin/layouts.app')
@section('content')
<h1>{{$page_title}}</h1>
<form action="{{ route('create_product') }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="productName">Name:</label>
        <input type="text" id="productName" class="form-control" name="name" value="" placeholder="Product Name"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="productStatus">Status:</label>
        <select class="custom-select" name="status" id="productStatus">
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
                <a class="btn-block vesti_in_btn" href="{{ route('admin_products') }}">
                    Back To Products
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="btn-block vesti_in_btn" value="Create Product"/>
            </div>
        </div>
    </div>
</form>
@endsection