@extends('admin/layouts.app')
@section('content')
<form action="{{ route('save_size',['size_id'=>$size_id]) }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="sizeName">Size:</label>
        <input type="text" id="sizeName" class="form-control" name="dress_size" value="{{ old('dress_size') ? old('dress_size') : $size->name }}" placeholder="Size"/>
        <small class="error">{{$errors->first("dress_size")}}</small>
    </div>
    <div class="form-group">
        <label for="productRent">Rent Total:</label>
        <input type="number" id="productRent" class="form-control" name="total_rent" min="0" step="0.01" value="{{ old('total_rent') ? old('total_rent') : $size->total_rent }}" placeholder="0.00"/>
        <small class="error">{{$errors->first("total_rent")}}</small>
    </div>
    <div class="form-group">
        <label for="productSell">Sale Total:</label>
        <input type="number" id="productSell" class="form-control" name="total_sale" min="0" step="0.01" value="{{ old('total_sale') ? old('total_sale') : $size->total_sale }}" placeholder="0.00"/>
        <small class="error">{{$errors->first("total_sale")}}</small>
    </div>
    <div class="form-group">
        <label for="sizeStock">Stock:</label>
        <input type="number" id="sizeStock" class="form-control" name="stock" value="{{ old('stock') ? old('stock') : $size->stock }}" placeholder="Stock"/>
        <small class="error">{{$errors->first("stock")}}</small>
    </div>
    <div class="form-group">
        <label for="sizeColor">Select Color for Size:</label>
        <select class="custom-select" name="color" id="sizeColor">
            @foreach($colors as $color)
                <option value="{{ $color->id }}"
                @if($size->color_id==$color->id)
                    selected="selected"
                @endif
                >{{$color->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("color")}}</small>
    </div>
    <div class="form-group">
        <label for="sizeStatus">Status:</label>
        <select class="custom-select sizeStatus" name="status" id="sizeStatus">
            @foreach($statuses as $status)
                <option value="{{ $status->id }}"
                @if($size->status==$status->id)
                    selected="selected"
                @endif
                >{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    <div class="container">
        <div class="row form-btn-container">
            <div class="col-md-6">
                <a class="admin-btn" href="{{ route('admin_sizes',['product_id'=>$product_id]) }}">
                    Back To Sizes
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="admin-btn" value="Save Size"/>
            </div>
        </div>
    </div>

</form>
@endsection