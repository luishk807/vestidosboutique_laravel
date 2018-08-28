@extends('admin/layouts.app')
@section('content')
<form action="{{ route('create_color',['product_id'=>$product_id]) }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label for="colorName">Name:</label>
        <input type="text" id="colorName" class="form-control" name="name" value="" placeholder="Color Name"/>
        <small class="error">{{$errors->first("name")}}</small>
    </div>
    <div class="form-group">
        <label for="colorCode">Color:</label>
        <input type="color" id="colorCode" name="color_code" value=""/>
        <small class="error">{{$errors->first("color_code")}}</small>
    </div>
    <div class="form-group">
        <label for="colorStatus">Status:</label>
        <select class="custom-select" name="status" id="colorStatus">
            @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{$status->name}} </option>
            @endforeach
        </select>
        <small class="error">{{$errors->first("status")}}</small>
    </div>
    

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a class="btn-block vesti_in_btn" href="{{ route('admin_colors',['product_id'=>$product_id]) }}">
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