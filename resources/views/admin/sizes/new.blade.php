@extends('admin/layouts.app')
@section('content')
<form action="{{ route('create_size') }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="sizeName">Name:</label>
        <input type="number" id="sizeName" class="form-control" name="name" value="" placeholder="Size"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="sizeProducts">Products:</label>
        <select class="custom-select" name="product" id="sizeProducts">
            <option value="">Select Product</option>
            @foreach($products as $product)
                <option value="{{ $product->id }}">{{$product->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("product")}}</small>
    </div>
    <div class="form-group">
        <label for="sizeStatus">Status:</label>
        <select class="custom-select" name="status" id="sizeStatus">
            <option>Select Status</option>
            @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a class="btn-block vesti_in_btn" href="{{ route('admin_sizes') }}">
                    Back To Sizes
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="btn-block vesti_in_btn" value="Create Size"/>
            </div>
        </div>
    </div>
</form>
@endsection