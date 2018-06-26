@extends('admin/layouts.app')
@section('content')
<form action="{{ route('edit_color',['color_id'=>$color->id]) }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="colorName">Name:</label>
        <input type="text" id="colorName" class="form-control" name="name" value="{{ old('name') ? old('name') : $color->name }}" placeholder="Color Name"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="colorCode">Color:</label>
        <input type="color" id="colorCode" name="color_code" value="{{ old('color_code') ? old('color_code') : $color->color_code }}"/>
        <small class="error">{{$errors->first("color_code")}}</small>
    </div>
    <div class="form-group">
        <label for="colorStatus">Status:</label>
        <select class="custom-select colorStatus" name="status" id="colorStatus">
            <option value="">Select Status</option>
            @foreach($statuses as $status)
                <option value="{{ $status->id }}"
                @if($color->status==$status->id)
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
                <a class="btn-block vesti_in_btn" href="{{ route('admin_colors',['product_id'=>$color->product_id]) }}">
                    Back To Colors
                </a>
            </div>
            <div class="col-md-6">
                <input type="submit" class="btn-block vesti_in_btn" value="Save Color"/>
            </div>
        </div>
    </div>

</form>
@endsection