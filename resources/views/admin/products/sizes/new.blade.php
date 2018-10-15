@extends('admin/layouts.app')
@section('content')
<form action="{{ route('create_size',['product_id'=>$product_id]) }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="sizeName">Name:</label>
        <input type="number" id="sizeName" class="form-control" name="size" value="" placeholder="Size"/>
        <small class="error">{{$errors->first("size")}}</small>
    </div>
    <div class="form-group">
        <label for="sizeStock">Stock:</label>
        <input type="number" id="sizeStock" class="form-control" name="stock" value="" placeholder="Stock"/>
        <small class="error">{{$errors->first("stock")}}</small>
    </div>
    <div class="form-group">
        <label for="sizeColor">Select Color for Size:</label>
        <select class="custom-select" name="color" id="sizeColor">
            @foreach($colors as $color)
                <option value="{{ $color->id }}">{{$color->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("color")}}</small>
    </div>
    <div class="form-group">
        <label for="sizeStatus">Status:</label>
        <select class="custom-select" name="status" id="sizeStatus">
            @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_sizes',['product_id'=>$product_id]) }}">
                    Back To Sizes
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Create Size"/>
            </div>
        </div>
    </div>
</form>
@endsection