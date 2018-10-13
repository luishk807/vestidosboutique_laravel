@extends('admin/layouts.app')
@section('content')
<form action="{{ route('edit_size',['size_id'=>$size_id]) }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="sizeName">Size:</label>
        <input type="text" id="sizeName" class="form-control" name="dress_size" value="{{ old('dress_size') ? old('dress_size') : $size->name }}" placeholder="Size"/>
        <small class="error">{{$errors->first("dress_size")}}</small>
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
        <div class="row">
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